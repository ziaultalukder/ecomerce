<?php
$db = new Database();
if(isset($_POST['btn'])){
	
	$productid = $_POST['productid'];
	$name = $_FILES['name']['name'];
	$extension = explode(".", $name);
	$extension = $extension[count($extension)-1];
	$sql = "insert into productimage(name, productid) values('".$name."', '".$productid."')";

	if($extension =="jpg" || $extension =="png" || $extension="gif"){
		if($db->imageupload($sql)){
			echo '<span style="color:green;font-size:15px;">Image Upload Successfully.....</span>';
			$imagepath = $_FILES['name']['tmp_name'];
			$imagedestination = 'apps/productimage/'.$db->lastid.'_'.$name;
			move_uploaded_file($imagepath, $imagedestination);
		}
		
	}
	else{
		echo "image formate not valid";
	}
}
?>

<form action="" method="post" enctype="multipart/form-data">
	<legend>Product Image Info</legend><br>
	<label>Product Catagory</label><br>
	<select name="productid">
		<option>Select</option>
			<?php
				$sql="select * from product";
				foreach ($db->getdata($sql) as $value) {
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}

			?>
	</select><br><br>

	<label>Upload Product Image</label><br>
	<input type="file" name="name"><br>
	<input type="submit" name="btn" value="Upload Image">
</form>