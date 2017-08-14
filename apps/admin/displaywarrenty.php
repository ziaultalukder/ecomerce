<?php
$db = new Database();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql="delete from warranty where id =".$id;

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
			<th>Warranty Product Name</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

<?php


$sql ="select * from warranty";
$i=1;

echo '<tbody>';
	foreach ($db->getdata($sql) as $value) {
	
		echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$value['name'].'</td>
			<td><a href="?admin=editwarrantry&id='.$value['id'].'">Edit</a></td>
			<td><a href="?admin=displaywarrenty&id='.$value['id'].'".$id class="delete">Delete</a></td>
		</tr>';
	
}
echo '</tbody>';

?>

<script>
	$(document).ready(function(){
		$('.delete').bind('click',function(e){
			var confirmation = confirm("are you sure you want to delete");
			if(!confirmation){
				e.preventDefault();
			}
		});
	});
</script>

</table>