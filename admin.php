
<?php
include_once 'config/configurl.php';
session_start(); 
if(!isset($_SESSION['type']) || $_SESSION['type'] != "A"){
    echo '<script>window.location = "'.URL.'/login"</script>';
}


spl_autoload_register(function($classname){
include_once 'lib/'.$classname.'.php';
});
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="apps/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="apps/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="apps/css/admin.css"/>
        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <script src="apps/js/jquery.js"></script>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://use.fontawesome.com/5a90e5a9cf.js"></script>
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div class="col-md-12 header_area">
                    <div class="row">
                    <div class="col-md-6 logo_area">
                        <div class="logo_part">
                            <img src="images/" alt="logo"/>
                        </div>
                        <ul>
                            <li><p>CSL Training</p></li>
                            <li><a href="#">www.csltraining.com</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 login_area">
                        <ul>
                            <li><img src="apps/images/user.png"/></li>
                            <li><p>Jane na</p></li>
                            <li><a href="?admin=logout">Log Out</a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-default menu_area">
            <div class="col-md-12">
                <ul class="nav navbar-nav">
                    <li><img src="apps/images/dash.png"/><a href="#">Dashboard</a></li>
                    <li><img src="apps/images/user_pro.png"/><a href="#">User Profile</a></li>
                    <li><a href="#">Change Password</a></li>
                    <li><img src="apps/images/inbox.png"/><a href="#">Inbox</a></li>
                    <li><img src="apps/images/visit.png"/><a href="#">Visit Website</a></li>
                </ul>
            </div>
        </nav>
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="site-option">
                        <p>Site Option</p>
                        <ul class="nav navbar-nav">
                            <li><a href="?admin=addcountry">add Country</a></li>
                            <li><a href="?admin=displaycountry">display Country</a></li>
                            <li><a href="?admin=addwarrenty">add Warranty</a></li>
                            <li><a href="?admin=displaywarrenty">display Warranty</a></li>
                            <li><a href="?admin=addcatagory">add Category</a></li>
                            <li><a href="?admin=displaycatagory">Display Category</a></li>
                            <li><a href="?admin=addproduct">add Product </a></li>
                            <li><a href="?admin=displayproduct">Display Product</a></li>
                            <li><a href="?admin=addcity">add City</a></li>
                            <li><a href="?admin=displaycity">Display City</a></li>

                            <li><a href="?admin=addproductimage">Add Product Image</a></li>

                            <li><a href="?admin=displayproductimage">Display Product Image</a></li>
                            

                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="content_area">
                        
                        
                        <?php
							if(isset($_GET['admin'])){
								echo '<p>'.ucwords($_GET['admin']).' Page</p>';
								if(file_exists('apps/admin/'.$_GET['admin'].'.php')){
									include_once 'apps/admin/'.$_GET['admin'].'.php';
								}
								else{
									include_once 'apps/public/404.php';
								}
							}
							else{
								echo '<p>Home Page</p>';
								include_once 'apps/admin/home.php';
							}
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <footer class="footer_area">
            <div class="col-md-12">
                <i class="fa fa-copyright" aria-hidden="true"></i>
                <p>Copyright <a href="#">Training With Live Project. </a>All rights reserved.</p>
            </div>
        </footer>
    </body>
   
    <script src="apps/js/admin.js"></script>
    <script src="apps/js/bootstrap.min.js"></script>
</html>