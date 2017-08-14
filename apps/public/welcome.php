<?php
if(!isset($_SESSION['email'])){
	echo '<script>window.location = "'.URL.'/login"</script>';
}

?>
<h1 style="overflow: hidden;">Welcome to user:<?php echo $_SESSION['email'];?></h1>