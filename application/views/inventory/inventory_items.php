<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add/Edit Inventory Items</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Welcome to Inventory Items</li>
          <!-- <li class="breadcrumb-item active">Profile</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs d-flex">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#create">Create Items(Form)</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#summary">Items Summary</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#location">Add Location</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#new_item">Add New Item</button>
                </li>

              </ul>


              <div class="tab-content pt-2">

<!--********************************** INVENTORY FORM *********************************************-->
                <div class="tab-pane show active" id="create">
                  
                  <!-- employee who are waiting hr editing and approval -->
                  <div class="card">
                    <div class="card-body">
                      <!-- start of table for displaying data -->
                      <div class="col-lg-12">
                        <h3 class="card-title"><b>FAME HOSPITAL INVENTORY</b></h3>
                        <div><?= $this->session->flashdata('inventory_insert_sms'); ?></div>
                        <div id="items_form_insert"></div>

                        <form class="row g-3" id="inventory_form" method="post">
                        <div class="col-md-6">
                          <label for="names">ITEM NAME</label>
                          <input type="text" class="typeahead form-control" name="item" id="item">
                        </div>
                        <div class="col-md-4">
                          <label for="today">BRAND</label>
                            <input type="text" class="form-control" name="brand" id="today">
                        </div>
                        <div class="col-md-4">
                          <label for="idara">CATEGORY</label>
                          <select class="form-control" name="category" id="category">
                            <option>FURNITURES AND FITTINGS</option>
                            <option>MEDICAL EQUIPMENTS</option>
                            <option>OFFICE EQUIPMENTS</option>
                            <option>ELECTRONIC DEVICES</option>
                            <option>MACHINE</option>
                            <option>DOMESTIC EQUIPMENT</option>
                          </select> 
                        </div>
                         <div class="col-md-4">
                          <label for="year_of_purchase">Year of Purchase</label>
                          <input type="number" class="form-control" name="year_of_purchase">
                        </div>
                         <div class="col-md-4">
                          <label for="average_years">Average year of Life(years)</label>
                          <input type="number" class="form-control" name="average_years">
                        </div>
                         <div class="col-md-3">
                          <label for="purchase_price">Price at Puchase</label>
                          <input type="number" class="form-control" name="purchase_price">
                        </div>
                         <div class="col-md-3">
                          <label for="service_cost">Service Contract cost</label>
                          <input type="number" class="form-control" name="service_cost">
                        </div>

                        <div class="col-md-3">
                          <label for="status">STATUS</label>
                          <select class="form-control" name="status">
                            <option>Working</option>
                            <option>Non-Working</option>
                          </select>
                        </div>
                         <div class="col-md-3">
                          <label for="remarks">REMARKS</label>
                          <input type="text" class="form-control" name="remarks">
                        </div>
                         <div class="col-md-3">
                          <label for="vendor">VENDOR</label>
                          <input type="text" class="form-control" name="vendor">
                        </div>
                         <div class="col-md-5">
                          <label for="location">LOCATION</label>
                          <select class="form-control" name="location" id="item_location" onchange="create_bar_code()">
                            <option></option>
                           <! <?php
                              foreach($location as $rows){
                                ?>
                                <option><?= $rows->location_name; ?></option>
                                <?php
                              }
                            ?> 
                          </select>
                        </div>

                        <div class="col-md-4">
                          <label for="serial">ITEM'S SERIAL NUMBER</label>
                          <input type="text" class="form-control" name="serial">
                        </div>
                         <div class="col-md-4">
                          <label for="bar_code">BAR CODE</label>
                          <div id="bar_code">
                            <input type="text" class="form-control" name="bar_code" readonly>
                          </div>
                        </div>
                         <div class="col-md-4">
                          <label for="asset_type">ASSET TYPE</label>
                          <select class="form-control" name="asset_type">
                            <option>FIXED ASSET</option>
                            <option>CURRENT ASSET</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="asset_type">How many item(count)</label>
                          <input type="text" name="count" class="form-control" value="1">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" name="" onclick="inventory()">Submit</button>
                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                        </form>
                        
                        </div>
                      <!-- End of displaying data table -->
                    </div>
                  </div>
                </div>
