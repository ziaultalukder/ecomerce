<?php
session_start(); 
spl_autoload_register(function($classname){
include_once 'lib/'.$classname.'.php';
});


include_once 'config/configurl.php';
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="<?php echo URL.'/apps/css/htmldesign.css';?>">
        <link rel="stylesheet" href="<?php echo URL.'/apps/thumbnail/thumbnail-slider.css'?>">
        <script type="text/javascript" src="<?php echo URL.'/apps/thumbnail/thumbnail-slider.js'?>"></script>


    </head>
    <body>
        <div class="template">
            <header>
            <div class="social">
                <a href=""><img src="<?php echo URL.'/apps/img/facebook.png';?>"></a>
                 <a href=""><img src="<?php echo URL.'/apps/img/tweter.png';?>"></a>
                <a href=""><img src="<?php echo URL.'/apps/img/Dribbble.png';?>"></a>
                <a href=""><img src="<?php echo URL.'/apps/img/socail-icone.png';?>"></a>
                <a href=""><img src="<?php echo URL.'/apps/img/linkdin.png';?>"></a>
                <a href=""><img src="<?php echo URL.'/apps/img/tumblr.png';?>"></a> 
            </div>
            <div class="serch-button">
                <input type="text" name="search" placeholder="Search">
                <input type="submit" name="btn" value="Search">
            </div>
                <img src="<?php echo URL.'/apps/img/main-menu.png';?>" alt="menu" class="menu">
                <a href="<?php echo URL.'/home'?>"><img src="<?php echo URL.'/apps/img/logo.png';?>" alt="logo" class="logo clear"></a>
                


                <?php include_once 'apps/public/nav.php';?>
            




            </header>
            <section class="shoping-cart">
                <p class="left">August .12 .2012 - Syrian prime minister defects, fighting goes on</p>
                <p class="right">Shopping Cart: 0 item(s) - $0.00</p>
                <img src="<?php echo URL.'/apps/img/cart.png';?>" alt="Shopping Cart" class="cart">
            </section>
            <main>
   <?php

            if(isset($_GET['public'])){
              $url = $_GET['public'];
              $url = rtrim($url,"/");
              $url = explode("/", $url);


              if(file_exists('apps/public/'.$url[0].'.php')){
                include_once 'apps/public/'.$url[0].'.php';
              }else{
                include_once 'apps/public/404.php';
              }  
            }

            else{
              include_once 'apps/public/home.php';
            }
            ?> 
            </main>
<section class="footer-top">
    <div class="sponsor-slider">
            <div id="thumbnail-slider">
                <div class="inner">
                    <ul>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-1.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-2.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-3.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/fashions for today.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-1.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-2.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-3.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/fashions for today.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-1.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-2.png';?>"></a></li>
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/sponsor-3.png';?>"></a></li> 
                        <li><a class="thumb"  href="<?php echo URL.'/apps/img/fashions for today.png';?>"></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
            <footer>
                <h5 style="color: white; text-align: center; padding-top: 20px;">Copyright@Fashion Today 2016</h5>
            </footer>
        </div>
    </body>
</html>



