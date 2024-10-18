<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-09
 * @description Display specific month electricity usage 
 * @license     Open Source

-->

<div class="card">
    <div class="card-body">

        <br /> <br />
        <div style="float: right;">
            <button type="button" class="btn btn-success" onclick="export_to_excel()"><i class="bi bi-file-excel"></i>Export</button>
        </div>
        <h3 class="card-title">Electricity consumption for month <b><i><?= $data['month'].' , '.$data['year']; ?></i></b></h3>
        <input type="text" name="summary_name" id="summary_name" value="Electricity consumption for month <?= $data['month'].' , '.$data['year']; ?>" hidden>
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
            <table class="table table-bordered border-primary table-striped" id="myTable">
                <thead class="text-center">
                    <tr class="table-info">
                        <th colspan="5"><?= $current_month; ?></th>
                    </tr>
                    <tr class="table-dark">
                        <th>Location</th>
                        <td></td>
                        <th>Pre-reading</th>
                        <th>Current-reading</th>
                        <th>Used units</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                    $locations = $this->estate->getAllElectricityLocation();
                    foreach($locations as $loc){ 
                        $prev_date = "";
                        $prev_units = "";
                        $pre = $this->estate->prev_reading($loc->id, $prev_month, $prev_year); 
                        $current = $this->estate->prev_reading($loc->id, $current_month, $year); 
                        if(!empty($pre)){
                            $prev_date = $pre->recorded_date;
                            $prev_units = $pre->units_recorded;
                        }if(!empty($current)){
                            $current_date = $current->recorded_date;
                            $current_units = $current->units_recorded;
                        } ?>
                        <tr>
                            <td rowspan="2"><?= $loc->name; ?></td>
                            <td>Date</td>
                            <td><?= $prev_date; ?></td>
                            <td><?= $current_date; ?></td>
                            <td rowspan="2"><?php 
                                if($prev_units == "" || $current_units == ""){
                                    echo "***";
                                }else{
                                    echo round(($current_units-$prev_units),1);
                                }
                            ?></td>
                        </tr>
                        <tr>
                            <td>Units</td>
                            <td><?= $prev_units; ?></td>
                            <td><?= $current_units; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</div>

<script type="text/javascript">
    function export_to_excel(month){
            var this_month = document.getElementById("summary_name").value;
            // var message = this_month + ' roaster';
            $("#myTable").table2excel({
                exclude: ".no-export", // Add class 'no-export' to elements you want to exclude from export
                filename: this_month, // Name of the Excel file
                fileext: ".xls", // File extension (".xls" for Excel 2003 or older, ".xlsx" for Excel 2007 or newer)
                preserveColors: true
              });
        }
</script>