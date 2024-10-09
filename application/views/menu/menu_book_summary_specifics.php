<div class="card">
  <div class="card-body">
    <div class="card-title text-center">Generate Department Monthly Roster</div>
      <!-- Settings Form -->
        <form id="menu_summary">
            <div class="row mb-3">
              <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
              <div class="col-sm-4">
                <input type="date" name="start_date" id="start_date" class="form-control">
              </div>

              <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
              <div class="col-sm-4">
                <input type="date" name="end_date" class="form-control" id="end_date">
              </div>
            </div>

            <div class="row mb-3">
              <label for="ward" class="col-sm-3 col-form-label">Choose Ward</label>
                <div class="col-sm-4">
                  <select class="form-control" name="ward" id="ward">
                    <option value="">Choose ward ...</option>
                    <option value="Surgical Ward">Surgical Ward</option>
                    <option value="Ward One">Medical Ward</option>
                    <option value="Maternity Ward">Maternity Ward</option>
                    <option value="All">All</option>
                  </select>
                </div>
            </div class="row mb-3">
            <center>
              <div class="col-sm-3">
                <button type="button" class="btn btn-primary" onclick="generate_menu_summary(event)">create</button>
              </div>
            </center>
        </form>
  </div>
</div>