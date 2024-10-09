<main id="main" class="main">

  <div class="pagetitle">
    <h1>User Groups</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">User Groups </a></li>
      </ol>
    </nav>
  </div> <!--End of page title -->
<div class="content-wrapper">
    <section class="content">
        <center class="codrops-demos">
            <a href="<?php echo base_url(); ?>admin_dashboard" class="btn btn-primary" title="Back to Other User Groups">&Ll; User Types/Admin Panel</a>
        </center>
        <h4><i class="fa fa-angle-right"></i> User Group [ <?php echo $user_info[0]->group_name; ?> ]</h4>
        <p>
            <?php
            echo $this->session->flashdata('res');
            ?>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-plus-square-o"></i>

                         <h5><table>
						 <tr><td style="padding-right:25px">Unassigned Modules </td><td>
						 
                            <input type="text" id="myInput"   onkeyup="myFunction()" class="form-control" placeholder="Search..." name="searchname">
                        </td></tr></table></h5> 
                    </div>
                    <div class="card">
                    <div class="card-body" id="modu">
                        <table class="table table-bordered" id="myTable">
                           
                            <tr>
                                <th>S/N</th>
                                <th>Module name</th>
                                <th>Descriptions</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php
                            $l = 0;
                             $ls = '';
                            foreach ($unassigned_priv as $ass_priv):
                                $l++;
                                 $ls = $ass_priv->label;
                                ?>
                                <tr class="trow" style="height: 25px">
                                    <td><center><?php echo $l; ?></center></td>
                                <td><?php echo $ass_priv->label; ?></td>
                                <td><?php echo $ass_priv->description; ?></td>
                                <td><center><a href="<?php echo base_url() . "admin_dashboard/asssign_privileges/" . $ass_priv->module_id . "/" . $user_info[0]->user_group_id; ?>" title="Assign this Module" onclick="return confirm('Confirm Assignment!')"><span class="bi bi-plus-circle"></span></a></center></th>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <div id="modu"></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-minus-square-o"></i>
                           <h5><table><tr><td style="padding-right:25px">
                       Assigned Modules</td><td class="">
                            <input type="text" id="myInput2"   onkeyup="myFunction2()" class="form-control" placeholder="Search..." name="searchname">
                        </td> 
						</tr>
						</table></h5>
                    </div>
                    <div class="card">
                    <div class="card-body">
                            <table class="table table-bordered" id="myTable2">
                            <tr>
                                <th>S/N</th>
                                <th>Module name</th>
                                <th>Descriptions</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php
                            $m = 0;
                            foreach ($setting as $prev):
                                $m++;
                                ?>
                                <tr class="trow" style="height: 25px">
                                    <td><center><?php echo $m; ?></center></td>
                                <td><?php echo $prev->label; ?></td>
                                <td><?php echo $prev->description; ?></td>
                                <td><center><a href="<?php echo base_url() . "admin_dashboard/remove_privilege/" . $prev->module_id . "/" . $user_info[0]->user_group_id; ?>" title="Remove module" onclick="return confirm('Confirm Remove this!')"><span class="bi bi-dash-circle"></span></a></center></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>	
</main>	
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
