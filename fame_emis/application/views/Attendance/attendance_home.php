<main id="main" class="main">

<div class="pagetitle">
  <h1>Weekly Attendance</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="" href="<?php echo base_url('profile_management'); ?>">Home /
        <span>Attendance</span>
      </a>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card-body">
  <div class="col-lg-12">
        <!--here we implement the retrieval of monthly report -->
        <?php $this->load->view('attendance/attendance_report_specifics'); ?>

        <div id="weekly_report"></div>
  </div>
</div>

</main><!-- End #main -->

<script type="text/javascript" language="javascript">
  function autogenerateWeeks () {
    const selectedYear = document.getElementById('year').value;
    const weekSelect = document.querySelector('select[name="week"]');
    
    // Clear existing options
    weekSelect.innerHTML = '';

    // Generate options for weeks based on the selected year
    for (let week = 1; week <= 52; week++) {
      const startDate = getStartDate(selectedYear, week).toISOString().slice(0, 10);
      const endDate = getEndDate(selectedYear, week).toISOString().slice(0, 10);
      const weekDisplay = `Week ${week} ${startDate} - ${endDate}`;
      
      // Create a new option element and set its value and text
      const option = document.createElement('option');
      option.value = `${selectedYear}-W${week}`;
      option.textContent = weekDisplay;

      // Append the option to the select element
      weekSelect.appendChild(option);
    }
  }

  // Function to get the start date of a week in a year (starting on Monday)
  function getStartDate(year, week) {
    const januaryFirst = new Date(year, 0, 1);
    const dayOffset = (1 - januaryFirst.getDay() + 7) % 7; // Adjusted dayOffset

    // Calculate the first Monday of the year
    const firstMonday = new Date(year, 0, dayOffset + 2);

    // Calculate the start date of the specified week
    const startDate = new Date(firstMonday.getFullYear(), 0, firstMonday.getDate() + (week - 1) * 7);

    return startDate;
  }
  // Function to get the end date of a week in a year (ending on Sunday)
  function getEndDate(year, week) {
    const startDate = getStartDate(year, week);
    const endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + 6);
    return endDate;
  }

  //initial call to generate weeks option for default year 
  autogenerateWeeks();

  function create_weekly_attendance_report(e){
    e.preventDefault();
    var data = $("#attendance_report").serialize();                
      $.ajax({               
        type : 'POST',
        url  : "<?php echo base_url() ?>attendance/print_weekly_report",
        data : data,
        beforeSend: function(){ 
          // $("#response_message").fadeOut();
        },
        success : function(response){ 
          $('#weekly_report').html(response);
          }
        });
        return false;
  }

</script>