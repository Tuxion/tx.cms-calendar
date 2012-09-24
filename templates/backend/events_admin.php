<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');
echo load_plugin('jquery-ui-timepicker');
?>

<h1><?php echo __('Calendar events'); ?></h1>

<div class="tabs" id="tabs-events">

  <!-- TABS -->
  <ul>
    <li id="tabber-events" class="active"><a href="#tab-events"><?php __('Summary'); ?></a></li>
    <li id="tabber-event"><a href="#tab-event"><?php __('New event'); ?></a></li>
  </ul>
  <!-- /TABS -->

  <!-- CONTENT -->

  <!-- users -->
  <div id="tab-events" class="tab-content">
    <?php echo $events_admin->event_list; ?>
  </div>

  <div id="tab-event" class="tab-content">
    <?php echo $events_admin->new_event; ?>
  </div>

  <!-- /CONTENT -->

</div>

<script type="text/javascript">
  $(function(){

    $("#tabs-events ul").idTabs(function(id){

      if(id != "#tab-event" || $("#tab-event").find("input[name=id]").val() == ""){
        $("#tabber-event").find("a").text("<?php __('New event'); ?>");
        $("#tab-event").find(':input:not([type=submit], [type=checkbox], [type=radio])').val('');
      }

      return true;

    });

  });

  $(function(){

    $('#tabs-events').on('submit', '.edit-event-form', function(e){

      e.preventDefault();

      $(this).ajaxSubmit(function(d){
        $('#tab-events').html(d);
        $('#tabber-events a').trigger('click');
      });

    });

  });

</script>
