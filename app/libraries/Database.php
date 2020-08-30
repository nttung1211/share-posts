<?php

class Database {
	private string $host = DB_HOST;
	private string $user = DB_USER;
	private string $password = DB_PASSWORD;
	private string $dbname = DB_NAME;

	private PDO $dbHandler;
	private $stmt;
	private string $error;

	public function __construct() {
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		// + CONNECT TO DATABASE
		try {
			$this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
		}	catch(PDOException $exception) {
			$this->error = $exception->getMessage();
			echo $this->error;
		}
	}

	public function prep(string $query) {
		$this->stmt = $this->dbHandler->prepare($query);
	}

	public function bind($param, $value, $type = null) {
		if (is_null($type)) {
			switch (true) {
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->stmt->bindValue($param, $value, $type);
	}

	public function exec() {
		$this->stmt->execute();
	}

	public function getObjs() {
		$this->exec();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getOneObj() {
		$this->exec();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	public function getCount() {
		return $this->stmt->rowCount();
	}
}