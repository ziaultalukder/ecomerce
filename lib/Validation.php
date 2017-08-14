<?php
/**
* validation class
*/
class Validation
{
	public $values = array();
	public $error = array();
	public $currentvalue;
	
	function __construct(){

	}

	public function post($key){
		$this->values[$key] = trim($_POST[$key]);
		$this->currentvalue = $key;
		return $this;
	}

	public function isempty(){
		if(empty($this->values[$this->currentvalue])){
			$this->error[$this->currentvalue]['empty'] = "Field Must Not Be Empty";
		}
		return $this;

	}

	public function selectone(){
		if(empty($this->values[$this->currentvalue])){
			$this->error[$this->currentvalue]['selectone'] = "Select One";
		}
		return $this;

	}

	public function select(){
		if($this->values[$this->currentvalue] == 0){
			$this->error[$this->currentvalue]['select'] = "Select your country";
		}
		return $this;

	}

	public function charecter(){
		if(!preg_match('%^[A-Za-z ]+$%', $this->values[$this->currentvalue])){
			$this->error[$this->currentvalue]['charecter'] = "Input must be charecter";
		}
		return $this;

	}

	public function digit(){
		if(!preg_match('%^[0-9]+$%', $this->values[$this->currentvalue])){
			$this->error[$this->currentvalue]['digit'] = "Input must be digit";
		}
		return $this;

	}


	public function submit(){
		if (empty($this->error[$this->currentvalue])) {
			return true;
		}
		return false;
		return $this;
	}

	public function length($min, $max){
		if(strlen($this->values[$this->currentvalue]) < $min || strlen($this->values[$this->currentvalue]) > $max){
			$this->error[$this->currentvalue]['length'] = "Min Value $min and Max Value $max";
		}
		return $this;
	}

		
}


?>