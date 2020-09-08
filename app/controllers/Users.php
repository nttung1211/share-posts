<?php


class Users extends Controller {
	private User $userModel;

	public function __construct() {
		$this->userModel = $this->model("User");
	}

	public function register() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->view('users/register');
		} else {
			require_once APPROOT . '/helpers/Validator.php';
			$validation  = new UserRegisterValidator($_POST); //without require, it'll auto load a file from bootstrap.php
			[$enteredData, $errors] = $validation->validate();

			if (!isset($errors['username']) && $this->userModel->findUserByUsername($enteredData['username'])) {
				$errors['username'] = 'This username has been taken.';
			}

			if (!isset($errors['email']) && $this->userModel->findUserByEmail($enteredData['email'])) {
				$errors['email'] = 'This email has been taken.';
			}

			if (!isset($errors['confirmPassword']) && $enteredData['password'] != $enteredData['confirmPassword']) {
				$errors['confirmPassword'] = 'Password does not match.';
			}

			$data = [
				'enteredData' => $enteredData,
				'errors' => $errors
			];

			if (!empty($errors)) {
				$this->view('users/register', $data);
			} else {
				$enteredData['password'] = password_hash($enteredData['password'], PASSWORD_DEFAULT);
				$this->userModel->register($enteredData);
				setPopUp('loginMessage', 'Registered successfully!', 'success');
				redirectTo('users/login');
			}
		}
	}

	public function login() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->view('users/login');
		} else {
			require_once APPROOT . '/helpers/Validator.php';
			$validation  = new UserLoginValidator($_POST);
			[$enteredData, $errors] = $validation->validate();
			$user = null;

			if (!isset($errors['username']) && !$this->userModel->findUserByUsername($enteredData['username'])) {
				$errors['username'] = 'username does not exist.';
			}

			if (empty($errors) && !($user = $this->userModel->login($enteredData))) {
				$errors['password'] = 'password is incorrect.';
			}

			$data = [
				'errors' => $errors,
				'enteredData' => $enteredData
			];

			if (!empty($errors)) {
				$this->view('users/login', $data);
			} else {
				saveLoginInfo($user);
				redirectTo('posts');
			}
		}
	}

	public function logout() {
		clearLoginInfo();
		redirectTo('pages');
	}
}