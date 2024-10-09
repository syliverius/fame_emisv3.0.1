<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description All database activities that consern with real estate
 * @license     Rwazi.co.tz

-->
<?php

class Estate_Model extends CI_Model{

	//		*** CARS ***

	function getAllCars(){
		return $this->db->select('*')->from('cars')->get()->result();
	}

	function addNewCar($data){
		return $this->db->insert('cars',$data);
	}

	function create_car_consumption($data){
		return $this->db->insert('cars_fuel_uses',$data);
	}

	function get_car_month_usage($month,$car_id,$year){
		$this->db->select('fuel_used,km_covered');
		$this->db->where('car_id',$car_id);
		$this->db->where('month',$month);
		$this->db->where('DATE_FORMAT(date_recorded,"%Y")',$year);
		return $this->db->get('cars_fuel_uses')->row();
	}

	function getCarInfo($id){
		$this->db->select('')->from('cars')->where('car_id',$id);
		return $this->db->get()->row();
	}


	//		*** END OF CARS *** 

	//		*** GENERATORS AND MACHINES ***

	function getAllMachines(){
		return $this->db->select('*')->from('machines')->get()->result();
	}

	function getAllShells(){
		return $this->db->select('*')->from('fuel_stations')->get()->result();
	}

	function create_new_machine($data){
		return $this->db->insert('machines',$data);
	}

	function create_new_fuel_station($data){
		return $this->db->insert('fuel_stations',$data);
	}

	function create_new_fuel_purchase($data){
		return $this->db->insert('generator_fuel_purchases',$data);
	}

	function machine_fuel_usage($data){
		return $this->db->insert('generator_fuel_usage',$data);
	}

	//		*** END OF MACHINES *** 

	//		*** WATER AND ELECTRICITY UTILIZATION ***

	function getAllElectricityLocation(){
		return $this->db->select('*')->from('electricity_location')->get()->result();
	}

	function add_new_electricity_location($data){
		return $this->db->insert('electricity_location',$data);
	}

	function check_electricity_usage($data){
		$this->db->select('*')->from('electricity_usage');
		$this->db->where('month',element('month',$data));
		$this->db->where('year',element('year',$data));
		return $this->db->get();
	}

	function create_new_electricity_usage($data){
		return $this->db->insert('electricity_usage',$data);
	}

	function prev_reading($location_id,$month,$year){
		$this->db->select('')->from('electricity_usage');
		$this->db->where('location_id',$location_id);
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		return $this->db->get()->row();
	}

	function current_reading($id,$month,$year){
		$this->db->select('')->from('electricity_usage');
		$this->db->where('location_id',$id);
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		return $this->db->get()->row();
	}

	function update_electricity_usages($data){
		$this->db->select('');
		$this->db->where('recorded_date',element('recorded_date',$data));
		$this->db->where('location_id',element('location_id',$data));
		return $this->db->update('electricity_usage',$data);
	}

	//		*** END OF WATER AND ELECTRICITY ***


	//		*** START OF REPORTS ***

	function check_car_data($data){
		$this->db->select('*')->from('cars_fuel_uses');
		$this->db->where('car_id',element('car',$data));
		$this->db->where('DATE_FORMAT(date_recorded,"%Y")',element('year',$data));
		return $this->db->get();
	}

	function check_All_cars_data($year) {
	    $this->db->select('*');
	    $this->db->from('cars_fuel_uses');
	    $this->db->join('cars', 'cars.car_id = cars_fuel_uses.car_id');
	    $this->db->where("DATE_FORMAT(cars_fuel_uses.date_recorded, '%Y') =", $year);

	    return $this->db->get();
	}

	function getFuelPurchases($year){
		$this->db->select('generator_fuel_purchases.date_bought,generator_fuel_purchases.amount,fuel_stations.name,generator_fuel_purchases.Recept_number,generator_fuel_purchases.cost_per_litre,MONTHNAME(generator_fuel_purchases.date_bought) as month_name');
		$this->db->where('DATE_FORMAT(generator_fuel_purchases.date_bought,"%Y") =',$year);
		$this->db->where('fuel_stations.id = generator_fuel_purchases.station_id');
		$this->db->from('generator_fuel_purchases');
		$this->db->from('fuel_stations');
		return $this->db->get();
	}


	function getFuelConsumption($year){
		$this->db->select('generator_fuel_usage.date_recorder,generator_fuel_usage.amount_used,generator_fuel_usage.Refilling_time,generator_fuel_usage.running_time,machines.name,MONTHNAME(generator_fuel_usage.date_recorder) as month_name');
		$this->db->where('DATE_FORMAT(generator_fuel_usage.date_recorder,"%Y") =',$year);
		$this->db->where('machines.id = generator_fuel_usage.machine_id');
		$this->db->from('generator_fuel_usage');
		$this->db->from('machines');
		return $this->db->get();
	}

	function check_All_location_electricity_data($year){
		$this->db->select('electricity_usage.month,electricity_usage.units_recorded,electricity_location.name');
		$this->db->where('electricity_usage.year',$year);
		$this->db->where('electricity_location.id = electricity_usage.location_id');
		$this->db->from('electricity_usage');
		$this->db->from('electricity_location');
		return $this->db->get();
	}


	function getDecemberUnits($year,$id){
		$this->db->select('units_recorded');
		$this->db->where('year',$year);
		$this->db->where('location_id',$id);
		$this->db->where('month','December');
		return $this->db->get('electricity_usage')->row();
	}

	function getThisyearUnits($year,$id){
		$this->db->select('month,units_recorded');
		$this->db->where('year',$year);
		$this->db->where('location_id',$id);
		return $this->db->get('electricity_usage');
	}

	function getLocationName($location_id){
		return $this->db->select('name')->from('electricity_location')->where('id',$location_id)->get()->row();
	}

	function getPreviousYearDecemberUnits($year){
		$this->db->select('electricity_usage.units_recorded,electricity_location.name');
		$this->db->where('electricity_usage.year',$year);
		$this->db->where('electricity_usage.month','December');
		$this->db->where('electricity_location.id = electricity_usage.location_id');
		$this->db->from('electricity_usage');
		$this->db->from('electricity_location');
		return $this->db->get();
	}




}



?>
