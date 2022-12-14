<?php
class user_model extends main_model {

	public function createTable() {
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS users (
			id 			INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username			VARCHAR(255) NOT NULL,
			email				VARCHAR(555) NOT NULL,
			address 		VARCHAR(255) NOT NULL,
			facebook		VARCHAR(255) NOT NULL,
			password		VARCHAR(255) NOT NULL,
			created	DATETIME DEFAULT CURRENT_TIMESTAMP,
			photo		VARCHAR(255) NOT NULL
		)";

		$result = $this->con->query($sql);
		return $result;
	}
}
?>
