<?php $this->load->helper('wategemezi_option_helper'); ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Employee's Dependants</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
        <li class="breadcrumb-item">Edit Dependants</a></li>
      </ol>
    </nav>
  </div> <!--End of page title -->
<div class="content-wrapper">
    <section class="content">
        <center class="codrops-demos">
            <a href="<?php echo base_url(); ?>Wategemezi/hr_wategemezi_review" class="btn btn-primary" title="Back to wategemezi review ">&Ll; HR DEPENDANTS REVIEW</a>
        </center>
        <br />
        <h4><i class="fa fa-angle-right"></i> Employee names [ <?= $wategemezi->names; ?> ]</h4>
        <?php echo $this->session->flashdata('mtegemezi_message'); ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-plus-square-o"></i>
                         <h5><table>
						 <tr><td style="padding-right:25px"><b>Submitted Employee's Dependants </b></td></table></h5> 
                    </div>
                    <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered text-center" id="myTable">
                           
                            <tr>
                                <th>S/N</th>
                                <th>Dependant Name</th>
                                <th>Relation</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                for($i = 1; $i <= 6; $i++){
                                    $deptName = 'dept' . $i;
                                    $deptRel = 'dept' . $i .'_relation';
                                    $deptDob = 'dept' . $i .'_dob';
                                    if($wategemezi->$deptName != NULL && $wategemezi->$deptName != ''){ ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $wategemezi->$deptName; ?></td>
                                            <td><?= $wategemezi->$deptRel; ?></td>
                                            <td><?= calculate_year($wategemezi->$deptDob); ?></td>
                                            <td>
                                                <center><a href="<?php echo base_url() . "wategemezi/hr_wategemezi_review/delete_mtegemezi/" . $wategemezi->employee_id . "/" . $i; ?>" title="Remove mtegemezi" onclick="return confirm('Confirm Remove mtegemezi!')"><span class="bi bi-dash-circle"></span></a></center>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                            ?> 

                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>	
</main>	