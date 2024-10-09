<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-04
 * @description Display and more electricity usage locations 
 * @license     Open Source

-->
<div class="card">
    <div class="card-body">
        <div class="container-fluid p-3">
    <div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('addNewCar')"><i class="bi bi-plus-circle"></i> Add Electricity Location</a>
            </div>
        </div>
        <div class="col-md-12" id="addNewCar" style="display: none;">

            <!-- //we'll start here when  we came back  -->

            <form class="row g-3" method="post" id="addNewLocationForm">
                <div class="col-md-4">
                    <label for="names">Electric Building</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-4">
                    <label for="names">Building Code Number</label>
                    <input type="text" class="form-control" name="code">
                </div>
                <div class="col-md-4">
                    <label for="uses">uses</label>
                    <textarea class="form-control" name="uses" rows="2"></textarea>
                </div>
                <center>
                    <button type="button" class="btn btn-primary"  onclick="add_new_location()">ADD</button>
                </center>
            <br /><br />
            </form>
        </div>

        <?php 
            if(isset($sms)){
                echo $sms;
            }
        ?>

        <table class="table table-bordered border-primary">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>Electric Building</th>
                    <th>#</th>
                    <th>Electric Building</th>
                    <th>#</th>
                    <th>Electric Building</th>
                </tr>
            </thead>
            <tbody>
                <!-- here we retrieve all available cars -->
                <?php
                    $locations = $this->estate->getAllElectricityLocation();
                    if (empty($locations)) { ?>
                        <td colspan="6">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i> No list of available electricity usages locations right now
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </td>
                    <?php } else {
                        $i = 0;
                        $locationsCount = count($locations);
                        foreach ($locations as $index => $loc) {
                            $i++;
                            if ($index % 3 == 0) {
                                echo '<tr>';
                            }
                            ?>
                            <td><?= $i; ?></td>
                            <td><?= $loc->name; ?></td>
                            <?php
                            if (($index + 1) % 3 == 0 || $index == $locationsCount - 1) {
                                echo '</tr>';
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>


