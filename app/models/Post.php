<?php


class Post {
	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function getPosts() {
		$this->db->prep("SELECT * FROM posts;");
		return $this->db->getObjs();
	}

	public function getMyPosts(int $id) {
		$this->db->prep("SELECT * FROM posts WHERE user_id = :user_id;");
		$this->db->bind(':user_id', $id);
		return $this->db->getObjs();
	}

	public function findPostTitle(string $title) {
		$this->db->prep("SELECT * FROM posts WHERE title = :title;");
		$this->db->bind(':title', $title);
		$this->db->exec();
		return $this->db->getCount() > 0;
	}

	public function add(array $data) {
		$this->db->prep("
			INSERT INTO 
				posts
			SET
			  user_id = :user_id,
				title = :title,
			  body = :body;
		");

		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->exec();
	}

	public function edit(array $data, int $id) {
		$this->db->prep("
			UPDATE 
				posts
			SET
				title = :title,
			  body = :body
			WHERE
				id = :id;
		");

		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':id', $id);
		$this->db->exec();
	}

	public function delete(int $id) {
		$this->db->prep("DELETE FROM posts WHERE id = :id;");
		$this->db->bind(':id', $id);
		$this->db->exec();
	}

	public function getPostById(int $id) {
		$this->db->prep("SELECT * FROM posts WHERE id = :id;");
		$this->db->bind(':id', $id);
		return $this->db->getOneObj();
	}
}