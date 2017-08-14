<?php
$db = new Database();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql="delete from city where id =".$id;

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
$sql ="select city.*, country.name as country from city inner join country on city.countryid = country.id";
$i=1;
echo '<tbody>';
foreach ($db->getdata($sql) as $value) {
	
		echo '<tr>
				<td>'.$i++.'</td>
				<td>'.$value['name'].'</td>
				<td>'.$value['country'].'</td>
				<td><a href="?admin=editcity&id='.$value['id'].'">Edit</a></td>
				<td><a href="?admin=displaycity&id='.$value['id'].'".$id class="del">Delete</a></td>
			</tr>';

}
echo '</tbody>';
?>	
</table>