<?php session_start(); 
     if(isset($_SESSION["admin"]))
    {
		header("location:admin.html");
    }
    else if(isset($_SESSION["employee"]))
    {
		header("location:employee.html");
    }
    else if(isset($_SESSION["businessowner"]))
    {
		header("location:businessowner.html");
	} 
	else if(isset($_SESSION["seller"]))
	{
		header("location:seller.php");
	}    
	
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

if ((isset($_GET["u"]))&&(isset($_GET["p"]))) //when the verification link is clicked
{
	$username=$_GET["u"];
	$pass = $_GET["p"];
	$number = $_GET["pn"];
	$firstname = $_GET["fn"];
	$lastname = $_GET["ln"];
	$location = $_GET["l"];
	$location = explode("/", $location);
	$location = implode(" ",$location);
	if($_GET["g2"]!=NULL)
		 $gov = $_GET["g1"]." ".$_GET["g2"];
	else 
	     $gov = $_GET["g1"];
	$email = $_GET["e"];
	$sub=0;

	$stmt=$mysqli->prepare("SELECT location FROM customers_to_be WHERE username=?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($locationn);
	$count = $stmt->num_rows; 


	if($count!=0)
	{
    $stmt2 = $mysqli->prepare("INSERT INTO customers (username, phonenumber, gov, location, firstname, lastname, email, password, subscription) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssssssss", $username, $number, $gov, $location, $firstname, $lastname, $email, $pass, $sub);
    $stmt2->execute();

    $stmt33 = $mysqli->prepare("INSERT INTO cart (customers_username) VALUES(?)");
    $stmt33->bind_param("s", $username);
	$stmt33->execute();

	// sql to delete a record
    $sqlll = "DELETE FROM customers_to_be WHERE username='{$username}'";
	mysqli_query($mysqli, $sqlll);
	

    $_SESSION["signedin"]=$username;
	$_SESSION["customer"]=$username;

		if(isset($_SESSION["cart_item"]))
		{
			$pcode=$_SESSION["cart_item"];
			session_destroy();
			session_start();
			$_SESSION["signedin"]=$username;
			$_SESSION["customer"]=$username;
			header('location:shop-detail.php?pcode='.$pcode);

		}
	}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- this is to link the javascript page -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
	<!-- animate.css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
	<!--wow-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


	<script>
	new WOW().init();
	$(document).ready(function($){

		$.ajax({
				url: 'notify.php',
				type: "POST",
				datatype: "text",
				success: function(data){
						if(data!="nothing to notify")
						{
							$(".modal-body").html(data);
							$("#modalbutton").click();
						}
				},  
		});

				$("#post").click(function()
				{
					$.ajax({
						url: 'comment.php',
						type: "POST",
						datatype: "text",
						data: { "comment":$("#comment").val(),},
	
						success: function(data){
									$(".modal-body").html(data);
							        $("#modalbutton").click();
									setTimeout(function(){ window.location.reload();}, 3000);

							},  
						});
				});
			$(".icon-eye").click(function()
			{
				var pcode=$(this).parent().parent().parent().parent().children().eq(1).children().eq(1).html();
				window.location.href="shop-detail.php?pcode="+pcode;
			});

			$("#subscribe").click(function()
			{
				$.ajax({
						url: 'subscribe.php',
						type: "POST",
						datatype: "text",
						success: function(data){
							$(".modal-body").html(data);
							$("#modalbutton").click();
							setTimeout(function(){ window.location.reload();}, 3000);
							},
				});    
			});
	});
	</script>
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+96103695450", // WhatsApp number to change 
            call_to_action: "Message us", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->

	<style>
		html {
  scroll-behavior: smooth;
		}
		#tohover{
			display: inline-block;
		}
		#tohover:hover{
			color:white;
			background-color:forestgreen;
		}

		#green{
			position: left;
		}

	</style>
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- pageHeader -->
			<!-- header -->
			<header id="header" class="position-relative">
				<!-- headerHolder -->
				<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
					<div class="row">
						<div class="col-6 col-sm-2">
							<!-- mainLogo -->
							<div style="width:130%;" class="logo">
								<a href="home.php"><img src="images/logo.jpeg" alt="TueBlue" class="img-fluid"></a>
							</div>
						</div>
						<div class="col-6 col-sm-7 col-lg-8 static-block">
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
											<li class="nav-item active dropdown">
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="home.php">home</a>
											</li>
											<li class="nav-item dropdown">
											
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="shop.php">Shop</a>
											</li>
											<li class="nav-item">
												<a class="d-block" href="about-us.php">About</a>
											</li>
											<li class="nav-item">
												<a class="d-block" href="contact-us.html">contact</a>
											</li>
										</ul>
									</div>
								</nav>
							</div>
						</div>
						<div class="col-sm-3 col-lg-2 ml-auto">
							<!-- wishListII -->
							<ul class="nav nav-tabs wishListII pt-5 justify-content-end border-bottom-0">
								<?php 
								error_reporting(E_ERROR | E_PARSE);
								ob_start();
								session_start();
								if (isset($_SESSION["signedin"])){?>
								<li class="nav-item"><a class="nav-link position-relative icon-cart" href="cart-page.php"></a></li> <?php } ?>
								<li class="nav-item">
									<a style="text-align:left" class="nav-link icon-profile icon-menu" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false"></a>
									
									<div class="dropdown-menu pl-4 pr-4">

									<?php if (!isset($_SESSION["signedin"])){?>
										<a id="tohover" class="dropdown-item" href="signin.html"><div id="green"></div>Login</a>
										<a id="tohover" class="dropdown-item" href="signup.html">Registration</a><?php } ?>

										<?php if (isset($_SESSION["signedin"])){?>
										<a id="tohover" class="dropdown-item" href="logout.php">Logout</a> 
										<a id="tohover" class="dropdown-item" href="account.php">My account</a> 
										<a id="tohover" class="dropdown-item" href="order_history.php">Order History</a> <?php } ?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</header>
		<!-- main -->
		<main>

		<!-- Modal -->
		<button id="modalbutton" style="visibility:hidden" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Launch demo modal</button>
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Notification</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
		</div>
		<!-- Modal -->

			<!-- introBlock -->
			<section class="introBlock position-relative">
				<div class="slick-fade">
					<div>
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(images/b-bg2.jpg);">
							<!-- holder -->
							<div class="container position-relative holder pt-xl-10 pt-0">
								<!-- py-12 pt-lg-30 pb-lg-25 -->
								<div class="row">
									<div class="col-12 col-xl-7">
										<div class="txtwrap pr-lg-10">
											<h1 class="fwEbold position-relative pb-lg-8 pb-4 mb-xl-7 mb-lg-6"> <span class="text-break d-block">The Perfect<br> Choice.</span></h1>
											<span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-lg-5 mb-sm-3 mb-1">welcome to TueBlue</span>
											<p class="mb-xl-15 mb-lg-10">Delivering excitement, innovation and freshness.</p>
											<a href="shop.php" class="btn btnTheme btnShop fwEbold text-white md-round py-2 px-3 py-md-3 px-md-4">Shop Now <i class="fas fa-arrow-right ml-2"></i></a>
										</div>
									</div>
									<div class="imgHolder">
										<img style="border-radius: 25px;"  src="images/slide1.jpg" alt="image description" class="img-fluid w-100">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(images/b-bg2.jpg);">
							<!-- holder -->
							<div class="container position-relative holder pt-xl-10 pt-0">
								<!-- py-12 pt-lg-30 pb-lg-25 -->
								<div class="row">
									<div class="col-12 col-xl-7">
										<div class="txtwrap pr-lg-10">
											<h1 class="fwEbold position-relative pb-lg-8 pb-4 mb-xl-7 mb-lg-6"> <span class="text-break d-block">The Perfect<br> Choice.</span></h1>
											<span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-lg-5 mb-sm-3 mb-1">welcome to TueBlue</span>
											<p class="mb-xl-15 mb-lg-10">Delivering excitement, innovation and freshness.</p>
											<a href="shop.php" class="btn btnTheme btnShop fwEbold text-white md-round py-2 px-3 py-md-3 px-md-4">Shop Now <i class="fas fa-arrow-right ml-2"></i></a>
										</div>
									</div>
									<div class="imgHolder">
										<img style="border-radius: 25px;"  src="images/slide2.jpg" alt="image description" class="img-fluid w-100">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(images/b-bg2.jpg);">
							<!-- holder -->
							<div class="container position-relative holder pt-xl-10 pt-0">
								<!-- py-12 pt-lg-30 pb-lg-25 -->
								<div class="row">
									<div class="col-12 col-xl-7">
										<div class="txtwrap pr-lg-10">
											<h1 class="fwEbold position-relative pb-lg-8 pb-4 mb-xl-7 mb-lg-6"> <span class="text-break d-block">The Perfect<br> Choice.</span></h1>
											<span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-lg-5 mb-sm-3 mb-1">welcome to TueBlue</span>
											<p class="mb-xl-15 mb-lg-10">Delivering excitement, innovation and freshness.</p>
											<a href="shop.php" class="btn btnTheme btnShop fwEbold text-white md-round py-2 px-3 py-md-3 px-md-4">Shop Now <i class="fas fa-arrow-right ml-2"></i></a>
										</div>
									</div>
									<div class="imgHolder">
										<img style="border-radius: 25px;"  src="images/slide3.jpg" alt="image description" class="img-fluid w-100">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- featureSec -->
			<section id="NewArrival" class=" wow slideInLeft featureSec container overflow-hidden pt-xl-12 pb-xl-9 pt-lg-10 pb-lg-4 pt-md-8 pb-md-2 pt-5">
				<div class="row ">
					<!-- mainHeader -->
					<header class="col-12 mainHeader mb-4 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">New Arrival</h1>
						<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						<p>Check out our new arrivals! </p>
					</header>
				</div>
				<div class="row">
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
								 			 
					$stmt2=$mysqli->prepare("SELECT products.pcode, products.oldprice, products.newprice,products.pname,products.image_url, products.initialquantity, products.quantity FROM products ORDER BY dateadded DESC");
					$stmt2->execute();
					$stmt2->store_result();
					$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
					//$count2 = $stmt2->num_rows; 
					$count=0;			   
					 while(($stmt2->fetch())&&($count<8)) {
						 $count++;
					?>
					<!-- featureCol -->
					<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6 ">
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
								<span class="title d-block mb-2"><?=$pname?></span>
								<span class="price d-block fwEbold" style="visibility: hidden;"><?=$pcode?></span>
								<?php 	if($oldprice>$newprice)
								{?>
								<span style="text-decoration: line-through;"><?=$oldprice?> $</span>
								<span class="price d-block fwEbold"><?=$newprice?> $</span>
								<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
								<?php } else{?>
									<span></span>
									<span class="price d-block fwEbold"><?=$newprice?> $</span>
									<?php }
												if($quantity == 0) { ?> 
												<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block" style="right: 180px; font-size: 15px; margin-top:22px">SOLD OUT</span>
												<?php } ?>
							</div>
						</div>
					</div> <?php } ?>
				</div>
			</section>
			<!-- featureSec -->
			<section id="BestSeller" class="wow slideInRight featureSec container overflow-hidden pt-xl-11 pb-xl-18 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-5 pb-5">
				<div class="row">
					<!-- mainHeader -->
					<header class="col-12 mainHeader mb-4 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Best seller</h1>
						<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						<p>Take a look at our best sellers!</p>
					</header>
				</div>
				<div class="row">
				<?php 
			 			 
					$stmt=$mysqli->prepare("SELECT products.pcode, products.oldprice, products.newprice,products.pname,products.image_url, products.initialquantity, products.quantity FROM products ORDER BY (initialquantity-quantity) DESC");
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
					$count1=0;			   
					 while(($stmt->fetch())&&($count1<8)) {
						 $count1++;
						 $results = mysqli_query($mysqli, "SELECT rating FROM rates WHERE products_pcode={$pcode}");
						 $row = mysqli_fetch_row($results);
						 $rating=$row[0];

						/* $stmt3=$mysqli->prepare("SELECT rates.rating FROM rates WHERE rates.products_pcode=?");
						 $stmt3->bind_param("i",$pcode);
						 $stmt3->execute();
						 $stmt3->store_result();
						 $stmt3->bind_result($rating);*/

						 if($rating>=3)
						 {
					?>
					<!-- featureCol -->
					<div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-6">
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
								<span class="title d-block mb-2"><?=$pname?></span>
								<span class="price d-block fwEbold" style="visibility: hidden;"><?=$pcode?></span>
								<?php 	if($oldprice!=$newprice)
								{?>
								<span style="text-decoration: line-through;"><?=$oldprice?> $</span>
								<span class="price d-block fwEbold"><?=$newprice?> $</span>
								<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block">Sale</span>
								<?php } else{?>
									<span></span>
									<span class="price d-block fwEbold"><?=$newprice?> $</span>
									<?php }
												if($quantity == 0) { ?> 
												<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block" style="right: 180px; font-size: 15px; margin-top:22px">SOLD OUT</span>
												<?php } ?>
							</div>
						</div>
					</div> <?php }
				 } ?>
				</div>
			</section>
		
			<?php
			if(isset($_SESSION["signedin"]))
			{
				$username = $_SESSION["signedin"];
				$sql = "SELECT subscription FROM customers WHERE username = '{$username}' ";
				if($result = $mysqli -> query($sql))
				{
					$row = $result -> fetch_row();
					$result -> free_result();
				}
				$subscription=$row[0];
				if($subscription!=1)
				{
				?>
			<div class="container">
			<div class=" wow slideInRight container-fluid px-xl-20 px-lg-14">
				<!-- subscribeSecBlock -->
				<section class="subscribeSecBlock bgCover col-12 pt-xl-24 pb-xl-12 pt-lg-20 pt-md-16 pt-10 pb-md-8 pb-5">
					<header class="col-12 mainHeader mb-sm-9 mb-6 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Subscribe</h1>
						<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						<p class="mb-sm-6 mb-3">Subsribe to join our mailing list and keep yourself updated</p>
					</header>
					<div style="text-align:center">
					<div class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
						<button id="subscribe" style="margin-right: auto; margin-left:auto" class="btn btnTheme btnShop fwEbold text-white py-3 px-4">Subscribe <i class="fas fa-arrow-right ml-2"></i></button>
					</div>
					</div>
				</section>
			</div> 
				<?php } ?>
			<div style="width:50%; margin-left:auto; margin-right:auto" class="wow slideInLeft row">
					<div class="col-12">
						<!-- commentFormArea -->
						<header class="col-12 mainHeader mb-sm-9 mb-6 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Leave a comment</h1>
						<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						</header>

						<div class="commentFormArea">
							<div class="commentform">
								<div class="form-group w-100 mb-5">
									<textarea style="color:black" id="comment" maxlength="200" class="form-control" placeholder="comment"></textarea>
								</div>
								<div style="text-align:center">
										<button id="post" style="margin-right: auto; margin-left:auto" class="btn btnTheme btnShop fwEbold text-white py-3 px-4">Post<i class="fas fa-arrow-right ml-2"></i></button>
								</div>
							</fdiv>
						</div>
					</div>
				</div>
			</div>
			<?php  }?>
			</div>
			</section>

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
						<li class="mb-1"><a href="home.php#NewArrival">New Products</a></li>
						<li class="mb-2"><a href="home.php#BestSeller">Top Sellers</a></li>
						<li class="mb-2"><a href="about-us.php">About Our Shop</a></li>
						<li><a href="privacypolicy.html">Privacy policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</aside>

		</main>
		<!-- footer -->
		<footer id="footer" class="container-fluid overflow-hidden px-lg-20">
			<div class="copyRightHolder text-center pt-lg-5 pb-lg-4 py-3">
				<p class="mb-0">Copyright 2019 by <a href="javascript:void(0);">Botanical Store</a> - All right reserved</p>
			</div>
		</footer>

	</div>
	<!-- include jQuery library -->
	<script src="js/jquery-3.4.1.min.js"></script>
	<!-- include bootstrap popper JavaScript -->
	<script src="js/popper.min.js"></script>
	<!-- include bootstrap JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- include custom JavaScript -->
	<script src="js/jqueryCustome.js"></script>

</body>
</html>