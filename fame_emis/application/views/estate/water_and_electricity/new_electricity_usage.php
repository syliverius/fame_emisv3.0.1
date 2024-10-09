<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-08
 * @description Form for electricity usages
 * @license     Open Source

-->

<div class="card">
    <div class="card-body">
        <br /> <br />
        <h3 class="card-title">Form to insert Electricity consumption for month <b><i><?= $data['month'].' , '.$data['year']; ?></i></b></h3>
        <form id="new_usage_form" method="post">
            <?php
            $current_month = $data['month'];
            $year = $data['year'];


            if ($current_month == 'January') {
                $prev_month = 'December';
                $prev_year = $year - 1; // Previous year
            } else {
                $month_timestamp = strtotime($current_month);
                $prev_month = date('F', strtotime('-1 month', $month_timestamp));
                $prev_year = $year;
            }
            ?>
            <input type="text" name="month" value="<?= $current_month; ?>" hidden>
            <input type="text" name="year" value="<?= $year; ?>" hidden>
            <table class="table table-bordered border-primary">
                <thead class="text-center">
                    <tr>
                        <th colspan="5"><?= $current_month; ?></th>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td></td>
                        <th>Pre-reading</th>
                        <th>Current-reading</th>
                        <th>Used units</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $locations = $this->estate->getAllElectricityLocation();
                    foreach($locations as $loc){ 
                        $prev_date = "";
                        $prev_units = "";
                        $pre = $this->estate->prev_reading($loc->id, $prev_month, $prev_year); 
                        if(!empty($pre)){
                            $prev_date = $pre->recorded_date;
                            $prev_units = $pre->units_recorded;
                        } ?>
                        <tr>
                            <td rowspan="2"><?= $loc->name; ?></td>
                            <td>Date</td>
                            <td><input type="date" class="form-control" value="<?= $prev_date; ?>" readonly></td>
                            <td>
                            	<input type="date" name="<?= $loc->id . '_date'; ?>" class="form-control"
			                   onchange="handleFirstDateChange(this.value, '<?= $loc->id; ?>')">
                            </td>
                            <td rowspan="2" class="text-center vertical-center" id="<?= $loc->id.'_used_units_td'; ?>"></td>
                        </tr>
                        <tr>
                            <td>Units</td>
                            <td><input type="number" class="form-control" value="<?= $prev_units; ?>" readonly></td>
                            <td><input type="number" name="<?= $loc->id.'_units'; ?>" class="form-control" onchange="calculateUsedUnits(this,<?= $loc->id; ?>)"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <center>
                <button type="reset" class="btn btn-danger">Cancel</button>
                <button type="button" name="create_electricity_btn" class="btn btn-primary" onclick="create_electricity_usage()">Submit</button>
            </center>
        </form>
    </div>
</div>

<script type="text/javascript">
	function calculateUsedUnits(inputField,locId){
        var currentUnitsField = inputField;
        var previousUnitsField = inputField.parentNode.previousElementSibling.querySelector('input[type="number"]');
        var currentUnits = parseFloat(currentUnitsField.value) || 0;
        var previousUnits = parseFloat(previousUnitsField.value) || 0;
        var usedUnitsTd = document.getElementById(locId + '_used_units_td');
        if (previousUnits == 0) {
        	usedUnitsTd.innerHTML = "***";
        }else{
        var usedUnits = currentUnits - previousUnits;
        usedUnits = usedUnits.toFixed(1);
        if(usedUnits < 0){
        	usedUnits = "***";
        }
        usedUnitsTd.innerHTML = usedUnits;
        }
    }

    function handleFirstDateChange(firstDate, locationId) {
        // Update all other date inputs with the same date
        document.querySelectorAll('[name$="_date"]').forEach(function (element) {
            element.value = firstDate;
        });
    }
</script>