<!--**********************************END OF INVENTORY FORM *********************************************-->

<!--**********************************ITEMS SUMMARY DEPARTMENT-WISE TAB*********************************************-->  

                <div class="tab-pane fade pt-3" id="summary">

                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Department-wise inventory</h4>
                      <form method="post"  id="department_item_form" class="row g-3">
                        <!-- print error or success message -->
                        <div id="department_item_response"></div>
                          <div class="row mb-3">
                            <label for="location" class="col-sm-2 col-form-label">Choose Location</label>
                             <div class="col-sm-4">
                               <select class="form-control"  name="location">
                                <?php 
                                    foreach($location as $loc){
                                ?>
                                <option><?= $loc->location_name; ?></option>
                                <?php } ?>
                              </select>
                             </div>
                              <div class="col-sm-2">
                                <button type="button" class="btn btn-primary" onclick="department_item()">Search</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>

                  <!-- start to display department's items -->
                  <div id="department_items"></div>

                </div>
<!--        ****END OF ITEMS SUMMARY***    -->

<!--**********************************ADD LOCATION TAB*********************************************-->
                <div class="tab-pane fade pt-3" id="location">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Add new Location </div>
                      <form id="new_location_form" method="post">
                        <div id="new_location_response"></div>
                        <div class="row mb-3">
                          <label for="new_location" class="col-sm-2 col-form-label">Create New Location</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" name="new_location">
                        </div>
                        <div class="col-sm-2">
                          <button class="btn btn-primary" onclick="create_new_location()">create</button>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
              
                </div>

<!--**********************************END OF ADD LOCATION TAB*********************************************-->

<!--**********************************START OF ADD NEW ITEM TAB*********************************************-->
                 <div class="tab-pane pt-3" id="new_item">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Add new items in item's lists</div>
                      <form id="new_item_form" method="post">
                        <div id="new_item_response"></div>
                        <div class="row mb-3">
                          <label for="new_item" class="col-sm-2 col-form-label">Create New Item</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" name="new_item">
                        </div>
                        <div class="col-sm-2">
                          <button class="btn btn-primary" onclick="create_new_item()">create</button>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  </div>
                </div> 
<!--**********************************END OF ADD NEW ITEM TAB*********************************************-->  
 

<!--**********************************END OF LEAVE SUMMARY TAB*********************************************-->   

                </div> <!-- End of Tab Body -->
              </div><!-- End Of Main Card Body -->
            </div> <!-- End Of Main Card -->
          </div> <!-- End Of Main Column Div -->
        </div> <!-- End Of Main Row Div -->
      
    </section>

    <!--ALL MODEL WILL BE IMPLEMENTED HERE-->
      
</main><!-- End #main -->

