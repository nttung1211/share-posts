<?php

/*
 * CALL CONTROLLER BASED ON URL
 */

class Core {
  protected $currentController = 'Pages';
	protected string $currentMethod = 'index';
	protected $params = [];

  public function __construct() {
    $url = $this->getUrl();

    // + look in controllers dir for the first part of the url
    if (isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      $this->currentController = ucwords($url[0]); 
      unset($url[0]); // ? when we do not go to pages then this will not be unset and first part of url will eventually be a parameter. <SELF> This should be outside of this if statement.
    }

    require '../app/controllers/' . $this->currentController . '.php';
    $this->currentController = new $this->currentController();

    // + check the second part of the url
    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    // + check the left of the url 
    $this->params = $url ? array_values($url) : [];

    // call the currentMethod with params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params); // the first param is an array of an object and a string (name of the method).
  }

  public function getUrl() {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }

    return null;
  }
}