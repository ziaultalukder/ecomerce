<?php

/**
* 
*/
class Database extends Cn
{
	public $lastid="";
	public $Error;
	function __construct(){
		parent::__construct();
	
	}

	public function insert($tablename,$data){

		 $keys = implode(",", array_keys($data));
		 $values= ':'.implode(",:", array_keys($data));
		 $sql="insert into $tablename ($keys) values ($values)";
		 $stmt= $this->db->prepare($sql);
		 foreach ($data as $key => $value) {  
		 	 $stmt->bindValue($key,$value);	
		 }
		return $stmt->execute();
	}
	public function imageupload($sql){
		$stmt= $this->db->prepare($sql);
		$test= $stmt->execute();
		$this->lastid = $this->db->lastInsertId();
		if($test == 1){
			return true;
		}
		else{
			return false;
		}
	}

	public function insertdata($sql){
		$stmt= $this->db->prepare($sql);
		$test= $stmt->execute();
		$this->lastid = $this->db->lastInsertId();
		if($test == 1){
			return true;
		}
		else{
			$this->Error = $stmt->errorInfo();
			return false;
		}
	}

	public function getdata($sql){
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($sql){
		$stmt = $this->db->prepare($sql);
		return $stmt->execute();
	}

	public function update($sql){
		$stmt=$this->db->prepare($sql);
		return $stmt->execute();
	}


	public function getAuthentication($sql){
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount() >0){
			return true;
		}
		return false;
	}
}

?>