<?php
spl_autoload_register(function($classname){
include_once 'lib/'.$classname.'.php';
});

$db=new Database();
$id=$_GET['r'];

$sql="select * from city where countryid=".$id;
foreach ($db->getdata($sql) as $value) {
	echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
}





?>