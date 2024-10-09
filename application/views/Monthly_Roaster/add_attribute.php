<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.6
 * @since       2023-11-24
 * @description On admin dashboard we see monthly duty roster acronoms,set color and others xtcs.
 * @license     Open Source

-->
<br />
<div class="card">
  <div class="card-body">
    <div class="card-title">Mothly Duty Roster Shifts Abbreviations 
        <div class="float-end">
            <a href="<?= base_url("admin_dashboard/create_new_duty_shift"); ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Create New Shift</a>
        </div>
    </div><br />
    <?php $shifts = $this->admin->get_monthly_roster_shifts(); ?>
    <div><?php if (isset($sms)) {
      echo $sms;
    } ?></div>
     <table class="table table-striped datatable text-center">
      <tr>
        <th>Name</th>
        <th>Abbreviation</th>
        <th>Box color</th>
        <th>Departments</th>
        <th>Text Color</th>
        <th>Work Period</th>
        <th>Action</th>
      </tr>
        <?php
            foreach($shifts as $shift){ ?>
                <tr>
                    <td><?= $shift->name; ?></td>
                    <td><?= $shift->abbreviation; ?></td>
                    <td><?= $shift->color; ?></td>
                    <td>
                        <?php 
                        $department_ids_array = explode(',',$shift->department_ids) ; 
                        foreach($department_ids_array as $department_id){
                            echo $this->hr->get_Department_Details($department_id)->department_name.' , ';
                        }
                        ?>
                    </td>
                    <td><?= $shift->text_color; ?></td>
                    <td><?= $shift->work_period; ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="delete_shift(<?= $shift->id?>)"><span class="bi bi-trash"></span></a> ||
                        <a href="<?= base_url()."admin_dashboard/edit_shift_info/".$shift->id; ?>" title="View and Edit Shift Information">
                            <span class="bi bi-edit">Edit</span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
    </table>
  </div>
</div>