<div class="card-body">
  <h5 class="card-title"><?= $title; ?></h5>
    <table class="table table-borderless datatable text-center">
      <?php 
            if (empty($info)) {
                echo '<br /><div class="alert alert-warning alert-dismissible fade show" role="alert">There is no employee on annual leave  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{ ?>
                <table class="table table-bordered border-primary text-center">
                   <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Department</th>
                        <th scope="col">Return date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach($info as $info){ ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $info['names']; ?></td>
                                    <td><?= $info['department_name']; ?></td>
                                    <td><?= $info['end_date']; ?></td>
                                </tr>
                            <?php $i++; } ?>
                    </tbody>
                </table>
           <?php }  ?>
    </table>
</div>