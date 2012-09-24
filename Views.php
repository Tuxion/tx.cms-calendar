<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

class Views extends \dependencies\BaseViews
{

  protected function calendar1($options)
  {
    return array(
      'event' =>
        $this
        ->table('Events')
          ->pk(tx('Data')->get->event_id->get('int'))
          ->execute_single()
        ->otherwise(false)
    );
  }

  protected function events_admin()
  {
    
    return array(
      'event_list' => $this->section('event_list'),
      'new_event' => $this->section('edit_event')
    );
    
  }
 
}
