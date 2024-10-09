
<main id="main" class="main">

	<div class="pagetitle">
		<h1>Book 02 Report </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Book2_Report</a></li>
			</ol>
		</nav>
	</div> <!--End of page title -->

	<div class="card">
		<div class="card-body">
			<div class="card-title">Creating Book 02 Report </div>
			<!-- Settings Form -->
      <div id="book2_response_message"></div>
            <form id="book2_form" method="post">
                <div class="row mb-3">
                    <label for="year" class="col-sm-2 col-form-label">Select Year</label>
                    <div class="col-sm-3">
                          <select class="form-control" id="year_selected" name="year_selected">
                          <?php
                            $year = 2019;
                            while ($year < date("Y")){
                            $year++;
                            ?>
                          <option><?php echo $year; ?></option>
                            <?php }; ?>
                        </select>
                      </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary" id="create_book2_btn" name="create_book2_btn">Upload</button>
                    </div>
                </div>
            </form>
            <!-- End settings Form -->
            <br />
        <div id="book2_table_data"></div>
		</div>
	</div>
</main>

<script type="text/javascript">
    function print(){
        var mywindow = window.open('', '_blank', 'width=900,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/core.min.css" rel="stylesheet" type="text/css" />');
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/minified/components.min.css" rel="stylesheet" type="text/css" />');
        //specific print css
        mywindow.document.write('</head><body >');

        mywindow.document.write(document.getElementById('print_area').innerHTML);

        mywindow.print();
        mywindow.close();

        return true;
    }

    function export_to_excel(month){
        // var this_month = document.getElementById("roster_name").value;
        // var message = this_month + ' roaster';
        $("#myTable").table2excel({
            exclude: ".no-export", // Add class 'no-export' to elements you want to exclude from export
             // Name of the Excel file
            fileext: ".xls", // File extension (".xls" for Excel 2003 or older, ".xlsx" for Excel 2007 or newer)
            preserveColors: true
          });
    }
</script>