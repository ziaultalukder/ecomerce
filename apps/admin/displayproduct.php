<?php
$db = new Database();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql="delete from product where id =".$id;

	if($db->delete($sql)){
		echo '<div style="color:green; border:1px solid green; padding:10px; margin:20px auto; width:30%; text-align:center" id="jserror">
		<i class="fa fa-times" aria-hidden="true" style="float:right" id="crosbtn"></i>
		Data Deleted successfullyy..................
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
			<th>Name</th>
			<th>Price</th>
			<th>discount</th>
			<th>description</th>
			<th>catagory</th>
			<th>warranty</th>
			<th>vat</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

<?php

$sql = "select product.*,category.name as category,warranty.name as warranty from product inner join category on product.categoryid = category.id inner join warranty on product.warrantyid = warranty.id";

$i=1;
echo '<tbody>';
foreach ($db->getdata($sql) as $value) {
	echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$value['name'].'</td>
			<td>'.$value['price'].'/=</td>
			<td>'.$value['discount'].'%</td>
			<td>'.$value['description'].'</td>
			<td>'.$value['category'].'</td>
			<td>'.$value['warranty'].'</td>
			<td>'.$value['vat'].'%</td>
			<td><a href="?admin=editproduct&id='.$value['id'].'">Edit</a></td>
			<td><a href="?admin=displayproduct&id='.$value['id'].'".$id class="delete">Delete</a></td>
		</tr>';
}
echo '</tbody>';
?>	
</table>
