<!--

 * @ project fame_emis
 *
 * @author      Syliverius Syliakus Aporinary
 * @version     2.7
 * @since       2023-12-22
 * @description This page is used do diplay all partricular items on a specified department .
 * @license     Open Source

-->

<div class="card">
  <div class="card-body">

    <div class="card-title"> All <?= $this->lists->get_item_name($item_id)->item_name; ?> found  in <?= $this->lists->get_location_name($location_id)->location_name; ?></div>
    <?php if(isset($sms)) { echo $sms; } ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Item Name</th>
            <th scope="col">Year of purchase</th>
            <th scope="col">Status</th>
            <th scope="col">Brand</th>
            <th scope="col">Vendor</th>
            <th scope="col">Bar Code</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($items)){
            echo "
                  <tr>
                    <th colspan='4'><div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Sorry we could not find the selected item in this location . <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></th>
                  </tr>";
           }else{ 
            foreach($items as $row){
              echo '<tr><td>'.$row->item_name.'</td>';
                  echo '<td>'.$row->year_purchased.'</td>';
                  echo  '<td>'.$row->status.'</td>';
                  echo  '<td>'.$row->brand.'</td>';
                  echo '<td>'.$row->vendor.'</td>';
                  echo  '<td>'.$row->bar_code.'</td>';
                  echo '<td>';
                  echo '<button type="button" class="btn  btn-primary view_edit_inventory" onclick="view_edit_inventory('.$row->inventory_id.')">View/Edit</button> ';
                  echo '<button type="button" class="btn  btn-danger" onclick="delete_item('.$row->inventory_id.','.$row->item_key.','.$row->location_id.')">Delete</button>';
                  echo '</td></tr>';
            }
           } ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- INVENTORY EDIT/VIEW MODAL -->
<div class="modal fade" id="inventory_view_edit" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <b>EDIT&EDIT INVENTORY FORM </b></h4>
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