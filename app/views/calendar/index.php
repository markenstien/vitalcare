<?php build('content') ?>
	<?php Flash::show()?>
	<?php divider()?>
	
	<div id='calendar'></div>
<?php endbuild()?>

<?php build('scripts') ?>
	<script src='<?php echo _path_third_party('calendar/lib/moment.min.js') ?>'></script>
	<script src='<?php echo _path_third_party('calendar/lib/jquery.min.js') ?>'></script>
	<script src='<?php echo _path_third_party('calendar/fullcalendar.min.js') ?>'></script>

	<?php
		$write_json_items = "";

		foreach( json_decode($appointments) as $key => $appointment) 
		{
			if( $key > 0)
				$write_json_items.=',';
			$write_json_items .= "{title:'{$appointment->title}' , start:'{$appointment->date}'}";
		}

	?>
	<script type="text/javascript" defer>
			$(document).ready(function() {

	    $('#calendar').fullCalendar({
	      header: {
	        left: 'prev,next today',
	        center: 'title',
	        right: 'month,agendaWeek,agendaDay,listMonth'
	      },
	      defaultDate: '2021-11-12',
	      navLinks: true, // can click day/week names to navigate views
	      businessHours: true, // display business hours
	      editable: true,
	      events: [
	      	<?php echo $write_json_items?>
	      ]
	    });

	  });

	</script>
<?php endbuild()?>

<?php build('headers') ?>
	<link href='<?php echo _path_third_party('calendar/fullcalendar.min.css') ?>' rel='stylesheet' />
	<link href='<?php echo _path_third_party('calendar/fullcalendar.print.min.css') ?>' rel='stylesheet' media='print' />
	<meta charset='utf-8' />

	<style>
	  #calendar {
	    max-width: 900px;
	    margin: 0 auto;
	  }
	</style>
<?php endbuild()?>

<?php loadTo()?>