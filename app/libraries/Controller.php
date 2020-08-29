<?php

class Controller {
  public function model($model) {
    require_once '../app/models/' . $model . 'php';
    return new $model();
  }

  public function view($view, $data = []) {
    if(file_exists('../app/views/' . $view . '.php')){
      require_once '../app/views/' . $view . '.php'; // this will return code including $data inside. Just like we echo "<div>name = $data['name']"</div> here.
    } else {
      die('<br>View does not exist');
    }
  }
}

