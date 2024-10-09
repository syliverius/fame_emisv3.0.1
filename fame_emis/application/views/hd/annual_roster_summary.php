  <div class="card">
    <div class="card-body">
      <br />
      <span style="float:right;"><button type="button" class="btn btn-success" onclick="export_file_excel()"><i class="bi bi-file-excel"></i> Excel</button>
          <button type="button" class="btn btn-secondary" onclick="print_now()">Print</button>
      </span>
      </div>
      <div id="printDiv">
        <input type="text" name="roster_name" id="roster_name" value="Annual Roster of <?= $this->session->userdata('department_name'); ?>  Department  year <?= $year; ?>" hidden>
          <table class="table table-striped" id="Annual_roster_table">
            <thead>
              <tr>
                <th colspan="6"><div class="card-title"><?= strtoupper("Annual Roster of " .$this->session->userdata('department_name')." Department  year ".$year); ?></th>
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
                $i = 1;
                foreach($data->result() as $row){ ?>
                  <tr>
                    <th scope='col'><?= $i; ?></th>
                    <td scope='col' class='col-sm-3'><?= $row->names; ?></td>
                    <td scope='col'><?= $row->start_date; ?></td>
                    <td scope='col'><?= $row->end_date; ?></td>
                    <td scope='col'><?= $row->reason; ?></td>
                    <td scope='col'><?= $row->comments; ?></td>
                  </tr>
              <?php 
                $i++; 
                }
              ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
<script>
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