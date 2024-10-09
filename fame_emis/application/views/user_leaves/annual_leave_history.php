<div class="card">
  <div class="card-body">
    <h3 class="card-title">LEAVE HISTORY</h3>
    <div class="accordion accordion-flush" id="accordionFlushExample"> 
      <?php 
        $getAllYearlyLeaveIds = $this->hr->get_leave_ids($employee_id);
        if(empty($getAllYearlyLeaveIds)){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Leave history for this employee do not exists <button type="button" 
          class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }else{
        foreach($getAllYearlyLeaveIds as $row){
          $getBenefitDetails = $this->hr->getBenefitDetails($row->leave_id);
          foreach($getBenefitDetails as $details){ ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="heading.<?= $details->benefit_id; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $details->benefit_id; ?>" aria-expanded="false" aria-controls="collapse<?= $details->benefit_id; ?>">
                Leave Record of  <?= $details->start_date; ?>
                </button>
              </h2>
            <div id="collapse<?= $details->benefit_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $details->benefit_id; ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <table class="table table-bordered border-primary">
                      <tr class="text-center">
                        <td colspan="2"><b>Leave Dates</b></td>
                        <td colspan="2">Start Date</td>
                        <td colspan="1"><?= $details->start_date; ?></td>
                        <td colspan="2">End Date</td>
                        <td colspan="1"><?= $details->end_date; ?></td>
                        <td colspan='2'>Days Off</td>
                        <td colspan='1'><?= $details->days_off; ?></td>
                      </tr>
                      <tr class=" text-center">
                        <td colspan="2"><b>Location</b></td>
                        <td colspan="2">Region</td>
                        <td colspan="1"><?= $this->request->get_region_name($details->mkoa)->region_name; ?></td>
                        <td colspan="2">District</td>
                        <td colspan="1"><?= $this->request->get_district_name($details->wilaya)->district_name; ?></td>
                        <td colspan="2">Ward</td>
                        <td colspan="1"><?= $this->request->get_ward_name($details->kata)->ward_name; ?></td>
                      </tr>
                      <tr class=" text-center">
                        <td colspan="2"><b>Benefit</b></td>
                        <td colspan="4"> Cash </td>
                        <td colspan="5"><?= $details->amount; ?></td>
                      </tr>
                      <tr class=" text-center">
                        <td colspan="1"><b>Dependants</b></td>
                        <td colspan="1">Dependant1</td>
                        <td colspan="1"><?= $details->mtegemezi_1; ?></td>
                        <td colspan="1">Dependant2</td>
                        <td colspan="1"><?= $details->mtegemezi_2; ?></td>
                        <td colspan="1">Dependant3</td>
                        <td colspan="1"><?= $details->mtegemezi_3; ?></td>
                        <td colspan="1">Dependant4</td>
                        <td colspan="1"><?= $details->mtegemezi_4; ?></td>
                        <td colspan="1">Dependant5</td>
                        <td colspan="1"><?= $details->mtegemezi_5; ?></td>
                      </tr>
                 </table>
                 <!-- here will print leave benefit description -->
                 <?php
                    if($details->amount > 0){
                      $data['leave_info'] = $details;
                      $this->load->view('user_leaves/leave_benefits_unditable_description',$data);
                    }
                 ?>
              </div>
            </div>
          </div>
      <?php } } } ?>
    </div><!-- End Accordion without outline borders -->
  </div>
</div> 