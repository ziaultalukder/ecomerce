<!-- <link rel="stylesheet" type="text/css" href="<?php echo URL.'/apps/css/htmldesign.css';?>"> -->

<div class="container" style="margin-top: 40px;">
<?php
	if(isset($url[1])){
		$id = base64_decode($url[1]);
	}

	$pimgid = 0;
    $pimgname = "";
    $db = new Database();

// $sql="select product.*,category.name as category,warranty.name as warranty from product inner join category on product.categoryid = category.id inner join warranty on product.warrantyid = warranty.id";

     $sql = "select * from product where id=".$id;
    foreach ($db->getdata($sql) as $value) {
      $sql1 = "select * from productimage where productid=".$value['id'];
      foreach ($db->getdata($sql1) as $item) {
          $pimgid = $item['id'];
          $pimgname = $item['name'];
      }

      echo '<script>
      function price(str){
      	result = '.$value['price'].'*str;
      	document.getElementById("priceresult").innerHTML = result + " BDT"; 
      }
      </script>';

      echo '<div class="details-left">';
if(empty($pimgname)){
    echo '<img src="'.URL.'/apps/productimage/noimage.jpg" width=100%; height=400px;>';
  }
  else{
    echo '<img src="'.URL.'/apps/productimage/'.$pimgid.'_'.$pimgname.'" width=100%; height=400px;>';
    $pimgname = "";
  }
			echo '</div>

<div class="details-right">
	<table>
		<tr>
			<td width="30%">Product Name</td>
			<td>:</td>
			<td>'.$value['name'].'</td>
		</tr>

		<tr>
			<td>Product Price</td>
			<td>:</td>
			<td id="priceresult">'.$value['price'].' BDT</td>
		</tr>

		<tr>
			<td>Product Discount</td>
			<td>:</td>
			<td>'.$value['discount'].' %</td>
		</tr>

		<tr>
			<td>Product Description</td>
			<td>:</td>
			<td>'.$value['description'].'</td>
		</tr>

		<tr>
			<td>Product Warrenty</td>
			<td>:</td>
			<td>'.$value['warrantyid'].'</td>
		</tr>

		<tr>
			<td>Product Catagory</td>
			<td>:</td>
			<td>'.$value['categoryid'].'</td>
		</tr>

		<tr>
			<td>Product Vat</td>
			<td>:</td>
			<td>'.$value['vat'].' %</td>
		</tr>

			<tr>
				<td colspan="3">
					<form action="" method="post">';
					if(isset($_POST['btn_qty'])){
						
$pid = $value['id'];
$sid = session_id();
$pname = $value['name'];
$pprice = $value['price'] * $_POST['qty'];
$pdiscount = $value['discount'];
$pqty = $_POST['qty'];

echo $sqlcommand = "insert into cart(pid,sid,pname,pprice,pdiscount,pqty)value(".$pid.",'".$sid."', '".$pname."',".$pprice.",".$pdiscount.",".$pqty.")";

	if($db->insertdata($sqlcommand)){
		header("Location:".URL.'/cart');
	}
	else{
		print_r($db->Error);
	}					

						}
						echo '<input type="number" name="qty" value="1" onchange="price(this.value)" style="width: 50px;">
						<input type="submit" name="btn_qty" value="Add To Cart">
					</form>
				</td>
			</tr>
		</table>
	</div>';

    }
?>

<?php
$sql = "select * from productimage where productid=".$id;
if($db->getdata($sql)){
foreach ($db->getdata($sql) as $value1) {
echo '<div class="imagebox">';
	
	echo '<img src="'.URL.'/apps/productimage/'.$value1['id'].'_'.$value1['name'].'">';
echo '</div>';
}
}
else{
	echo '<img src="'.URL.'/apps/productimage/noimage.jpg">';
}

?>
</div>

