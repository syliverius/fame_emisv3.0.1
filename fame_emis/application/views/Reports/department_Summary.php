<div class="card">
  <div class="card-body">
    <div class="card-title">
      <span style="float:right;"><button type="button" class="btn btn-success" onclick="export_file_excel()"><i class="bi bi-file-excel"></i> Excel</button>
          <button type="button" class="btn btn-secondary" onclick="print_now()">Print</button>
      </span>
    </div>
    <div id="printDiv">
      <input type="text" id="roster_name" name="roster_name" value="<?= 'annual leave for '.$dept_name.' year '.$year; ?>" hidden>
      <table class="table table-striped" id="Annual_roster_table">
          <thead>
            <tr>
              <th colspan="6"><p class="card-title"><?= strtoupper("Annual Leave Roaster for ".$dept_name." Department year ".$year); ?></p></th>
            </tr>
            <tr>
              <th scope="col">No.</th>
              <th scope="col" class="col-sm-3">Full Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Reason</th>
              <th scope="col">Comments</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if (isset($roaster_info)) {
                foreach($roaster_info as $row){
                  echo '<tr><th>'.$row['number'].'</th>';
                  echo '<td>'.$row['names'].'</td>';
                  echo  '<td>'.$row['startDate'].'</td>';
                  echo  '<td>'.$row['endDate'].'</td>';
                  echo '<td>'.$row['reason'].'</td>';
                  echo  '<td>'.$row['comments'].'</td></tr>';
                }
              }else{
                  echo "
                    <tr>
                      <th colspan='4'><div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Roaster not created yet. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></th>
                    </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<script type="text/javascript">
  function print_now() {
        var mywindow = window.open('', 'Annual Leave Roaster', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
        mywindow.document.write('<html><head><title>Annual Leave Roaster</title>');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/core.min.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/components.min.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('</head><body >');

        mywindow.document.write(document.getElementById('printDiv').innerHTML);

        mywindow.print();
        mywindow.close();

        return true;
    }

  function export_file_excel(month){
    var this_month = document.getElementById("roster_name").value;
      $("#Annual_roster_table").table2excel({
          exclude: ".no-export", // Add class 'no-export' to elements you want to exclude from export
          filename: this_month,
          fileext: ".xls",
          preserveColors: true
        });
      }
</script>