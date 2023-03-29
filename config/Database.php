<?php
require 'env.php';

class Database {
	private $host = DB_HOST;
	private $db_name = DB_NAME;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $conn;

	// DB Connect
	public function connect()
	{
		// close connection
		$this->conn = null;

		try {
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
		} catch (PDOException $e) {
			echo 'Connection Error: ' . $e->getMessage();
		}

		return $this->conn;
	}
}
