<div class="card">
  <div class="card-body">
    <div class="card-title">Create Menu Book</div>
    <div><?php echo $this->session->flashdata('new_book_response'); ?></div> <!-- as a flashdata -->
    <!-- Settings Form -->
    <form id="menu_specifics_form">
      <div class="row mb-3">
        <label for="date" class="col-sm-2 col-form-label">Select Date</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="date" name="date" max="">  
        </div>
        <label for="location" class="col-sm-2 col-form-label">Select Ward</label>
        <div class="col-sm-4">
          <select class="form-control" id="ward" name="ward">
            <option value="">Select Ward...</option>
            <option value="Ward One"> Medical Ward </option>
            <option value="Surgical Ward"> Surgical Ward </option>
            <option value="Maternity Ward"> Maternity Ward </option>
          </select>
        </div> <br/>
      </div>
      <center>
        <div class="col-sm-2">
            <button type="button" class="btn btn-primary" onclick="create_book(event)">create</button>
        </div>
      </center>
    </form>
  </div>
</div>