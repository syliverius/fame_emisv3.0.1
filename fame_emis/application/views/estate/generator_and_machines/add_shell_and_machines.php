<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.8
 * @since       2024-01-02
 * @description This will add new petrol station supplier and new estate machines
 * @license     Open Source

-->
<div class="card">
    <div class="card-body">
        <div class="container-fluid p-3">
        	<div class="row p-3">
                <!-- Import link -->
                <div class="col-md-12 head">
                    <div class="float-end">
                        <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('addNewMachine')"><i class="bi bi-plus-circle"></i> Add New Car</a>
                    </div>
                </div>
                <div class="col-md-12" id="addNewMachine" style="display: none;">

                    <form class="row g-3" method="post" id="addNewMachineForm">
                        <div class="col-md-4">
                            <label for="machine_name">Machine Name</label>
                            <input type="text" class="form-control" name="machine_name">
                        </div>
                        <div class="col-md-4">
                            <label for="machine_id">Machine ID/Reg. Number</label>
                            <input type="text" class="form-control" name="machine_id">
                        </div>
                        <div class="col-md-4">
                            <label for="uses">Uses</label>
                            <textarea class="form-control" name="uses" rows="2"></textarea>
                        </div>
                        <center>
                            <button type="button" class="btn btn-primary"  name="add_new_car" onclick="create_new_machine()">ADD</button>
                        </center>
                    <br /><br />
                    </form>
                </div>

                <?php 
                    if(isset($sms1)){
                        echo $sms1;
                    }
                ?>

                <table class="table table-bordered border-primary">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Machine ID/Reg Number</th>
                            <th>Uses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $machines = $this->estate->getAllMachines();
                            if(empty($machines)){ ?>
                                <td colspan="5"><div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> No list of Generators and machines available right  now <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td>
                            <?php }else{ $i = 1;
                                foreach ($machines as $machine) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $machine->name; ?></td>
                                        <td><?= $machine->machine_id; ?></td>
                                        <td><?= $machine->others; ?></td>
                                    </tr>
                                <?php $i++; } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-fluid p-3">
            <div class="row p-3">
                <!-- Import link -->
                <div class="col-md-12 head">
                    <div class="float-end">
                        <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('addNewShell')"><i class="bi bi-plus-circle"></i> Add New Fuel Station</a>
                    </div>
                </div>
                <div class="col-md-12" id="addNewShell" style="display: none;">

                    <form class="row g-3" method="post" id="addNewShellForm">
                        <div class="col-md-6">
                            <label for="fuel_station">Fuel Station Name </label>
                            <input type="text" class="form-control" name="fuel_station">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="comments">Other explanation </label>
                            <textarea class="form-control" name="comments" rows="2"></textarea>
                        </div>
                        <center>
                            <button type="button" class="btn btn-primary"  onclick="create_new_Shell()">ADD</button>
                        </center>
                    <br /><br />
                    </form>
                </div>

                <?php 
                    if(isset($sms2)){
                        echo $sms2;
                    }
                ?>

                <table class="table table-bordered border-primary">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Fuel Station Name</th>
                            <th>Other Explanation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $shells = $this->estate->getAllShells();
                            if(empty($shells)){ ?>
                                <td colspan="5"><div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> No list of fuel station available right  now <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></td>
                            <?php }else{ $i = 1;
                                foreach ($shells as $shell) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $shell->name; ?></td>
                                        <td><?= $shell->others; ?></td>
                                    </tr>
                                <?php $i++; } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

