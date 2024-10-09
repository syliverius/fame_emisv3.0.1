<main id="main" class="main">

	<div class="pagetitle">
		<h1> Menu Book Summary </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('profile_management') ?>">Home</a></li>
				<li class="breadcrumb-item">Menu Book Summary</li>
			</ol>
		</nav>
	</div> <!--End of page title -->

  <div class="card">
    <div class="card-body">
      <?php $this->load->view('menu/menu_book_summary_specifics'); ?>  
      <div id="menu_book_summary_report"></div>           
    </div>
  </div>
</main>

<script type="text/javascript">
  
  function generate_menu_summary(e){
    var ward = document.getElementById('ward').value;
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    if(!ward || !start_date || !end_date ){
      alert("Please make sure you select correct date and location");
    }else{
      var data = $('#menu_summary').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/generate_menu_book_summary",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#menu_book_summary_report').html(response);
          }
        });
      return false;
    }
  }

</script>