<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class Attendance extends CI_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth');
		}elseif (time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
            redirect('auth');
        }else{
             $this->session->set_userdata('last_activity', time()); // update the last activity time
             date_default_timezone_set('UTC');
			$this->load->model('Attendance_Model','attendance');
			$this->load->model('Hr_Dashboard_Model','hr');
		}
	}


	public function index(){
		$module_name = "attendance";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
        	$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('attendance/attendance_home');
			$this->load->view('footer');
		}
	}

	function import_attedance_data(){
		$config = array(
                'allowed_types' => 'csv',
                'upload_path' => './assets/attendances',
                'overwrite' => TRUE,
                'remove_spaces' => TRUE,
            );

		$this->load->library('upload', $config);
        $this->upload->initialize($config);

	    if($this->upload->do_upload("file")){
	    	$file_data = $this->upload->data();
	    	$filepath = $file_data['full_path'];
	    	//load the excel file
	    	$objPHPExcel = IOFactory::load($filepath);

	    	//get the first work sheet
	    	$worksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            //iterate through rows starting from the second row (since the first row contains headers)
            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $worksheet->rangeToArray('A' . $row . ':D' . $row, null, true, false);
                $data = array(
                    'employee_id' => $rowData[0][0],
                    'datetime' => strtotime($rowData[0][1]), //editing done here
                    'status' => $rowData[0][2],
                    'print_date' => date('Y-m-d')
                );

                // Insert data into the database table
                $this->attendance->insert_imported_data($data);
            }

            //delete the uploaded file 
            unlink($filepath);
     		$this->load->view('attendance/imported_table_data');
		}else{
			$error = $this->upload->display_errors();
			echo '<tr><td colspan="5"><div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!! </strong>'.$error.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td></tr>';
		}
	}

	function print_weekly_report(){
		$department_id = $this->input->post('department');
		$week = $this->input->post('week'); // 2023-W30
		list($year, $weekNumber) = sscanf($week, "%d-W%d");
		$firstDayOfYear = new DateTime("$year-01-01"); 
		// Calculate the start date of the ISO week
		$startDate = $firstDayOfYear->modify('+' . ($weekNumber - 1) . ' weeks')->modify('Monday');
		$endDate = clone $startDate;
		$endDate->modify('+6 days');
		$startDateString = $startDate->format('Y-m-d');
		$endDateString = $endDate->format('Y-m-d');

		$startDateTimestamp = strtotime($startDateString . ' 00:00:00');
		$endDateTimeStamp = strtotime($endDateString . ' 23:59:59');

		//first we'll check the existance of weekly report 
		$weekReport = $this->attendance->checkWeeklyReport($department_id,$startDateTimestamp,$endDateTimeStamp);
		$weekInfo['weekInfo'] = array(
			'department_id' => $department_id,
			'week' => $week,
			'employeeAttendanceInfo' => $weekReport
		);
		
		$this->load->view('attendance/weekly_department_report',$weekInfo);

	}

	function department_attendance(){
		$module_name = "department_attendance";
        if($this->auth_library->is_secure($this->session->userdata('employee_id'),$module_name,$this->session->userdata('security'))){
        	$module['module_name'] = $module_name;
			$this->load->view('head',$module);
			$this->load->view('attendance/department_attendance');
			$this->load->view('footer');
		}
	}
}

?>