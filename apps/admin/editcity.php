<?php
if($_GET['id']){
	$id=$_GET['id'];
}
?>

<?php

$db= new Database();
$validation = new validation();
$name="";
$countryid=0;

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$validation->post('name')
	           ->isempty()
	           ->length(5,20);


	$name = $validation->values['name'];
	$countryid = $_POST['countryid'];
	if($countryid == 0){
		$sql="update city set name='".$name."' where id=".$id;
	}
	else{
		$sql="update city set name='".$name."', countryid=".$countryid." where id=".$id;

	}
	
	if ($validation->submit()) {
		if($db->update($sql)){
			$name="";
			$countryid="";

			echo '<script>
			window.location ="'.ADMIN_URL.'displaycity"
			</script>';
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
else{
	$sql="select * from city where id=".$id;
	foreach ($db->getdata($sql) as $value) {
		$name= $value['name'];
		$countryid = $value['countryid'];
	}
}
?>

<form action="" method="post">
	<fieldset>
		<legend>Catagory Info</legend>
		<label>Sub-Catagory</label><br>
		<input type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Here">
		<br><br>
		<label>Catagory Name</label><br>
		<select name="countryid">
			<option value="0">Select</option>
			<?php
				$sql="select * from country";
				foreach ($db->getdata($sql) as $value) {
					if($countryid == $value['id']){
						echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
					}
					else{
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
					
				}

			?>
		</select>
		<br><br>
		<input type="submit" name="btn" value="Save Data">
	</fieldset>
</form>