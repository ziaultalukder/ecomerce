<?php
if($_GET['id']){
	$id=$_GET['id'];
}
?>


<?php
$name="";
$db= new Database();
$validation = new validation();


if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$validation->post('name')
	           ->isempty()
	           ->length(5,20);

	           $name = $validation->values['name'];
	           $sql="update warranty set name='".$name."' where id=".$id;

	if ($validation->submit()) {
		if($db->update($sql)){
			$name="";
			echo '<script>
			window.location="'.ADMIN_URL.'displaywarrenty"
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
	$sql="select * from warranty where id=".$id;
	foreach ($db->getdata($sql) as  $value) {
		$name=$value['name'];
	}
}
?>

<form action="" method="post">
	<fieldset>
		<legend>Warrenty Info</legend>
		<label>Warrenty Product</label><br>
		<input type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Here">

		<br><br>
		<input type="submit" name="btn" value="update Data">
	</fieldset>
</form>