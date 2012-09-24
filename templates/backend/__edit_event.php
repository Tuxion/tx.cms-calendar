<?php namespace components\calendar; if(!defined('TX')) die('No direct access.'); tx('Account')->page_authorisation(2);
$uid = tx('Security')->random_string(20);
?>

<form method="post" id="<?php echo $uid; ?>" action="<?php echo url('action=calendar/save_event/post'); ?>" class="form edit-event-form">

  <input type="hidden" name="id" value="<?php echo $edit_event->event->id ?>" />

  <div class="ctrlHolder">
    <label for="l_title" accesskey="t"><?php __('Title'); ?></label>
    <input class="big large" type="text" id="l_title" name="title" value="<?php echo $edit_event->event->title; ?>" required />
  </div>

  <div class="ctrlHolder">
    <label for="l_description" accesskey="a"><?php __('Description'); ?></label>
    <textarea name="description" id="<?php echo $uid; ?>-l_description" class="editor"><?php echo $edit_event->event->description; ?></textarea>
  </div>

  <div class="ctrlHolder">
    <label for="l_dt_start"><?php __('Start date'); ?></label>
    <input class="big large" type="text" id="l_dt_start" name="dt_start" value="<?php echo $edit_event->event->dt_start; ?>" />
  </div>

  <div class="ctrlHolder">
    <label for="l_dt_end"><?php __('End date'); ?></label>
    <input class="big large" type="text" id="l_dt_end" name="dt_end" value="<?php echo $edit_event->event->dt_end; ?>" />
  </div>
  
  <div class="ctrlHolder">
    <label for="l_title" accesskey="t"><?php __('Category'); ?></label>
    <?php echo $data->categories->as_options('category_id', 'title', 'id', $edit_event->event->category_id); ?>
  </div>
  
  <!--
  <div class="ctrlHolder">
    <label for="l_name" accesskey="g"><?php __('All day'); ?></label>
  -->
    <input type="checkbox" style="visibility:hidden;" id="all_day" name="all_day" value="1" checked />
  <!--
  </div>
  -->

  <?php echo form_buttons(); ?>

</form>

<script type="text/javascript">

  $(function(){

    //init editor
    tx_editor.init({selector:"#<?php echo $uid; ?>-l_description"});

    $('#l_dt_start, #l_dt_end').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: 'hh:mm',
      regional: "nl"
    });
    
    $.datepicker.setDefaults($.datepicker.regional["nl"]);

  });

</script>
