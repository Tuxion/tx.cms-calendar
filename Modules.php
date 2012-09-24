<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

class Modules extends \dependencies\BaseViews
{
  
  protected function calendar1_week()
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

}
