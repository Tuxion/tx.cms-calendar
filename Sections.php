<?php namespace components\calendar; if(!defined('TX')) die('No direct access.');

class Sections extends \dependencies\BaseViews
{

  /* ---------- Frontend ---------- */

  protected function json($options)
  {

    switch(tx('Data')->server->REQUEST_METHOD->lowercase()->get()){
      case 'get': $data = tx('Data')->get; $method = 'get'; break;
      case 'post': $data = Data(tx('Data')->xss_clean(json_decode(file_get_contents("php://input"), true))); $method = 'create'; break;
      case 'put': $data = Data(tx('Data')->xss_clean(json_decode(file_get_contents("php://input"), true))); $method = 'update'; break;
      case 'delete': $data = Data(tx('Data')->xss_clean(json_decode(file_get_contents("php://input"), true))); $method = 'delete'; break;
      default: throw new \exception\Programmer('Method "%s" not supported.', tx('Data')->server->REQUEST_METHOD); break;
    }
    
    header('Content-type: application/json');

    if($data->model->is_empty()){
      set_status_header(412, "Model name required.");
      return null;
    }

    $method = "{$method}_{$data->model}";
    
    if(!method_exists($this, $method)){
      set_status_header(501, "Method ".get_class($this)."::$method() missing.");
      return null;
    }
    
    $data->model->un_set();
    $user_function = $this->{$method}($data);

    if( ! $user_function instanceof \dependencies\UserFunction){
      set_status_header(500, "Method ".get_class($this)."::$method() must return an instance of UserFunction.");
      return null;
    }
    
    if($user_function->failure()){
      
      switch($user_function->exception->getExCode()){
        case EX_AUTHORISATION: $code = 401; break;
        case EX_EMPTYRESULT: $code = 404; break;
        case EX_VALIDATION: $code = 412; break;
        default: $code = 500; break;
      }
      
      set_status_header($code, $user_function->get_user_message());
      return null;
      
    }
    
    return Data($user_function->return_value)->as_json();
    
  }

  protected function json_calendar_data($options)
  {

    return $this
      ->table('Events')
      ->join('Categories', $cat)
      ->select("$cat.color_event", 'color_event')
      ->order('dt_start')
      ->where('dt_start', '>=', date("Y-m-d H:i:s", tx('Data')->get->start->get('int')))
      ->where('dt_end', '<=', date("Y-m-d H:i:s", tx('Data')->get->end->get('int')))
      ->execute()
      ->each(function($row){
      
        return
          $row
          ->merge(array(
            'start' => date("Y-m-d", strtotime($row->dt_start)),
            'end' => date("Y-m-d", strtotime($row->dt_end)),
            'allDay' => $row->all_day->get('bool'),
            'color' => $row->color_event,
            'url' => url('?pid=572&event_id='.$row->id, true)->output
          ));
      
      })
      ->as_json(null);

  }

  /* ---------- Backend ---------- */

  protected function edit_event()
  {
    
    return array(
      'event' =>
        $this
        ->table('Events')
        ->pk(tx('Data')->get->event_id)
        ->execute_single(),
      'categories' =>
        $this
        ->table('Categories')
        ->order('title')
        ->execute()
    );
  }
  
  protected function event_list()
  {

    return $this
      ->table('Events')
      ->join('Categories', $cat)
      ->select("$cat.color_event", 'color_event')
      ->order('dt_start', 'DESC')
      ->execute();
    
  }
  
  
}

