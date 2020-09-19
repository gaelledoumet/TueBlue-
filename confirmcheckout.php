<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();
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
	 else if(!isset($_SESSION["signedin"]))
	 {
		header("location:home.php");
	 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
			$("#toshow").hide();
            $("#confirmcheckout").click(function(){

				if((parseInt($("#subtotal").html())==0)||$("#subtotal").html()=="")
				{
					$(".modal-body").html("You can not confirm checkout.");
					$("#modalbutton").click();
				}
				else
				{
					$.ajax({ url: 'checkout.php',
						type: 'POST',
						dataType: 'text',
							success: function(txt) {
										$("#tracking_number").append(txt).append("<br>").append("\nOrder on its way..."); 
							},
						
						});
						$(".tohide").hide();
						$("#toshow").show();
					
				}
			});

		});
	</script>
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- header -->
		<header id="header" class="position-relative">
			<!-- headerHolder -->
			<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
				<div class="row">
					<div class="col-6 col-sm-6">
						<!-- mainLogo -->
						<div style="width:40%;" class="logo">
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
										<li class="nav-item dropdown">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="home.php">home</a>
										</li>
										<li class="nav-item dropdown">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="shop.php">Shop</a>
										</li>
										<li class="nav-item">
											<a class="d-block " href="about-us.php">About</a>
										</li>
										<li class="nav-item">
											<a class="d-block" href="contact-us.html">contact</a>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
                </div>
            </div>
            </div>
		<!-- Modal -->
		
			<?php    
			 $subtotal=$_GET["subtotal"];
			 ?>
			 <p style="visibility:hidden" id="subtotal"><?=$subtotal?></p>
            <!-- introBannerHolder -->
            <header class="col-12 mainHeader mb-7 text-center tohide">
                <h2 class="headingIV playfair fwEblod mb-4">Confirm checkout</h2> 
				<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
            </header>			</section>
			<!-- cartHolder -->
			<div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10 tohide">
					<div class="col-12 col-md-12">
						<div class="d-flex justify-content-between">
							<p style="display: block; ">
							<strong class="txt fwEbold text-uppercase mb-12"></strong>
							<strong  class="price fwEbold text-uppercase mb-12"></strong>
							</p>
							<p style="display: block; ">
							<strong class="txt fwEbold text-uppercase mb-12">subtotal:</strong>
							<strong  class="price fwEbold text-uppercase mb-12"><?=$subtotal?> $</strong>
							</p>
							<p style="display: block; ">
							<strong class="txt fwEbold text-uppercase mb-12">Delivery fee:</strong>
							<strong  class="price fwEbold text-uppercase mb-12">4$</strong>
							</p>
							<p style="display: block;">
							<strong class="txt fwEbold text-uppercase mb-12">Total:</strong>
							<strong  class="price fwEbold text-uppercase mb-12"><?=($subtotal+4)?>$</strong>
							</p>
							<p style="display: block;">
							<strong class="txt fwEbold text-uppercase mb-12"></strong>
							<strong  class="price fwEbold text-uppercase mb-12"></strong>
							</p>
						</div>
						<div>
						<a id="confirmcheckout" href="javascript:void(0);" class="btn btnTheme w-100 fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">Confirm checkout</a>
						</div>
					</div>
			</div>
			<div style="text-align:center" id="toshow">
			<p style="display: block;">
				<strong class="txt fwEbold text-uppercase mb-12">subtotal:</strong>
				<strong  class="price fwEbold text-uppercase mb-12"><?=($subtotal+4)?>$</strong>
			</p>
			<p style="display: block;" id="tracking_number">
			    <strong class="txt fwEbold text-uppercase mb-12">tracking number:</strong>
            </p>
			</div>
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