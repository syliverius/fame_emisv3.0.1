<div class="card">
  <div class="card-body">
    <!-- start of table for displaying data -->
    <div class="col-lg-12">
      <h3 class="card-title"><b><?= $title; ?></b></h3>
      <div id="table_response_message"></div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col" class="col-sm-3">Full Name</th>
            <th scope="col">Return Date</th>
            <th scope="col">Days Left</th>
            <th scope="col">Department</th>
          </tr>
        </thead>

        <tbody id="table_who_to_be_on_leave">
          <?php 
            $i = 1;
            foreach($data as $row){
              $days = 0;
              $date1 = new DateTime(); 
              $date2 = new DateTime($row->end_date);
              if($date1<$date2){
                  $diff = date_diff($date2, $date1);
                  $days = $diff->d;
                } ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row->names; ?></td>
            <td><?= $row->end_date; ?></td>
            <td><?= $days; ?></td>
            <td><?= $row->department_name; ?></td>

          </tr>
            <?php $i++; }
          ?>
        </tbody>

        <tfoot>
          <th scope="col">No.</th>
          <th scope="col" class="col-sm-3">Full Name</th>
          <th scope="col">Return Date</th>
          <th scope="col">Days Left</th>
          <th scope="col">Department</th>
        </tfoot>
      </table>
    </div>
  <!-- End of displaying data table -->
  </div>
</div>