<?php
$db= new Database();
$validation=new Validation();

$name="";
$email="";
$contact="";
$address="";
$gender="";
$password="";
$countryid=0;
$cityid=0;

if(isset($_POST['btn_Registar'])){

	$validation->post("name")->charecter()->isEmpty();
	$validation->post("contact")->digit()->isempty();
	$validation->post("address")->isempty()->length(10,50);
	$validation->post("email")->isempty();
	if(isset($_POST['gender'])){
		$validation->post("gender")->selectone();
	}
	$validation->post("password")->isempty();
	$validation->post("cityid")->select();
	$validation->post("countryid")->select();


	$name= $validation->values['name'];
	$contact=$validation->values['contact'];
	$address=$validation->values['address'];
	$email=$validation->values['email'];
	if(isset($_POST['gender'])){
		$gender=$validation->values['gender'];
	}
	$password=md5($validation->values['password']);
	$cityid=$validation->values['cityid'];
	$countryid=$validation->values['countryid'];


	$tablename="user";
	$data=array('name'=>$name,'contact'=>$contact,'address'=>$address,'email'=>$email,'gender'=>$gender,'password'=>$password,'countryid'=>$countryid,'cityid'=>$cityid,'type'=>'U');

	if($validation->submit()){
		$db->insert($tablename,$data);
		echo '<span style="color:green;font-size:15px;">registration Successfully.....</span>';

			$name="";
			$contact="";
			$address="";
			$email="";
			$gender="";
			$password="";
			$cityid=0;
			$countryid=0;
			
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

if(isset($_POST['btn_login'])){

	$validation->post("email")->isempty();
	$validation->post("password")->isempty();

	$email = $_POST['email'];
	$password=md5($_POST['password']);

	$sql="select * from user where email='".$email."' and password='".$password."'";

	if($db->getAuthentication($sql)){
		foreach ($db->getdata($sql) as $value) {
			$_SESSION['email'] = $value['email'];
			$_SESSION['type'] = $value['type'];
		}
		
		if(isset($_SESSION['type']))
		{
			if($_SESSION['type']=='A'){
			echo '<script>window.location = "'.URL.'/admin.php"</script>';
		}
		else{
			echo '<script>window.location = "'.URL.'/welcome"</script>';
		}
		}
	}
	else
	{
		echo '<div style="color:red; border:1px solid red; padding:10px; margin:20px auto; width:30%; text-align:center" id="jserror">
		<i class="fa fa-times" aria-hidden="true" style="float:right" id="crosbtn"></i>Email and Password Dose Not Match</div>';
	}

}

?>

<script type="text/javascript">

	function ajax(str) {
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else{
			xmlhttp = new ActiveObject(Microsoft.XMLHTTP);
		}
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("result").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ajax.php?r="+str,true);
		xmlhttp.send();
	}		
</script>


<div class="login-section">
	<form action="" method="post">
		<fieldset>
			<legend>Login Info</legend>
			<label>Username</label><br/>
			<input type="email" name="email" placeholder="Enter Here........" >
			<br/>
			<label>Password</label><br/>
			<input type="Password" name="password" placeholder="Enter Here........" >
			<br/><br/>
			<input type="submit" name="btn_login" value="Login">
		</fieldset>
	</form>
</div>

<div class="register-section">
<form action="" method="post">
	<fieldset>
			<legend>Registration Info</legend>
			<label>Name</label><br/>
			<input type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Here........" >
			<br/>

			<label>Email</label><br/>
			<input type="email" name="email" value="<?php echo $email;?>"  placeholder="Enter Here........" >
			<br/><br/>

			<label>Password</label><br/>
			<input type="password" name="password" value="<?php echo $password;?>"  placeholder="Enter Here........" >
			<br/><br/>

			<label>Contact</label><br/>
			<input type="number" name="contact" value="<?php echo $contact;?>"  placeholder="Enter Here........" >
			<br/><br/>

			<label>Address</label><br/>
			<textarea name="address" style="height: 100px;">
				<?php echo $address;?>
			</textarea>

			<br/><br/>

			<label>Gender</label>
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
			<br/><br/>

			<label>Country</label><br/>
			<select name="countryid" onchange="ajax(this.value)">
				<option value="0">Select One</option>
				<?php
				$sql="select * from country";
				foreach ($db->getdata($sql) as $value) {
					if($countryid == $value['id']){
						echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
					}
					else{
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
					
				}
				?>
			</select>
			<br/><br/>
			<label>City</label><br/>
			<select name="cityid" id="result">
				<option value="0">Select One</option>


			</select>
			<br/><br/>
			<input type="submit" name="btn_Registar" value="Registration">
		</fieldset>
</form>
</div>