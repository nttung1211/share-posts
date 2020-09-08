<?php


class User {
	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function findUserByUsername(string $username) {
		$this->db->prep("SELECT * FROM users WHERE username = :username;");
		$this->db->bind(':username', $username);
		$this->db->exec();
		return $this->db->getCount() > 0;
	}

	public function findUserByEmail(string $email) {
		$this->db->prep("SELECT * FROM users WHERE email = :email;");
		$this->db->bind(':email', $email);
		$this->db->exec();
		return $this->db->getCount() > 0;
	}

	public function register(array $data) {
		$this->db->prep("
			INSERT INTO
				users
			SET
				username = :username,
				password = :password,
				email = :email;
		");
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':email', $data['email']);
		$this->db->exec();
	}

	public function login(array $data) {
		$this->db->prep("SELECT * FROM users WHERE username = :username;");
		$this->db->bind(':username', $data['username']);
		$user = $this->db->getOneObj();

		if (password_verify($data['password'], $user->password)) {
			return $user;
		}

		return false;
	}

	public function getUserById(int $id) {
		$this->db->prep("SELECT * FROM users WHERE id = :id;");
		$this->db->bind(':id', $id);
		return $this->db->getOneObj();
	}
}