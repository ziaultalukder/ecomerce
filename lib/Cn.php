<?php
/**
* connection class
*/
abstract class Cn{

	private $dbname="ecomerce";
	private $user="root";
	private $password="";
	private $host="localhost";
	protected $db;
	public $error;

	function __construct(){
		$this->connection();

	}
	public function connection()
	{
		try{
			$this->db = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host,$this->user,$this->password);
		}
		catch(PDOExecption $ex){
			$this->error=$ex.getMessage();
		}
	}
}



?>