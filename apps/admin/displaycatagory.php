<?php
$db = new Database();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql="delete from category where id =".$id;

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
			<th>Catagory</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

<?php
$sql ="select * from category";
$i=1;
echo '<tbody>';
foreach ($db->getdata($sql) as $value) {
	echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$value['name'].'</td>
			<td>'.$value['categoryid'].'</td>
			<td><a href="?admin=editcatagory&id='.$value['id'].'">Edit</a></td>
			<td><a href="?admin=displaycatagory&id='.$value['id'].'".$id class="del">Delete</a></td>
		</tr>';
}
echo '<tbody>';
?>

	
</table>