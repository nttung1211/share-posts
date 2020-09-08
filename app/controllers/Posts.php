<?php


class Posts extends Controller {
	private Post $postModel;

	public function __construct() {
		if (!isLoggedIn()) {
			setPopUp('loginMessage', 'You have to login first', 'warning');
			redirectTo('users/login');
		} else {
			$this->postModel = $this->model('Post');
		}
	}

	public function index() {
		$data = [
			'posts' => $this->postModel->getMyPosts(getLoginInfo()['id'])
		];
		$this->view('posts/index', $data);
	}

	public function add() {
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			$this->view('posts/add');
		} else {
			require_once APPROOT . '/helpers/Validator.php';
			$validation = new PostValidator($_POST);
			[$enteredData, $errors] = $validation->validate();

			if (!isset($errors['title']) && $this->postModel->findPostTitle($enteredData['title'])) {
				$errors['title'] = 'This title is already exist';
			}

			$data = [
				'title' => '',
				'enteredData' => $enteredData,
				'errors' => $errors
			];

			if (!empty($errors)) {
				$this->view('posts/add', $data);
			} else {
				$enteredData['user_id'] = getLoginInfo()['id'];
				$this->postModel->add($enteredData);
				setPopUp('postMessage', 'Added post successfully!', 'success');
				redirectTo('posts');
			}
		}
	}

	public function detail(string $id) {
		$post = $this->postModel->getPostById((int)$id);

		if (!$post) {
			setPopUp('postMessage', 'Post not found', 'warning');
			redirectTo('posts');
		}

		$data = [
			'post' => $post
		];

		$this->view('posts/detail', $data);
	}

	public function edit(string $id) {
		$oldPost = $this->postModel->getPostById((int)$id);

		if (!$oldPost) {
			setPopUp('postMessage', 'Post not found', 'warning');
			redirectTo('posts');
		}

		if ($_SERVER['REQUEST_METHOD'] != "POST") {

			if (getLoginInfo()['id'] != $oldPost->user_id) {
				setPopUp('postMessage', 'You cannot edit other\'s post', 'warning');
				redirectTo('posts');
			}

			$data = [
				'title' => '',
				'id' => $id,
				'oldPost' => $oldPost
			];
			$this->view('posts/edit', $data);
		} else {
			require_once APPROOT . '/helpers/Validator.php';
			$validation = new PostValidator($_POST);
			[$enteredData, $errors] = $validation->validate();

			if (!isset($errors['title']) && ($enteredData['title'] != $oldPost->title)) {
				if ($this->postModel->findPostTitle($enteredData['title'])) {
					$errors['title'] = 'This title is already exist';
				}
			}

			$data = [
				'title' => '',
				'id' => $id,
				'enteredData' => $enteredData,
				'errors' => $errors
			];

			if (!empty($errors)) {
				$this->view('posts/edit', $data);
			} else {
				$this->postModel->edit($enteredData, (int)$id);
				setPopUp('postDetailMessage', 'Edited post successfully!', 'success');
				redirectTo('posts/detail/' . $id);
			}
		}
	}

	public function delete(string $id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$oldPost = $this->postModel->getPostById((int)$id);

			if (getLoginInfo()['id'] != $oldPost->user_id) {
				setPopUp('postMessage', 'You cannot delete other\'s post', 'warning');
				redirectTo('posts');
			}

			$this->postModel->delete((int)$id);
			setPopUp('postMessage', 'Deleted post successfully!', 'success');
		}

		redirectTo('posts');
	}
}