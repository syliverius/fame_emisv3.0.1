<div class="container-fluid p-3">
	<div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('importFrm');"><i class="bi bi-plus-circle"></i> Import Excel</a>
            </div>
        </div>
        <!-- Excel file upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <label for="fileInput" class="visually-hidden">File</label>
                    <input type="file" class="form-control" name="import_file" id="fileInput" />
                </div>
                <div class="col-auto">
                    <input type="button" class="btn btn-primary mb-3" onclick="importAttendance()" value="Submit Report">
                </div>
            </form>
        </div>
        <table class="table table-bordered border-primary">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>Names</th>
                    <th>Dapartment</th>
                    <th>Timestamp</th>
                    <th>Status Description</th>
                </tr>
            </thead>
            <tbody id="imported_table_data">
                <tr><td colspan="5">No Records imported...</td></tr>
            </tbody>
        </table>
    </div>
</div>