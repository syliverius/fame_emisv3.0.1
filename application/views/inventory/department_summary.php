<div class="card">
  <div class="card-body">
    <div class="card-title">Inventory summary for  <?= $location_name; ?>  Year <?= date('Y'); ?> <span></span></div>
      <table class="table table-striped">
        <thead>
          <tr class="text-center">
            <th scope="col">ItemName</th>
            <th scope="col" class="text-center">Total</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
if (isset($dept_items) && is_array($dept_items) && !empty($dept_items)) {
    $items = $this->lists->getAllItems();
    $itemCount = array();

    foreach ($dept_items as $dept_item) {
        if (isset($dept_item->item_name)){
            foreach ($items as $item) {
                if ($item->item_name === $dept_item->item_name) {
                    $itemCount[$dept_item->item_name][$dept_item->item_id] = isset($itemCount[$dept_item->item_name][$dept_item->item_id]) ? $itemCount[$dept_item->item_name][$dept_item->item_id] + 1 : 1;
                    break;
                }
            }
        } else {
            // Log or print a message for debugging
            echo "Dept_item object does not have the expected 'item_name' property: " . print_r($dept_item, true) . PHP_EOL;
        }
    }

    foreach ($itemCount as $itemName => $itemIds) {
        foreach ($itemIds as $itemId => $number) {
            echo '<tr class="text-center">';
            echo '<td>' . $itemName . '</td>';
            echo '<td>' . $number . '</td>';
            echo '<td><button class="btn btn-primary" type="button" onclick="generateAllParticularItem('. $itemId .",". $location_id .')" class="edit-button"  title="Edit"><span class="bi bi-edit"></span >View More</button></td>';
            echo '</tr>';
        }
    } 
        } else {
            echo "
                <tr>
                    <th colspan='4'><div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>No item registered under this location . <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></th>
                </tr>";
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- INVENTORY EDIT/VIEW MODAL -->
<div class="modal fade" id="inventory_view_edit" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <b>VIEW & EDIT INVENTORY FORM </b></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method='post' id="update_inventory_form" action='<?= base_url(); ?>'>
      <div id="inventory_edit_and_view">
        <!-- Here we will pass modal data from the database -->
      </div>
            
      </form>
    </div>
  </div>
</div> 

<script type="text/javascript">
  function view_edit_inventory(value){
    $('#inventory_view_edit').modal('show');

    $.ajax({
            type: "POST",
             url: "<?= base_url(); ?>inventory/inventory_items/item_view_edit",
            data: {
              "inventory_id" : value
            },
            beforSend: function()
            {
               $('#inventory_edit_and_view').html();
            },
            success: function(response){
               $('#inventory_edit_and_view').html(response);
            },
            error: function ()
            {
              //write something in here
            },
        });

  }

  function update_inventory(){
    var data = $("#update_inventory_form").serialize(); 
      $.ajax({
            url: "<?php echo base_url() . 'inventory/inventory_items/update_inventory_item'; ?>",
            type: "POST",
            data: data,
            beforSend: function(){
            },
            success: function (response) {
              $('#inventory_view_edit').modal('hide'); 
              $('#department_items').html(response);
            },
            error: function () {
             // alert('Error Occured');
            }
          });
      }

</script>
