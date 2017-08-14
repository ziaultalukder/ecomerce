<?php

$db= new Database();
$validation = new validation();
$name="";
$price="";
$discount="";
$description="";
$categoryid=0;
$warrantyid=0;
$vat="";


if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$validation->post('name')
	           ->isempty()
	           ->length(5,20);

	$validation->post('price')
	           ->isempty();

	$validation->post('discount')
	           ->isempty();

	$validation->post('description')
	           ->isempty()
	           ->length(10,1000);

	$validation->post('vat')
	           ->isempty();

	           $name=$validation->values['name'];
	           $price=$validation->values['price'];
	           $discount=$validation->values['discount'];
	           $description=$validation->values['description'];
	           
	           
	           $categoryid = $_POST['categoryid'];
	           $warrantyid = $_POST['warrantyid'];

	           $vat=$validation->values['vat'];

	$tablename="product";
	$data = array('name'=>$name, 'price'=>$price, 'discount'=>$discount, 'description'=>$description,'categoryid'=>$categoryid, 'warrantyid'=>$warrantyid,'vat'=>$vat);
	
	if ($validation->submit()) {
		if($db->insert($tablename,$data)){
			echo '<span style="color:green;font-size:15px;">Date Added Successfully.....</span>';
			$name="";
			$price="";
			$discount="";
			$description="";
			$catagoryid=0;
			$warrantyid=0;
			$vat="";

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

<div class="admin-form">
<form action="" method="post">
	<fieldset>
		<legend>Product Info</legend>
		<label>Product Name</label><br>
		<input type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Here">
		<br><br>

		<label>Product Price</label><br>
		<input type="number" name="price" value="<?php echo $price;?>" placeholder="Enter Here">
		<br><br>

		<label>Product Discount</label><br>
		<input type="number" name="discount" value="<?php echo $discount;?>" placeholder="Enter Here">
		<br><br>

		<label>Product Description</label><br>
		<textarea name="description" style="width:250px; height: 100px;">
			<?php echo $description;?>
		</textarea>
		<br><br>

		<label>Catagory</label><br>
		<select name="categoryid">
			<option>Select</option>
			<?php
				$sql="select * from Category";
				foreach ($db->getdata($sql) as $value) {
					if($catagoryid == $value['id']){
						echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
					}
					else{
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
				}

			?>
		</select>
		<br><br>
		<label>Warrenty</label><br>
		<select name="warrantyid">
			<option>Select</option>
			<?php
				$sql="select * from warranty";
				foreach ($db->getdata($sql) as $value) {
					if($warrantyid == $value['id']){
						echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';

					}else{
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';

					}
				}

			?>
		</select>
		<br><br>

		<label>Product Vat</label><br>
		<input type="number" name="vat" value="<?php echo $vat;?>" placeholder="Enter Here">
		<br><br>

		<input type="submit" name="btn" value="Save Data">
	</fieldset>
</form>
</div>