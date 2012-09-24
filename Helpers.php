<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

class Helpers extends \dependencies\BaseComponent
{
  
  public function format_date($date)
  {
    $date = ($date != '' ? $date : 'Nooit ingelogd');
    return $date;
  }
  
}
