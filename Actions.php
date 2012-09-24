<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

class Actions extends \dependencies\BaseComponent
{
  protected
    $default_permission = 2;
    
  protected function save_event($data)
  {

    //update
    $that = $this;
    tx($data->id->get('int') > 0 ? 'Updating an event.' : 'Adding a new event.', function()use($data, $that){

      $data =
        $data->having('id', 'calendar_id', 'category_id', 'title', 'description', 'location', 'all_day', 'dt_start', 'dt_end');

      $data->dt_end
        = $data->dt_end->otherwise('0000-00-00 00:00:00');
      
      $data->category_id
        = $data->category_id->otherwise('0');
        
      $that->table('Events')->pk($data->id)->execute_single()->is('empty')
        ->success(function($event_info)use($data){
          tx('Sql')->model('calendar', 'Events')->set($data->having('calendar_id', 'category_id', 'title', 'description', 'location', 'all_day', 'dt_start', 'dt_end'))->merge(array('dt_created'=>date("Y-m-d H:i:s")))->save();
        })
        ->failure(function($event_info)use($data){
          $event_info->merge($data)->merge(array('dt_last_modified'=>date("Y-m-d H:i:s")))->save();
        });

    })
    
    ->failure(function($info){
      throw $info->exception;
      tx('Controller')->message(array(
        'error' => $info->get_user_message()
      ));
    });
    
    tx('Url')->redirect('section=calendar/event_list&event_id=NULL');
    
  }
  
  protected function delete_event($data)
  {
    
    $item = $this->table('Events')->pk($data->event_id)->execute_single()->is('empty', function()use($data){
      throw new \exception\User('Could not delete this item, because no event was found in the database with id %s.', $data->event_id);
    })
    ->delete();

  }

  
}
