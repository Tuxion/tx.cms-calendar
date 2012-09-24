<?php namespace components\calendar\models; if(!defined('TX')) die('No direct access.');

class Categories extends \dependencies\BaseModel
{
  
  protected static
    
    $table_name = 'calendar_categories',
    
    $relations = array(
      'Events' => array('id' => 'Events.category_id')
    );

}
