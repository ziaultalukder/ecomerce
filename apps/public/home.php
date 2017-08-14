<?php
$db = new Database();
?>
<div class="slider">
               <div class="slider-left">
                   <img src="apps/img/slider.png" alt="slider image">
               </div>
               <div class="slider-right">
                   <h1>Where can I get some?</h1>
                   <p>Fusce ultrices ornare velit, consectetur tempus eros dapibus et. Integer lobortis, dui in iaculis sollicitudin, felis nunc aliquam nibh, eu porta nisi urna nec odio. Duis suscipit viverra magna id sagittis. Quisque odio neque, condimentum cursus volutpat vel, pharetra ac nibh. Cras cursus libero id nunc facilisis luctus. Aenean ultricies, risus cursussollicitudin congue, diam diam congue velit, ut sodales sem enim a nisl. Aenean elit diam, mollisfermentum pellentesque nec, convallis eu est. Nunc eu mattis dui. Nulla quis suscipit ligula. Morbi diam massa, laoreet id pretium id, varius et sem.</p>
                   <a href=""><img src="apps/img/shopnow.png" alt="Shop Now"></a>
               </div>
            </div>
               <section class="product-left">
                   <img src="apps/img/fetured.png" alt="Fetured" class="fetured">
                       <div class="img">
                       </div>
                       <a href="#"><img src="apps/img/cart-img.png" alt="cart" class="img1"></a>
                       <p>Herbal Sport</p>
                       <p class="p1">$101.88</p>
               </section>
<section class="product-right">
    <h2>New Products</h2>

    <?php
    $pimgid = 0;
    $pimgname = "";
    $sql = "select * from product order by id desc limit 0,3";
    foreach ($db->getdata($sql) as $value) {
      $sql1 = "select * from productimage where productid=".$value['id'];
      foreach ($db->getdata($sql1) as $item) {
          $pimgid = $item['id'];
          $pimgname = $item['name'];
      }
      echo '<div class="product-box">
               <figure>';

      if(empty($pimgname)){
        echo '<a href="'.URL.'/details/'.base64_encode($value['id']).'"><img src="apps/productimage/noimage.jpg"></a>';
      }
      else{
        echo '<a href="'.URL.'/details/'.base64_encode($value['id']).'"> <img src="apps/productimage/'.$pimgid.'_'.$pimgname.'"></a>';
        $pimgname = "";
      }                     
   echo '</figure>
             <figcaption style="margin-left: 15px; color: white;">'.$value['name'].'</figcaption>
             <h5 style="margin-left: 15px; color: white;">Price :'.$value['price'].' BDT</h5>
             <img src="apps/img/cart-img.png" alt="cart" class="img1">
         </div>';
        }
        ?>

               
</section>


<section class="product-treding">
   <div class="product-treding-left">
       <img src="apps/img/tremd-now.png" alt="trending-now">
       <ul>
       <?php
       $sql = "select * from category";
       foreach ($db->getdata($sql) as $value) {
         echo '<li><a href="'.URL.'/category/'.base64_encode($value['id']).'">'.$value['name'].'</a></li>';
       }
       ?>    
       </ul>
   </div>

   <div class="product-treding-right">
   <?php
   $sql = "select * from product limit 0,4";
    foreach ($db->getdata($sql) as $value) {
      $sql1 = "select * from productimage where productid=".$value['id'];
      foreach ($db->getdata($sql1) as $item) {
          $pimgid = $item['id'];
          $pimgname = $item['name'];
      }
echo '<div class="trending-product-box">';

        
        if($pimgname == ""){
          echo '<a href="'.$URL.'/details/'.base64_encode($value['id']).'"><img src="apps/productimage/noimage.jpg"></a>';
        }
        else{
          echo '<a href="'.URL.'/details/'.base64_encode($value['id']).'"><img src="apps/productimage/'.$pimgid.'_'.$pimgname.'"></a>';
          $pimgname = "";
        }


           echo '<div class="cart-content">
             <figcaption>'.$value['name'].'</figcaption>
             <div class="price">'.$value['price'].'</div><br/><br/>
             <a href=""><img src="apps/img/add-to-cart.png" alt="Add To cart" style="height: 55px; width: 130px;"></a>
         </div>
     </div>';

}
   ?>   
   </div>
</section>