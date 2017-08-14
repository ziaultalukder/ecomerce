<?php
if($_GET['id']){
	$id=$_GET['id'];
}
?>
<?php

$db= new Database();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$name = $validation->values['name'];
	$productid = $_POST['productid'];
	if($productid == 0){
		$sql="update productimage set name='".$name."' where id=".$id;
	}
	else{
		$sql="update productimage set name='".$name."', catagoryid=".$productid." where id=".$id;

	}
	
		if($db->update($sql)){
			$name="";
			$productid="";

			echo '<script>
			window.location ="'.ADMIN_URL.'displaycatagory"
			</script>';
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
	$sql="select * from productimage where id=".$id;
	foreach ($db->getdata($sql) as $value) {
		$name= $value['name'];
		$productid = $value['productid'];
	}
}
?>

<form action="" method="post">
	<fieldset>
		<legend>Product-image Info</legend>
		<label>Productimage Catagory</label><br>
		<input type="file" name="name" value="<?php echo $image;?>" enc">
		<br><br>
		<label>Catagory Name</label><br>
		<select name="productid">
			<option value="0">Select</option>
			<?php
				$sql="select * from Catagory";
				foreach ($db->getdata($sql) as $value) {
					if($productid == $value['id']){
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
