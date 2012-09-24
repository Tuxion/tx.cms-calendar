<?php namespace components\calendar\models; if(!defined('TX')) die('No direct access.');

class Events extends \dependencies\BaseModel
{
  
  protected static
    
    $table_name = 'calendar_events',

    $relations = array(
      'Categories' => array('category_id' => 'Categories.id')
    );

}
