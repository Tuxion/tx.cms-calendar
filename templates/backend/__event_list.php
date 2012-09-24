<?php namespace components\calendar; if(!defined('TX')) die('No direct access.'); tx('Account')->page_authorisation(2);

?>

<div id="user-table">

<?php

echo $event_list->as_table(array(
  __('Title', 1) => 'title',
  __('Date start', 1) => function($row){
    return $row->dt_start;
  },
  __('Date end', 1) => function($row){
    return $row->dt_end;
  },
  __('Actions', 1) => array(
    function($row){return '<a class="edit" href="'.url('section=calendar/edit_event&event_id='.$row->id).'">'.__('edit', true).'</a>';},
    function($row){return '<a class="delete" href="'.url('action=calendar/delete_event&event_id='.$row->id).'">delete</a>';}
  )
));

?>

</div>

<script type="text/javascript">

  $(function(){

    /* ---------- Edit/add user ---------- */
    $('#tab-events .edit').on('click', function(e){

      e.preventDefault();

      $('#tabber-event')
        .show()
        .find('a')
          .trigger('click')
          .text("<?php __('Edit event'); ?>");

      $.ajax({
        url: $(this).attr('href')
      }).done(function(data){
        $("#tab-event").html(data);
      });

    });
    
    /* ---------- Delete user ---------- */
    $('#tab-events .delete').on('click', function(e){

      e.preventDefault();

      if(confirm("<?php __('Are you sure?'); ?>")){

        $(this).closest('tr').fadeOut();

        $.ajax({
          url: $(this).attr('href')
        });
      }

    });
    
  });
</script>
