<?php session_start();
 if(isset($_SESSION["employee"]))
 {
	 header('location:employee.html');
 }
 else if(isset($_SESSION["admin"]))
 {
	 header('location:admin.html');
 }
 else if(isset($_SESSION["businessowner"]))
 {
	 header('location:businessowner.html');
 }
 else if(isset($_SESSION["customer"]))
 {
	 header('location:home.php');
 }
 else
 {
	 if(!isset($_SESSION["seller"]))
	 {
		 header('location:home.php');
	 }
 }
?>
<!doctype html>
<html lang="en">
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the Compatible of your site -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the page title -->
	<title>TueBlue</title>
	<!-- include the site Google Fonts stylesheet -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700%7CRoboto:300,400,500,700,900&display=swap" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- include the site fontawesome stylesheet -->
	<link rel="stylesheet" href="css/fontawesome.css">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="style.css">
	<!-- include theme plugins setting stylesheet -->
	<link rel="stylesheet" href="css/plugins.css">
	<!-- include theme color setting stylesheet -->
	<link rel="stylesheet" href="css/color.css">
	<!-- include theme responsive setting stylesheet -->
	<link rel="stylesheet" href="css/responsive.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function($){
   
            $(".icon-eye").click(function()
            {
				var pcode=$(this).parent().parent().parent().parent().children().eq(1).children().eq(1).html();
                window.location.href="viewproduct.php?pcode="+pcode;
            });
        });
    </script>
  <body>
    <!-- header -->
	<header id="header" class="position-relative">
				<!-- headerHolder -->
				<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
					<div class="row">
						<div class="col-6 col-sm-6">
							<!-- mainLogo -->
							<div style="width:50%;" class="logo">
								<a href="home.php"><img src="images/logo.jpeg" alt="TueBlue" class="img-fluid"></a>
							</div>
						</div>
						<div class="col-6 col-sm-6 col-lg-6 static-block">
							<!-- mainHolder -->
							<div class="mainHolder pt-lg-5 pt-3 justify-content-center">
								<!-- pageNav2 -->
								<nav class="navbar navbar-expand-lg navbar-light p-0 pageNav2 position-static">
									<button type="button" class="navbar-toggle collapsed position-relative" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<div class="collapse navbar-collapse" id="navbarNav">
									<ul class="navbar-nav mx-auto text-uppercase d-inline-block">
										<li class="nav-item dropdown active ">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="seller.php" style="word-spacing:8px;">Home</a>
										</li>
										<li class="nav-item dropdown">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="selleraccount.php" style="word-spacing:8px;">My account</a>
										</li>
										<li class="nav-item dropdown">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="supplyproduct.php" style="word-spacing:8px;">Supply product</a>
										</li>
										<li class="nav-item">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="logout.php" style="word-spacing:8px;">Logout</a>
										</li>
									</ul>
									</div>
								</nav>
							</div>
                        </div>
					</div>
				</div>
      </header>
	<main>
        <section class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-80 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7">
            
        <header class="col-12 mainHeader mb-7 text-center">
                    <h2 class="headingIV playfair fwEblod mb-4">Your supply</h2> 
                    <span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>

        </header>
        <div class="col-12 p-0 overflow-hidden d-flex flex-wrap">
                 <?php 
                    error_reporting(E_ERROR | E_PARSE);
                    $db_host="localhost";
                    $db_user="root";
                    $db_pass=null;
                    $db_name="tueblue";
                
                    $mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);
                
                    if (mysqli_connect_errno())
                    {
                        echo("connect failed");
                        exit();
                    }
                                
                    $stmt2=$mysqli->prepare("SELECT products.pcode, products.description, products.oldprice, products.newprice, products.pname, products.image_url  FROM products WHERE products.sellers_username=?");
                    $stmt2->bind_param("s",$_SESSION["signedin"]);
                    $stmt2->execute();
                    $stmt2->store_result();
                    $stmt2->bind_result($pcode,$description,$oldprice,$newprice,$pname,$url);
                    $count = $stmt2->num_rows; 
                  
                
                    while($stmt2->fetch()) {
                        ?>
                    <div class=" col-3 col-sm-3 col-lg-3 featureCol px-3 mb-6">
						<div class="border">
							<div class="imgHolder position-relative w-100 overflow-hidden">
                                <img style="width:80px;height:300px" src="<?=$url?>" alt="image description" class="img-fluid w-100">
                                <ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
								<li class="mr-2 overflow-hidden">
								<li class="mr-2 overflow-hidden"><a class="icon-eye d-block"></a></li>
								<li class="mr-2 overflow-hidden">
                                </ul>
							</div>
							<div class="text-center py-xl-5 py-sm-4 py-2 px-xl-2 px-1">
                                <span class="title d-block mb-2"><a href="shop-detail.html"><?=$pname?></a></span>
								<span class="price d-block fwEbold" style="visibility: hidden;"><?=$pcode?></span>
								<?php 
								if($newprice>=$oldprice)
								{
								?>
								<span class="price d-block fwEbold"><?=$newprice?> $</span>
								<?php
								}
								else{
									?>
									<span class="price d-block fwEbold"><del><?=$oldprice?> $</del><?=$newprice?> $</span>
									<?php
									if($newprice<$oldprice)
									{?>
									<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
								
									<?php
									}
								}
								?>
								
							</div>
						</div>
					</div>
                    <?php
                        }
                
                 ?>
	</section>
	  	<!-- footerHolder -->
	  <aside class="footerHolder overflow-hidden bg-lightGray pt-xl-23 pb-xl-8 pt-lg-10 pb-lg-8 pt-md-12 pb-md-8 pt-10">
		<div class="container">
			<div class="row">
				<div style="text-align: center;" class="col-sm-6 col-lg-6 mb-lg-0 mb-4">
					<h3 class="headingVI fwEbold text-uppercase mb-7">Contact Us</h3>
					<ul style="display: inline-block;"class="list-unstyled footerContactList mb-3">
						<li  class="mb-3 d-flex flex-nowrap pr-xl-20 pr-0"><span class="icon icon-place mr-3"></span> <address class="fwEbold m-0">Address: Tripoli</address></li>
						<li class="mb-3 d-flex flex-nowrap"><span class="icon icon-phone mr-3"></span> <span class="leftAlign">Phone : <a href="javascript:void(0);">(+961) 03123456</a></span></li>
						<li class="email d-flex flex-nowrap"><span class="icon icon-email mr-2"></span> <span class="leftAlign">Email:  <a href="javascript:void(0);">support@tueblue.com</a></span></li>
					</ul>
				</div>
				<div style="text-align: center;" class=" col-sm-6 col-lg-6 pl-xl-14 mb-lg-0 mb-4">
					<h3 class="headingVI fwEbold text-uppercase mb-6">Information</h3>
					<ul style="display: inline-block;" class="list-unstyled footerNavList">
						<li><a href="privacypolicy.html">Privacy policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</aside>
    </main>
	

      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>