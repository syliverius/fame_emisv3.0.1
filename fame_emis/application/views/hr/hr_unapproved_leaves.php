<div class="card-body">
  <!-- start of table for displaying data -->
  <div class="col-lg-12">
    <?php echo $this->session->flashdata('hr_success_message'); ?>
    <?php echo $this->session->flashdata('hr_update_message'); ?>
    <h3 class="card-title"><b>List employee who needs leaves approval and review</b></h3>
    <div id="hr_approval_response_message"></div>
      <table class="table table-striped">

        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Destination Region</th>
            <th scope="col">Department</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
            foreach ($values as $row){
              ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?= $row['names']; ?></td>
              <td><?= $row['start_date']; ?></td>
              <td><?= $row['end_date']; ?></td>
              <td><?= $this->request->get_region_name($row['region'])->region_name;?></td>
              <td><?= $row['dept_name']; ?></td>
              <td>
                <button type="button" class="btn  btn-primary more_details_hr_btn"  data-id="<?= $row['benefit_id']; ?>" >More Details</button>
                <button type="button" class="btn btn-success hr_approve_btn" data-id="<?= $row['benefit_id']; ?>" data-name="<?= htmlspecialchars($row['names']); ?>" id="approvalbtn.<?= $row['benefit_id']; ?>">Approve</button>   
              </td>

              <?php $i++; ?>
            </tr>
              <?php
              } ?>
          </tbody>

          <tfoot>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Destination Region</th>
            <th scope="col">Department</th>
            <th scope="col">Action</th>
          </tfoot>
        </table>
      </div>
    <!-- End of displaying data table -->
  </div>