<?php

$db= new Database();
$validation = new validation();


if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$validation->post('name')
	           ->isempty()
	           ->length(5,20);


	$tablename="city";
	$countryid = $_POST['countryid'];
	if($countryid == 0){
		$data = array('name'=>$validation->values['name']);
	}
	else{
		$data = array('name'=>$validation->values['name'],'countryid'=>$countryid);

	}
	
	if ($validation->submit()) {
		if($db->insert($tablename,$data)){
			echo '<span style="color:green;font-size:15px;">Date Added Successfully.....</span>';
		}
	}
	else{
		$mgs = $validation->error;
		echo '<div style="color:red; border:1px solid red; padding:10px; margin:20px auto; width:30%; text-align:center" id="jserror">
		<i class="fa fa-times" aria-hidden="true" style="float:right" id="crosbtn"></i>
		';
		foreach ($mgs as $key => $value) {
			foreach ($value as $key1 => $value1) {
				echo $key1.':'.$value1.'<br>';
			}
		}
		echo '</div>';
	}

}
?>

<form action="" method="post">
	<fieldset>
		<legend>City Info</legend>
		<label>City Name</label><br>
		<input type="text" name="name" placeholder="Enter Here">
		<br><br>
		<label>Country Name</label><br>
		<select name="countryid">
			<option>Select</option>
			<?php
				$sql="select * from country";
				foreach ($db->getdata($sql) as $value) {
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}

			?>
		</select>
		<br><br>
		<input type="submit" name="btn" value="Save Data">
	</fieldset>
</form>