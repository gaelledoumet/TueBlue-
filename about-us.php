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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--link to javascript -->
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
		$(document).ready(function($){
			new WOW().init();
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
            whatsapp: "+961111111", // WhatsApp number
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

	</style>
</head>
<body>
<?php 
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
?>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- header -->
		<header id="header" class="position-relative">
				<!-- headerHolder -->
				<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
					<div class="row">
						<div class="col-6 col-sm-2">
							<!-- mainLogo -->
							<div style="width:150%;" class="logo">
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
											<li class="nav-item dropdown">
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="home.php">home</a>
											</li>
											<li class="nav-item dropdown">
											
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="shop.php">Shop</a>
											</li>
											<li class="nav-item active">
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

			<section class=" chooseUs-sec container pt-xl-22 pt-lg-20 pt-md-16 pt-10 pb-xl-12 pb-md-7 pb-2">
				<div class="row">
					<div class="wow slideInLeft col-12 col-lg-6 mb-lg-0 mb-4">
						<img style="width:450px; height:250px" src="images/aboutus.png" alt="image description" class="img-fluid">
					</div>
					<div class=" wow slideInRight col-12 col-lg-6 pr-4">
						<h2 class="headingII fwEbold playfair position-relative mb-6 pb-5">Why choose us ?</h2>
						<p class="mb-xl-14 mb-lg-10"> We ensure a great, professional and friendly user experience.<br>
							You will be able to track your orders, and any undelivered item is our responsibility.<br>
							Our project managers will always be available to answer your questions and listen to problems you might face.<br> 
							Products and offers will always be up to date. <br>
							Our work doesn't stop on launch. We always provide ongoing maintenance and development.</p>
					</div>
				</div>
			</section>
			<section class="processStepSec container pt-xl-23 pb-xl-10 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-0">
				<div class="row">
					<header class="col-12 mainHeader mb-3 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Delivery Process</h1>
						<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
					</header>
				</div>
				<div class="row">
					<div class="wow heartBeat col-12 pl-xl-23 mb-lg-3 mb-10">
						<div class="stepCol position-relative bg-lightGray py-6 px-6">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 01</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Choose your products</h2>
							<p class="mb-5">Choose the products that you desire to buy, or add them to your cart and keep them saved. </p>
						</div>
					</div>
					<div class="col-12 pr-xl-23 mb-lg-3 mb-10">
					<div class="wow heartBeat col-12 pr-xl-23 mb-lg-3 mb-10">
						<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 02</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Get delivered fast</h2>
							<p class="mb-5">The shipper has a deadline of 48 hours to ship your item, and it will then need no more than 5 hours to get delivered to you, depending on where you live. 
								Cash on Delivery.</p>
						</div>
					</div>
				</div>
			</section>
			<section class="teamSec pt-xl-12 pb-xl-21 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-0 pb-4">
				<div class="container">
					<div class="row">
						<header class="col-12 mainHeader mb-9 text-center">
							<h1 class="headingIV playfair fwEblod mb-4">Meet Our Team</h1>
							<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						</header>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
							<article class="teamBlock overflow-hidden">
								<span class="imgWrap position-relative d-block w-100 mb-4">
									<img src="http://placehold.it/370x290" class="img-fluid" alt="image description">
									<ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
										<li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
									</ul>
								</span>
								<div class="textDetail w-100 text-center">
									<h3>
										<strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">redikiel</a></strong>
										<strong class="text-capitalize d-block desination">Co - Founder & CEO</strong>
									</h3>
								</div>
							</article>
						</div>
						<div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
							<article class="teamBlock overflow-hidden">
								<span class="imgWrap position-relative d-block w-100 mb-4">
									<img src="http://placehold.it/370x290" class="img-fluid" alt="image description">
									<ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
										<li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
									</ul>
								</span>
								<div class="textDetail w-100 text-center">
									<h3>
										<strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">Angela</a></strong>
										<strong class="text-capitalize d-block desination">Chief of Marketing Team</strong>
									</h3>
								</div>
							</article>
						</div>
						<div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6">
							<article class="teamBlock overflow-hidden">
								<span class="imgWrap position-relative d-block w-100 mb-4">
									<img src="http://placehold.it/370x290" class="img-fluid" alt="image description">
									<ul class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks">
										<li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
										<li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
									</ul>
								</span>
								<div class="textDetail w-100 text-center">
									<h3>
										<strong class="text-uppercase d-block fwEbold name mb-2"><a href="javascript:void(0);">kevin lee</a></strong>
										<strong class="text-capitalize d-block desination">Art Director</strong>
									</h3>
								</div>
							</article>
						</div>
					</div>
				</div>
			</section>
			<?php if (isset($_SESSION["signedin"]))
			{
           
				// $username = $_SESSION["signedin"];
				// $stmt2=$mysqli->prepare("SELECT subscription FROM customers WHERE username = ?");
				// $stmt2->bindparam("s",$username);
				// $stmt2->execute();
				// $stmt2->store_result();
				// $stmt2->bind_result($subscription);

				$username = $_SESSION["signedin"];
				$sql = "SELECT subscription FROM customers WHERE username = '{$username}' ";
				$results = mysqli_query($mysqli, $sql);
				$row = mysqli_fetch_row($results);
				

				if($row[0]!=1)
				{
				?>
				<div class="container mb-lg-24 mb-md-16 mb-10">
					<!-- subscribeSecBlock -->
					<section class="subscribeSecBlock bgCover col-12 pt-lg-24 pb-lg-12 pt-md-16 pb-md-8 py-10" >
						<header class="col-12 mainHeader mb-9 text-center">
							<h1 class="headingIV playfair fwEblod mb-4">Subscribe</h1>
							<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
							<p class="mb-6">Stay tuned for exciting deals and offers!</p>
						</header>
							<div style="text-align:center">
							<button id="subscribe" style="display:inline-block" class="btn btnTheme btnShop fwEbold text-white py-3 px-4 py-md-3 px-md-4">Subscribe <i class="fas fa-arrow-right ml-2"></i></button>
							</div>
					</section>
				</div><?php } } ?>
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
		<footer id="footer" class="container-fluid overflow-hidden px-lg-20">
			<div class="copyRightHolder text-center pt-lg-5 pb-lg-4 py-3">
				<p class="mb-0">Coppyright 2019 by <a href="javascript:void(0);">Botanical Store</a> - All right reserved</p>
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