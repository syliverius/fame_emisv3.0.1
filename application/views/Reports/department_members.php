<div class="modal-header">
    <h4 class="modal-title text-center">
        Members of  <b><i><?= $this->hr->get_Department_Details($department_id)->department_name; ?></i></b> Department
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Names</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Professional</th>
                    <th scope="col">Hiring date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $count = 1 ;
                    foreach ($members as $member) { ?>
                        <tr class="text-center">
                            <th><?= $count; ?></th>
                            <th scope="col"><?= $member->names; ?></th>
                            <th scope="col"><?= $member->gender; ?></th>
                            <th scope="col"><?= $member->professional_name; ?></th>
                            <th scope="col"><?= $member->hiring_date; ?></th>
                        </tr>
                
                <?php $count++; } ?>
            </tbody>
   </div>
</div>