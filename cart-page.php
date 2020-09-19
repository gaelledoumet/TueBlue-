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

			var subtotal=0;
			$('#myTable tr').each(function(i) {
				if(i!=0)
				{
					subtotal+=parseFloat($(this).find("td").eq(8).children().eq(0).html()) ;   
				}
 			});
			$("#subtotal").children().eq(0).html(subtotal);
			 

			$(".change").click(function(){
				var pcode=$(this).parent().parent().children().eq(2).html();
				window.location.href="changecart.php?pcode="+pcode;
			});

			$(".remove_item").click(function(){
				var pcode=$(this).parent().parent().children().eq(2).html();
				$.ajax({ url: 'removeitem.php',
                    type: 'POST',
                    data:{
							"code":pcode
                    },
                    dataType: 'text',
                          success: function(txt) {
							$(".modal-body").html("Item successuflly removed from cart.");
							$("#modalbutton").click();
							setTimeout(function(){ window.location.assign("cart-page.php");  }, 2000);
							
                          },
                    
                      });
			});

			$("#checkout").click(function(){
				subtotal=$("#subtotal").children().eq(0).html();
				if(subtotal!="0")
				{
					window.location.assign("confirmcheckout.php?subtotal="+subtotal); 
				}
				else
				{
					$(".modal-body").html("your cart is empty");
					$("#modalbutton").click();				}

		    });
		});
	</script>
	
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
								session_start();?>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
                </div>
            </div>
            </div>
		<!-- Modal -->
		
			<!-- introBannerHolder -->
			<section class="introBannerHolder d-flex w-100 bgCover" style="background-image:url(images/cart.jpg); background-size: 900px 300px;">
			</section>
			<!-- cartHolder -->
			<div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
				<div class="row">
					<!-- table-responsive -->
					<div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
						<!-- cartTable -->
						<table id="myTable" class="table cartTable">
							<thead>
								<tr>
									<th scope="col" class="text-uppercase fwEbold border-top-0">product</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0"></th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Product code</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Quantity</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Size</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Color</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Seller</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">price</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Total</th>
								</tr>
							</thead>
							<tbody>
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
							
							$stmt=$mysqli->prepare("SELECT products_pcode, color, size, quantity FROM cart_has_products WHERE cart_customers_username = ?");
							$stmt-> bind_param ("s", $_SESSION["signedin"]); 
							$stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($pcode,$color,$size,$quantity);
							while($stmt->fetch()) {

								$sql = "SELECT oldprice, newprice, pname, image_url, sellers_username FROM products WHERE pcode = '{$pcode}' ";

								if($result = $mysqli -> query($sql))
								{
									$row = $result -> fetch_row();
									$result -> free_result();
								}
							
								$oldprice=$row[0];
								$newprice=$row[1];
								$pname=$row[2];
								$url=$row[3];
								$seller=$row[4];

								
								$sql2 = "SELECT firstname, lastname FROM sellers WHERE username = '{$seller}' ";

								if($result2 = $mysqli -> query($sql2))
								{
									$row2 = $result2 -> fetch_row();
									$result2 -> free_result();
								}
								$firstname=$row2[0];
								$lastname=$row2[1];

							?>
								<tr class="align-items-center">
									<td class="d-flex align-items-center border-top-0 border-bottom px-0 py-6">
										<div class="imgHolder">
											<img src="<?=$url?>" alt="image description" class="img-fluid">
										</div>
										<span class="title pl-2"><a href="shop-detail.html"><?=$pname?></a></span>
									</td>
									<td class="border-top-0 border-bottom px-0 py-6"><button class="change">Change</button></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$pcode?></td>
									<?php if($quantity==0)
									{?>
									<td style="color:red" class="border-top-0 border-bottom px-0 py-6"><?=$quantity?></td> <?php
									} else { ?>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$quantity?></td> <?php } ?>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$size?></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$color?></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$firstname?> <?=$lastname?></td>
									<td class="fwEbold border-top-0 border-bottom px-0 py-6"><span><?=$newprice?></span> $</td>
									<td class="fwEbold border-top-0 border-bottom px-0 py-6"><span><?=$newprice*$quantity?></span> $ <a class=" remove_item fas fa-times float-right"></a></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
					<div class="col-12 col-md-12">
						<div class="d-flex justify-content-between">
							<p style="display: block; padding-left: 82%;">
							<strong class="txt fwEbold text-uppercase mb-12">subtotal:</strong>
							<strong id="subtotal" class="price fwEbold text-uppercase mb-12"><span>0.00</span> $</strong>
							</p>
						</div>
						<div>
						<a id="checkout" href="javascript:void(0);" class="btn btnTheme w-100 fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">Proceed to checkout</a>
						</div>
					</div>
				</div>
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