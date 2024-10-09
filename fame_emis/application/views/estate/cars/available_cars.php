<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2023-12-30
 * @description Display available facility cars and add new car 
 * @license     Open Source

-->

<div class="container-fluid p-3">
	<div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('addNewCar')"><i class="bi bi-plus-circle"></i> Add New Car</a>
            </div>
        </div>
        <div class="col-md-12" id="addNewCar" style="display: none;">

            <!-- //we'll start here when  we came back  -->

            <form class="row g-3" method="post" id="addNewCarForm">
                <div class="col-md-4">
                    <label for="names">Car Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-4">
                    <label for="names">Registration number</label>
                    <input type="text" class="form-control" name="reg_number">
                </div>
                <div class="col-md-4">
                    <label for="uses">uses</label>
                    <textarea class="form-control" name="uses" rows="2"></textarea>
                </div>
                <center>
                    <button type="button" class="btn btn-primary"  name="add_new_car" onclick="Add_new_car()">ADD</button>
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
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Uses</th>
                </tr>
            </thead>
            <tbody>
                <!-- here we retrieve all available cars -->
                <?php
                    $cars = $this->estate->getAllCars();
                    if(empty($cars)){ ?>
                        <td colspan="5"><div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> No list of cars available right  now <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td>
                    <?php }else{ $i = 1;
                        foreach ($cars as $car) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $car->name; ?></td>
                                <td><?= $car->registration_number; ?></td>
                                <td><?= $car->uses; ?></td>
                            </tr>
                        <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
</div>

