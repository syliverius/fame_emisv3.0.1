<div class="modal-header">
    <h4 class="modal-title text-center"> <b>
        Emergency Leave History for <b><i><?= $this->hr->return_employee_name($employee_id)->names; ?></i></b>
    </b></h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="card">
    <div class="card-body">
<?php 
    if(count($details) <= 0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i>Employee has never request any emergency leave this year <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }else{ ?>
        <div class="accordion accordion-flush" id="accordionFlushExample"> 
            <?php
                foreach($details as $row){ ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading.<?= $row->emergency_id; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row->emergency_id; ?>" aria-expanded="false" aria-controls="collapse<?= $row->emergency_id; ?>">
                             Emergency Leave Record of  <?= $row->start_date; ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $row->emergency_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $row->emergency_id; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class='modal-body row g-3'>
                                <div class="col-md-4">
                                  <label for="names">JINA</label>
                                    <input type="text" class="form-control" value="<?= $row->names; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                  <label for="today">TAREHE YA MAOMBI</label>
                                  <input type="date" class="form-control" value="<?= $row->date; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                  <label for="idara">IDARA</label>
                                  <input type="text" class="form-control" value="<?= $row->department_name; ?>" readonly>
                                </div>

                                <div class="col-md-6">
                                  <label for="kazi">KAZI/CHEO</label>
                                  <input type="text" class="form-control" value="<?= $row->professional_name; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                  <label for="phone_number">SIMU</label>
                                  <input type="tel" class="form-control" value="<?= $row->phone_number; ?>" readonly>
                                </div>

                                <div class="col-md-12">
                                  <label>Fomu hii ili kuwasilisha maombi yangu ya kutokuwepo kazini, tafadhali hakiki kibali hiki cha kutokuwepo kwa muda wa siku</label>
                                  <input type="number" class="form-control" value="<?= $row->emergency_days; ?>" readonly>
                                </div>

                                <div class="col-md-4">
                                  <label for="start_date">Kuanzia Tarehe</label>
                                  <input type="date" class="form-control" value="<?= $row->start_date; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                  <label for="end_date">Mpaka Tarehe</label>
                                  <input type="date" class="form-control" name="end_date1" id="end_date1" value="<?= $row->end_date; ?>" readonly> 
                                </div>
                                <div class="col-md-4">
                                    <label for="reason">Reason</label>
                                    <input type="text" class="form-control" value="<?= $row->sababu; ?>" readonly>
                                    
                                </div>
                                <div class="col-md-12" id="comment">
                                  <label for="comment">Specified other reasons/comment</label>
                                  <textarea class="form-control" readonly><?= $row->comments; ?></textarea>
                                </div>
                                <div class="col-md-12"><b>Imepitiwa na:</b></div>
                                <div class="col-md-6">
                                  <label for="dept_head">Mkuu wa department</label>
                                  <input type="text" class="form-control" value="<?= $this->hr->get_dept_head_name($row->department_id)->names; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                  <label for="hd_date">Tarehe ya kupitia</label>
                                  <input type="date" class="form-control" name="hd_date"  value="<?= $row->hd_date; ?>" readonly> 
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
   </div>
</div>