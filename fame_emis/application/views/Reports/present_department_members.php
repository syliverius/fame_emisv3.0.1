<div class="modal-header">
    <h4 class="modal-title text-center">
        Employees of   <b><i><?= $this->hr->get_Department_Details($department_id)->department_name; ?></i></b> department present
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="card">
    <div class="card-body">
        <?php 
            if (empty($members)) {
                echo '<br /><div class="alert alert-warning alert-dismissible fade show" role="alert"> Sorry,today roster unavailable <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{ ?>
                <table class="table table-bordered border-primary text-center">
                   <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Duty name</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach($members as $member){ 
                                if($member['work_period'] != "Off"){?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $member['names']; ?></td>
                                    <td><?= $member['name']; ?></td>
                                </tr>
                            <?php $i++; } } ?>
                    </tbody>
                </table>
           <?php }  ?>
   </div>
</div>