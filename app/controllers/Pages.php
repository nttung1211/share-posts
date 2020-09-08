<?php

class Pages extends Controller {

  public function index() {
	  $postModel = $this->model('Post');
    $data = [
    	'title' => 'Share Posts',
			'posts' => $postModel->getPosts()
    ];
    $this->view('pages/index', $data); 
  }

	public function about() {
		$data = [
			'title' => 'About'
		];
		$this->view('pages/about');
	}
}

