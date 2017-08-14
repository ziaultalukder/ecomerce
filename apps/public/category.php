<div class="container" style="margin-top: 20px;">
	<?php
if(isset($url[1])){
$id = base64_decode($url[1]);
}



$db = new Database();
$pimgid = 0;
$pimgname = "";
$sql = "select * from product where categoryid=".$id;
foreach ($db->getdata($sql) as $value) {
  $sql1 = "select * from productimage where productid=".$value['id'];
  foreach ($db->getdata($sql1) as $item) {
      $pimgid = $item['id'];
      $pimgname = $item['name'];
  }
  echo '<div class="product-box">
           <figure>';

  if(empty($pimgname)){
    echo '<a href="'.URL.'/details/'.base64_encode($value['id']).'"><img src="'.URl.'/apps/productimage/noimage.jpg"></a>';
  }
  else{
    echo '<a href="'.URL.'/details/'.base64_encode($value['id']).'"><img src="'.URL.'/apps/productimage/'.$pimgid.'_'.$pimgname.'"></a>';
    $pimgname = "";
  }                     
echo '</figure>
         <figcaption style="margin-left: 15px; color: white;">'.$value['name'].'</figcaption>
         <h5 style="margin-left: 15px; color: white;">Price :'.$value['price'].' BDT</h5>
         <img src="'.URL.'/apps/img/cart-img.png" alt="cart" class="img1">
     </div>';
    }
    ?>
























</div>