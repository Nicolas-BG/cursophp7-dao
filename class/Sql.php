<?php 

class Sql extends PDO {

	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:dbname=dbphp8;host=localhost", "root", "");
	}

	private function setParams($statment, $parameters = array()) {
		foreach ($parameters as $key => $value) {
			$this->setParam($statment, $key, $value);
		}
	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}

	public function execQuery($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);
	
		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = array()):array{
		$stmt = $this->execQuery($rawQuery, $params);

		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}


}


?>