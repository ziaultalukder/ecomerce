<?php

$db= new Database();
$validation = new validation();


if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$validation->post('name')
	           ->isempty()
	           ->charecter()
	           ->length(5,20);


	$tablename="Catagory";
	$catagoryid = $_POST['catagoryid'];
	if($catagoryid == 0){
		$data = array('name'=>$validation->values['name']);
	}
	else{
		$data = array('name'=>$validation->values['name'],'catagoryid'=>$catagoryid);

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
		<legend>Catagory Info</legend>
		<label>Sub-Catagory</label><br>
		<input type="text" name="name" placeholder="Enter Here">
		<br><br>
		<label>Catagory Name</label><br>
		<select name="catagoryid">
			<option>Select</option>
			<?php
				$sql="select * from Category";
				foreach ($db->getdata($sql) as $value) {
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}

			?>
		</select>
		<br><br>
		<input type="submit" name="btn" value="Save Data">
	</fieldset>
</form>