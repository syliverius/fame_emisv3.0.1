<!--if message is set -->

<div class="card">
  <div class="card-body">
    <!-- start of table for displaying data -->
    <div class="col-lg-12">
      <h5 class="card-title"><?= date('Y');?> List of employee with their leave dates & reasons </h5>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col" class="col-sm-3">Full Name</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Reasons</th>
          <th scope="col" class="col-sm-2">Comments</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
        <tbody id="table_data">
          <?php 
            $i = 1;
          foreach ($table as $item) { ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
              <td><?= $item->names; ?></td>
              <td><?= $item->start_date; ?></td>
              <td><?= $item->end_date; ?></td>
              <td><?= $item->reason; ?></td>
              <td><?= $item->comments; ?></td>
              <td>
                <button type="button" class="btn  btn-primary roaster_edit_btn"  data-id="<?= $item->employee_id; ?>">Edit</button> 
                <button type="button" class="btn btn-danger" onclick="delete_annual_roster_member('<?= $item->names; ?>','<?= $item->employee_id; ?>')">Delete</button>
              </td>
          </tr>
            <?php $i++; } ?>
        </tbody>
        <tfoot>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Reasons</th>
            <th scope="col" class="col-sm-2">Comments</th>
            <th scope="col">Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- End of table roaster -->
  </div>
</div>