<?php
$db = new Database();
if(isset($_GET['id'])){
	$id = $_GET['id'];


	$sql="delete from productimage where id =".$id;
	if($db->delete($sql)){
		echo '<div style="color:green; border:1px solid green; padding:10px; margin:20px auto; width:30%; text-align:center" id="jserror">
		<i class="fa fa-times" aria-hidden="true" style="float:right" id="crosbtn"></i>
		Data Deleted successfully..................
		</div>';
	}

}
?>

<script type="text/javascript">
	$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>

<table cellpadding="10" cellspacing="0" id="myTable" class="display">
	<thead>
		<tr>
			<th>SL</th>
			<th>Product Name</th>
			<th>Product Image</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

<?php

$i=1;
$sql ="select productimage.*,product.name as product from productimage inner join product on productimage.productid = product.id";
foreach ($db->getdata($sql) as $value) {
	
		echo '<tr>
				<td>'.$i++.'</td>
				<td>'.$value['product'].'</td>
				<td><img src="apps/productimage/'.$value['id'].'_'.$value['name'].'" alt="image" width="150"></td>
				<td><a href="?admin=editproductimage&id='.$value['id'].'">Edit</a></td>
				<td><a href="?admin=displayproductimage&id='.$value['id'].'".$id class="delete">Delete</a></td>
			</tr>';
}
?>	
</table>