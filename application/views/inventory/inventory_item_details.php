<?php 
$equipment_category = array (
    "FURNITURES AND FITTINGS" => "FURNITURES AND FITTINGS",
    "MEDICAL EQUIPMENTS" => "MEDICAL EQUIPMENTS",
    "OFFICE EQUIPMENTS" => "OFFICE EQUIPMENTS",
    "ELECTRONIC DEVICES" => "ELECTRONIC DEVICES",
    "MACHINE" => "MACHINE",
    "DOMESTIC EQUIPMENT" => "DOMESTIC EQUIPMENT"
);

?>

    <div class='modal-body row g-3'>
        <div id="items_form_insert"></div>
            <form class="" id="update_inventory_form" method="post">
        <input type="text" name="inventory_id" value="<?= $details->inventory_id; ?>" hidden>
        <input type="text" name="item_id" value="<?= $details->item_key; ?>" hidden>
          	<div class="col-md-4">
            	<label for="names">ITEM NAME</label>
            	<input type="text" class="typeahead form-control" name="item" value="<?= $details->item_name; ?>" readonly>
           	</div>
           	<div class="col-md-4">
           		<label for="today">BRAND</label>
            	<input type="text" class="form-control" name="brand" value="<?= $details->brand; ?>" >
            </div>
            <div class="col-md-4">
                <label for="idara">CATEGORY</label>
                <select class="form-control" name="category">
                    <?php 
                        foreach($equipment_category as $category){
                            if($category == $details->category){
                                echo "<option selected>".$category."</option>";
                            }else{
                            echo "<option>".$category."</option>";
                            }
                        }
                    ?>
                </select> 
            </div>
            <div class="col-md-3">
                <label for="year_of_purchase">Year of Purchase</label>
                <input type="number" class="form-control" name="year_of_purchase" value="<?= $details->year_purchased; ?>">
            </div>
            <div class="col-md-3">
                <label for="average_years">Average year of Life(years)</label>
                <input type="number" class="form-control" name="average_years" value="<?= $details->average_life; ?>">
            </div>
            <div class="col-md-3">
                <label for="purchase_price">Price at Puchase</label>
                <input type="number" class="form-control" name="purchase_price" value="<?= $details->price_of_purchase; ?>">
            </div>
            <div class="col-md-3">
                <label for="service_cost">Service Contract cost</label>
                <input type="number" class="form-control" name="service_cost" value="<?= $details->service_contract_cost; ?>">
            </div>
            <div class="col-md-3">
                <label for="status">STATUS</label>
                <select class="form-control" name="status" value="<?= $details->status; ?>">
                    <option>Working</option>
                    <option>Non-Working</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="remarks">REMARKS</label>
                <input type="text" class="form-control" name="remarks" value="<?= $details->remarks; ?>">
            </div>
            <div class="col-md-3">
                <label for="vendor">VENDOR</label>
                <input type="text" class="form-control" name="vendor" value="<?= $details->vendor; ?>">
            </div>
            <div class="col-md-3">
                <label for="location">LOCATION</label>
                <select class="form-control" name="location" value="<?= $details->location_name; ?>">
                        <?php
                            foreach($locations as $rows){
                                if($rows->location_name == $details->location_name ){
                                   echo '<option selected>'.$rows->location_name.'</option>';
                                }else{
                                   echo '<option>'.$rows->location_name.'</option>'; 
                                } }
                        ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="serial">ITEM'S SERIAL NUMBER</label>
                <input type="text" class="form-control" name="serial" value="<?= $details->item_serial_number; ?>">
            </div>
            <div class="col-md-4">
                <label for="bar_code">BAR CODE</label>
                <input type="text" class="form-control" name="bar_code" value="<?= $details->bar_code; ?>">
            </div>
            <div class="col-md-4">
                <label for="asset_type">ASSET TYPE</label>
                <select class="form-control" name="asset_type" value="<?= $details->asset_type; ?>">
                   	<option>FIXED ASSET</option>
                    <option>CURRENT ASSET</option>
                </select>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="update_inventory()">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>               
    </div>