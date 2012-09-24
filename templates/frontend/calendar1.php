<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

echo load_plugin('fullcalendar');

if($calendar1->event->title->is_set())
{

  ?>

<div class="event">
  
  <h1><?php echo $calendar1->event->title; ?></h1>
  
  <p>
    <?php echo $calendar1->event->description; ?>
  </p>
  
  <a href="index.php?pid=572" class="fc-button">&laquo; Terug naar de kalender</a>
  
</div>
  
  <?php
  
}
else
{

  ?>
<div id="calendar1"></div>

<script type="text/javascript">
  $("#calendar1").fullCalendar({

    events: "<?php echo url('section=calendar/json_calendar_data'); ?>",

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    defaultView: 'basicWeek',
    firstDay: 1,
    monthNames: ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'],
    monthNamesShort: ['Jan','Feb','Maa','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],
    dayNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
    dayNamesShort: ['Zon','Maa','Din','Woe','Don','Vri','Zat'],
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
      week: "d[ yyyy]{ '-'[ MMM] d MMMM yyyy}",
      day: 'dddd d MMMM yyyy'
    },
    columnFormat: {
      month: 'ddd',
      week: 'ddd M/d',
      day: 'dddd M/d'
    },
    timeFormat: { // for event elements
      '': 'h(:mm)t' // default
    }
  
  });
</script>

<style type="text/css">

.fc-header-title h2{
  margin-top:4px;
}

.fc-event-skin{
/*
  background-color:#EC7404;
  background-image: -moz-linear-gradient(center bottom , #EC7404 0%, #F49434 100%);
  border:solid #EC7404 0px;
  */
}

</style>

  <?php
  }
?>