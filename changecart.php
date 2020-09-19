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
	<link rel="stylesheet" href="stylee.css">
	<!-- include theme plugins setting stylesheet -->
	<link rel="stylesheet" href="css/plugins.css">
	<!-- include theme color setting stylesheet -->
	<link rel="stylesheet" href="css/color.css">
	<!-- include theme responsive setting stylesheet -->
	<link rel="stylesheet" href="css/responsive.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
		$(document).ready(function($){

            $("#update_cart").click(function(){
                var pcode=$(this).parent().children().eq(2).html();
				var color=[];
				$("input[name='colors']:checked").each(function()
				{
					color.push($(this).next().html());
				});
				var size=[];
				$("input[name='sizes']:checked").each(function()
				{
					size.push($(this).next().html());
				});				
				$.ajax({
						url: 'updatecart.php',
						type: "POST",
						datatype: "text",
						data: { "pcode":pcode,
								"color":color,
								"size":size,
								"quantity":$("#quantity").val(),
						},
						success: function(data){
							$(".modal-body").html(data);
							$("#modalbutton").click();
							if(data=="Item updated")
							{
								setTimeout(function(){ window.location.href="cart-page.php"; }, 3000);

							}                              
							},
				});    
            });
		});
	</script>
	<style>
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
							<a href="javascript:void(0);"><img src="images/logo.jpeg" alt="TueBlue" class="img-fluid"></a>
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
					<div class="col-sm-3 col-lg-2">
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
										<a id="tohover" class="dropdown-item" href="order_history.php">order history</a>
										<a id="tohover" class="dropdown-item" href="account.php">My account</a> 
										<a id="tohover" class="dropdown-item" href="logout.php">Logout</a> <?php } ?>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
                </div>
            </div>
            </div>
		<!-- Modal -->

			<!-- introBannerHolder -->
			</section>
			<!-- twoColumns -->
			<div class="twoColumns container pt-xl-23 pb-xl-20 pt-lg-20 pb-lg-20 py-md-16 py-10">
				<div class="row mb-6">
					<div class="col-12 col-lg-6 order-lg-1">
						<!-- productSliderImage -->
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
					$store = $_GET["pcode"];
					$store = (int)$store;
					$results = mysqli_query($mysqli, "SELECT image_url, pname, newprice, category, quantity, sellers_username, description FROM products WHERE pcode={$store}");
					$row = mysqli_fetch_row($results);

					$sql10 = "SELECT firstname, lastname FROM sellers WHERE username = '{$row[5]}' ";
					if($result10 = $mysqli -> query($sql10))
					{
						$row10 = $result10 -> fetch_row();
						$result10 -> free_result();
					}
					$firstname=$row10[0];
					$lastname=$row10[1];
							?>
						<div class="productSliderImage mb-lg-0 mb-4">
							<div>
								<img src="<?=$row[0]?>" alt="image description" class="img-fluid w-100">
							</div>
							<div>
								<img src="<?=$row[0]?>" alt="image description" class="img-fluid w-100">
							</div>
							<div>
								<img src="<?=$row[0]?>" alt="image description" class="img-fluid w-100">
							</div>
							<div>
								<img src="<?=$row[0]?>" alt="image description" class="img-fluid w-100">
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6 order-lg-3">
						<!-- productTextHolder -->
						<div class="productTextHolder overflow-hidden">
							<h2 class="fwEbold mb-2"><?=$row[1]?></h2>
							<?php 
							$results2 = mysqli_query($mysqli, "SELECT rating FROM rates WHERE products_pcode={$store}");
	
							  $sumofrates = 0;
							  $sum = 0;
							  while($row2 = mysqli_fetch_row($results2))
							  {
								  $sumofrates = $sumofrates + 1;
								  $sum = $row2[0] + $sum;
							  }
							  if($sumofrates == 0)
							  {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							  }
							  else{
							   $average = $sum/$sumofrates;

							   if($average == 1)
							   {
								   ?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average>1 && $average<2)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star-half"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if($average == 2)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average>2 && $average<3)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star-half"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average == 3)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average>3 && $average<4)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star-half"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average == 4)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="far fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							   else if ($average>4 && $average<5)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star-half"></i></a></li>
							    </ul>
								   <?php
							   }
							   
							   else if ($average == 5)
							   {
								?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
								<li class="mr-2"><a href="javascript:void(0);"><i class="fas fa-star"></i></a></li>
							    </ul>
								   <?php
							   }
							}
							?>
							<strong class="price d-block mb-5 text-green"><?=$row[2]?> $</strong>
							<p class="mb-5"><strong>Description: <?=$row[6]?></strong> </p>
							<p class="mb-5">Seller: <?=$firstname?> <?=$lastname?></p>
							<ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
								<li class="mb-2">Product Code: <span id="code"><?=$store?></span></li>
								<?php if ($row[4]==0) {?>
								<br>
								<h1><span style="color:orange">SOLD OUT</span></li></h1>
								<?php } else {?>
								<li class="mb-2">Quantity: <span><?=$row[4]?> Item(s)</span></li> 
								<li class="mb-2">Shipping tax: <span>4$</span></li> 
							</ul>
							<?php
							$results3 = mysqli_query($mysqli, "SELECT size FROM sizes WHERE pcode={$store}");
							$keepcount=0;
							$saveme = array();
							while($row3 = mysqli_fetch_row($results3))
							{
								$saveme[$keepcount] = $row3[0];
								$keepcount = $keepcount + 1;
							}
							if($keepcount != 0)
							{
								rsort($saveme);
							?>
							<ul class="list-unstyled sizeList d-flex flex-wrap mb-4">
								<li class="text-uppercase mr-6">Size:</li>
								<?php 
									for($i=0;$i<count($saveme);$i++)
									{
								?>
								<li class="mr-2">
									<label for="check-<?=$i+1?>">
										<input style="height:20px; width:20px;" type="radio" id="check-<?=$i+1?>" name="sizes">
										<label for="coloryes"><?=$saveme[$i]?></label><br>
									</label>
								</li>
								<?php
							        }
							?>
							</ul>
							<?php
							}
							?>

							<?php 
							$results4 = mysqli_query($mysqli, "SELECT color FROM colors WHERE pcode={$store}");
							$keepcount1 = 0;
							$saveme1 = array();
							while($row4 = mysqli_fetch_row($results4))
							{
								$saveme1[$keepcount1] = $row4[0];
								$keepcount1 = $keepcount1 + 1;
							}
							if($keepcount1 != 0)
							{
							?>
							<ul class="list-unstyled sizeList d-flex flex-wrap mb-4">
							<li class="text-uppercase mr-6">Color:</li>
							<?php 
								for($j=0;$j<count($saveme1);$j++)
								{
							?>
									<li class="mr-2">
									<label for="check-<?=$j+1?>">
									<input style="height:20px; width:20px;" type="radio" id="check-<?=$j+1?>" name="colors">
									<label for="coloryes"><?=$saveme1[$j]?></label>
									</li>
									</label>
							<?php } ?>
							</ul>
							<?php 
							}
							?>
							<div class="holder overflow-hidden d-flex flex-wrap mb-6">
								<input id="quantity" type="number" onkeydown="return false" placeholder="1" min="1" max=<?=$row[4]?>/>
									<a id="update_cart" class="btn btnTheme btnShop fwEbold text-white md-round py-3 px-4 py-md-3 px-md-4">Update Cart <i class="fas fa-arrow-right ml-2"></i></a>
									<p style="visibility: hidden"><?=$store?></p>
							</div>
							
							<ul class="list-unstyled productInfoDetail mb-0">
								<li class="mb-2">Category: <?=$row[3]?></li>
							</br>
							</ul>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<!-- paggSlider -->
						<div class="paggSlider">
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- tabSetList -->
						<ul class="list-unstyled tabSetList d-flex justify-content-center mb-9">
							<li>
								<?php
							$results3 = mysqli_query($mysqli, "SELECT review FROM rates WHERE products_pcode={$store}");
	
							$numofrev = 0;
							while($row3 = mysqli_fetch_row($results3))
								{
										if($row3[0] != null)
										    {
												$numofrev = $numofrev + 1;
											}
								}
								if($numofrev!=0)
								{
								?>
								
								<a href="#tab2-0" class="playfair fwEbold pb-2">Reviews  (<?=$numofrev?>)</a>
							</li>
						</ul>
						<!-- tab-content -->
						<div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
						<?php
							$results4 = mysqli_query($mysqli, "SELECT customers_username, review FROM rates WHERE products_pcode={$store}");
	
							while($row4 = mysqli_fetch_row($results4))
								{
									if($row4[1] != null)
									{
										?>
										<div id="tab1-0" class="active">
								       		 <p style="text-align: center"><label style="font-weight:700"><?=$row4[0]?>:</label> <?=$row4[1]?></p>
										</div>
										<?php
									}
								}
							}
								?>
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