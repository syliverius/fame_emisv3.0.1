<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.6
 * @since       2023-11-22
 * @description This page is used to present audit trail report .
 * @license     Open Source

-->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">System Audit Trial as from <?= $start_date; ?> to <?= $end_date; ?> </h5>

        <?php 
        if (empty($trials)) {
            echo '<br /><div class="alert alert-warning alert-dismissible fade show" role="alert">Sorry!!, There is no log trials recorded from '.$start_date.' to  '.$end_date.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else { ?>
            <section class="section">
                <div class="row align_items-top">
                        <?php foreach($trials as $trial): ?>
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $trial->action_name; ?></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">Description : <?= $trial->description; ?></li>
                                        <li class="list-group-item">Date : <?= date("Y-m-d H:i:s", $trial->time_stamp); ?></li>
                                        <?php 
                                          if($trial->severity == "Normal"){
                                            echo '<li class="list-group-item">Severity : '.$trial->severity;'</li';
                                          }else{
                                            echo '<li class="list-group-item">Severity : <span class="text-danger">'.$trial->severity;'</span></li';
                                          }
                                        ?>
                                        <li class="list-group-item">Performed by : <b><?= $this->create->get_name($trial->employee_id)->names; ?></b></li>
                                    </ul>
                                </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                </div>
            </section>
        <?php } ?>
    </div>
</div>
