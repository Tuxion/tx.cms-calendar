<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

echo load_plugin('fullcalendar', false);

?>

<div id="calendar1_week"></div>

<script type="text/javascript">
  $("#calendar1_week").fullCalendar({

    events: "<?php echo url('section=calendar/json_calendar_data'); ?>",

    header: {
      left: 'prev',
      center: 'title',
      right: 'next'
    },
    eventMouseover: function(event, jsEvent, view){
      
      xOffset = 10;
      yOffset = 20;		

      $("body").append("<p id='tooltip'>"+event.title+"</p>");
      $("#tooltip")
        .css("top",(jsEvent.pageY - xOffset) + "px")
        .css("left",(jsEvent.pageX + yOffset) + "px")
        .fadeIn("fast");	
    },
    eventMouseout: function(){
      $("#tooltip").remove();
    },
    defaultView: 'basicWeek',
    firstDay: 1,
    monthNames: ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'],
    monthNamesShort: ['Jan','Feb','Maa','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],
    dayNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
    dayNamesShort: ['zo','ma','di','wo','do','vr','za'],
    buttonText: {
      prev: '&nbsp;&#9668;&nbsp;',
      next: '&nbsp;&#9658;&nbsp;',
      prevYear: '&nbsp;&lt;&lt;&nbsp;',
      nextYear: '&nbsp;&gt;&gt;&nbsp;',
      today: 'vandaag',
      month: 'maand',
      week: 'week',
      day: 'dag'
    },
    // time formats
    titleFormat: {
      month: 'MMMM yyyy',
      week: "d{ '-' d} MMMM",
      day: 'dddd, MMM d, yyyy'
    },
    columnFormat: {
      month: 'ddd',
      week: 'ddd<br />d',
      day: 'dddd M/d'
    },
    timeFormat: { // for event elements
      '': 'h(:mm)t' // default
    }
  
  });
</script>

<style type="text/css">

.fc-header-title h2{
  font-family:Arial,sans-serif;
  color:#666;
  background:none;
  letter-spacing:normal;
  font-size:12px;
  padding:0;
}

.fc-state-default, .fc-state-default .fc-button-inner{
  background:none;
  border:none;
  color:#adadad;
}

.fc-header .fc-button{
  margin-bottom:0;
}

.fc-content{
  color:#666;
}

.fc-state-default .fc-button-effect span{
  background:none;
}

.fc-widget-content div{
  min-height:20px !important;
}

.fc-event{
  text-indent:-9999px;
  <?php if(tx('Data')->get->cal_view->get('int') !== 2){ ?>
  width:3px !important;
  <?php } ?>
  height:3px !important;
}


#tooltip{
	position:absolute;
	border:1px solid #333;
	background:#f7f5d1;
	padding:2px 5px;
	color:#333;
	display:none;
  z-index:100;
}

</style>