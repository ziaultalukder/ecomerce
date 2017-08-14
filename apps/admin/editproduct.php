<?php
if($_GET['id']){
	$id = $_GET['id'];
}
?>
<?php
$db= new Database();
$validation= new Validation();

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$validation->post('name')
	           ->isempty()
	           ->charecter()
	           ->length(5,20);

	$name=$validation->$value['name'];
	$price=$validation->$value['price'];
	$discount=$validation->$value['discount'];
	$description=$validation->$value['description'];
	$catagoryid=$_POST['catagoryid'];
	$warrantyid=$$_POST['warrantyid'];
	$vat=$validation->$value['vat'];

	$sql="update product set name='".$name."',price='".$price."',discount='".$discount."',description='".$description."',catagoryid='".$catagoryid."',warrantyid='".$warrantyid."',vat='".$vat."' where id=.$id";

	if($validation->submit()){
		if($db-update($sql)){
			$name="";
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