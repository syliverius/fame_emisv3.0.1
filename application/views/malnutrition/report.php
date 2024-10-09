<main id="main" class="main">

  	<div class="pagetitle">
        <h1>Malnutrition Report</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">Create Report</li>
            <!-- <li class="breadcrumb-item active">Profile</li> -->
          </ol>
        </nav>
      </div><!-- End Page Title -->

                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Attended malnutrition patients so far <span>....</span></div>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col" class="col-sm-3">Full Name</th>
                            <th scope="col">File Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Ipd days</th>
                            <th scope="col">commorbidity</th>
                            <th scope="col">MAM-SAM</th>
                          </tr>
                        </thead>
                        <tbody id="report_table_data">
                          <!-- append retrieved data from the database -->
                           <?php 
                            $i=1;
                            foreach ($values as $row){
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?= $row['names']; ?></td>
                                <td><?= $row['file_number']; ?></td>
                                <td><?= $row['address']; ?></td>
                                <td><?= $row['ipd_days']; ?></td>
                                <td><?= $row['commorbidity']; ?></td>
                                <td><?= $row['nam_sam']; ?></td>
                                <?php $i++; ?>
                              </tr>
                            <?php
                            } ?>
                        </tbody>

                        <tfoot>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col" class="col-sm-3">Full Name</th>
                            <th scope="col">File Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Ipd days</th>
                            <th scope="col">Commorbidity</th>
                            <th scope="col">MAM-SAM</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
             </main>