<script type="text/javascript">
  $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('<?php echo base_url('inventory/inventory_items/items_lists_autosuggestion'); ?>', { query: query }, function (response) {
                console.log(response);
                response  = $.parseJSON(response);
                return process(response);
            });
        }
    });

  function inventory(){
    $("#inventory_form").validate({
    
        rules: {
            item: {
                required: true,
            },
      category: {
                required: true,
            },
      status: {
                required: true,
            },
      location: {
                required: true,
            },
      bar_code: {
                required: true,
            },
      asset_type: {
                required: true,
            },  
        },
        messages: {
            item:{
              required: "<span style='color:#ce0000;'>by entering the first letter of item's name please select the item.</span>"
             },
      category:{
        required: "<span style='color:#ce0000;'>select the item's category!!</span>"
       },
       status:{
        required: "<span style='color:#ce0000;'>select the item's status!!</span>"
       },
       location:{
        required: "<span style='color:#ce0000;'>select item's location!!</span>"
       },
       bar_code:{
         required: "<span style='color:#ce0000;'>Please create the bar-code for item!!</span>"
       },
       asset_type:"<span style='color:#ce0000;'>select the items's type!!</span>",
        },
        submitHandler: inventoryFormInsert   
    });  

    /*in here we handle inventory form data insert */
    function inventoryFormInsert(){
      var data = $("#inventory_form").serialize();                
         $.ajax({               
            type : 'POST',
            url  : "<?php echo base_url() ?>inventory/Inventory_Form/insert_items",
            data : data,
            beforeSend: function(){ 
                $("#items_form_insert").fadeOut();
            },
        success : function(response){   
              window.location.reload();
            }
        });
        return false;
    } 
  }

  // here we handle displaying department's items with the btn to edit and delete/deactivate
  function department_item(){
    var data = $("#department_item_form").serialize(); 
    $.ajax({
            url: "<?php echo base_url() . 'inventory/inventory_items/department_summary'; ?>",
            type: "POST",
            data: data,
            success: function (response) {
            $('#department_items').html(response);
            },
            error: function () {
                alert('Error Occured');
            }
        });
  }

  //in here we create new location for inventory system

  function create_new_location(){
    // alert('hello there');
    $("#new_location_form").validate({
        rules: {
            new_location: {
                required: true,
            },  
        },
        messages: {
            new_location:{
              required: "<span style='color:#ce0000;'>Please write the new name of the location to be created .</span>"
             },
        },
        submitHandler: createNewLocation   
    }); 
    function createNewLocation(){
      var data = $("#new_location_form").serialize(); 
      $.ajax({
            url: "<?php echo base_url() . 'inventory/inventory_items/create_new_location'; ?>",
            type: "POST",
            data: data,
            success: function (response) {
              $("input[type=text]").val('')
              $('#new_location_response').html(response);
            },
            error: function () {
                // alert('Error Occured');
            }
        });
    }

  }

  function create_new_item(){
    // alert('hello there');
    $("#new_item_form").validate({
        rules: {
            new_item: {
                required: true,
            },  
        },
        messages: {
            new_item:{
              required: "<span style='color:#ce0000;'>Please write the new name of the item to be created .</span>"
             },
        },
        submitHandler: createNewItem   
    }); 
    function createNewItem(){
      var data = $("#new_item_form").serialize(); 
      $.ajax({
            url: "<?php echo base_url() . 'inventory/inventory_items/create_new_item'; ?>",
            type: "POST",
            data: data,
            success: function (response) {
              $("input[type=text]").val('')
              $('#new_item_response').html(response);
            },
            error: function () {
                // alert('Error Occured');
            }
        });
    }
  }

  function create_bar_code(){
    var location = $('#item_location').val();
    var item_name = $('#item').val();
    if(location != '' && item != ''){
      $.ajax({
          type: "post",
          url: "<?php echo base_url(); ?>inventory/inventory_items/get_suggested_barCode",
          data:{
                "location" : location,
                "item_name" : item_name
              },
          beforSend:function(){
            // $("#end_date").fadeOut();
          },
          success:function(response){
            $('#bar_code').html(response);
          }
      });
    }else{
      alert('select item name to get autosuggestion of item bar_code');
    }   
  }


  function generateAllParticularItem(item_id,location_id){
        var data = {"item_id":item_id,"location_id":location_id};
        $.ajax({
                url: "<?php echo base_url() . 'inventory/inventory_items/getAllParticularItem'; ?>",
                type: "POST",
                data: data,
                success: function (response) {
                  $('#department_items').html(response);
                },
                error: function () {
                    alert('Error Occured');
                }
            });

      }

  function delete_item(inventory_id,item_key,location_id){
    var data = {"inventory_id" : inventory_id, "item_key" : item_key, "location_id" : location_id};
        $.ajax({
                url: "<?php echo base_url() . 'inventory/inventory_items/delete_item'; ?>",
                type: "POST",
                data: data,
                success: function (response) {
                  $('#department_items').html(response);
                },
                error: function () {
                    alert('Error Occured');
                }
            });
  }

</script>