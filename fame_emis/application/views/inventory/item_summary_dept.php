	<div class="modal-header">
        <h4 class="modal-title"> <b>ALLOCATION OF <i><?= $item_name->item_name; ?></i> DEPARTMENT-WISE</b></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class='modal-body'>
        <div class="card-body">
            <div class="">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="col-sm-3">Location</th>
                            <th scope="col" class="col-sm-3">Counts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($item_dept_count as $row){
                            ?>
                            <tr>
                                <td><?= $row['location_name']; ?></td>
                                <td><?= $row['total']; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
  <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 </div>