<main id="main" class="main">

  <div class="pagetitle">
    <h1>Hospital Menu Book</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a class="" href="<?php echo base_url('profile_management'); ?>">Home /
          <span>Menu Book</span>
        </a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-body">
    <div class="col-lg-12">
      <?php $this->load->view('menu/menu_book_specifics'); ?>
    <div id="menu_book"></div>
    </div>
  </div>

</main>

<script type="text/javascript">
  function create_book(e){
    var location = document.getElementById('ward').value;
    var date = document.getElementById('date').value;
    if(!location || !date){
      alert("Please make sure you select correct date and location");
    }else{
      var data = $('#menu_specifics_form').serialize();
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>menu/generate_uneditable_book",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){
            $('#menu_book').html(response);
          }
        });
      return false;
    }
  }
</script>