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
		
		var stars;
            $(".ifrate").hover(function()
            {
                var id = $(this).attr("id");
                if(id=="star1")
                {
                   $("#star1").toggleClass("fas");
                }
                else if(id=="star2")
                {
                    $("#star1").toggleClass("fas");
                    $("#star2").toggleClass("fas");

                }
                else if(id=="star3")
                {
                    $("#star1").toggleClass("fas");
                    $("#star2").toggleClass("fas");
                    $("#star3").toggleClass("fas");

                }
                else if(id=="star4")
                {
                    $("#star1").toggleClass("fas");
                    $("#star2").toggleClass("fas");
                    $("#star3").toggleClass("fas");
                    $("#star4").toggleClass("fas");
                }
                else if(id=="star5")
                {
                    $("#star1").toggleClass("fas");
                    $("#star2").toggleClass("fas");
                    $("#star3").toggleClass("fas");
                    $("#star4").toggleClass("fas");
                    $("#star5").toggleClass("fas");

                }
            });


            $(".ifrate").click(function()
            {
                var id = $(this).attr("id");
                if(id=="star1")
                {
                        $("#star1").removeClass("far");
                        $("#star1").addClass("fa");
                        $("#star2").removeClass("fa");
                        $("#star2").addClass("far");
                        $("#star3").removeClass("fa");
                        $("#star3").addClass("far");
                        $("#star4").removeClass("fa");
                        $("#star4").addClass("far");
                        $("#star5").removeClass("fa");
                        $("#star5").addClass("far");

                }
                else if(id=="star2")
                {
                    $("#star1").removeClass("far");
                    $("#star1").addClass("fa");
                    $("#star2").removeClass("far");
                    $("#star2").addClass("fa");
                    $("#star3").removeClass("fa");
                    $("#star3").addClass("far");
                        $("#star4").removeClass("fa");
                        $("#star4").addClass("far");
                        $("#star5").removeClass("fa");
                        $("#star5").addClass("far");
                }
                else if(id=="star3")
                {
                    $("#star1").removeClass("far");
                    $("#star1").addClass("fa");
                    $("#star2").removeClass("far");
                    $("#star2").addClass("fa");
                    $("#star3").removeClass("far");
                    $("#star3").addClass("fa");
                    $("#star4").removeClass("fa");
                        $("#star4").addClass("far");
                        $("#star5").removeClass("fa");
                        $("#star5").addClass("far");

                }
                else if(id=="star4")
                {
                    $("#star1").removeClass("far");
                    $("#star1").addClass("fa");
                    $("#star2").removeClass("far");
                    $("#star2").addClass("fa");
                    $("#star3").removeClass("far");
                    $("#star3").addClass("fa");
                    $("#star4").removeClass("far");
                    $("#star4").addClass("fa");
                    $("#star5").removeClass("fa");
                        $("#star5").addClass("far");

                }
                else if(id=="star5")
                {
                    $("#star1").removeClass("far");
                    $("#star1").addClass("fa");
                    $("#star2").removeClass("far");
                    $("#star2").addClass("fa");
                    $("#star3").removeClass("far");
                    $("#star3").addClass("fa");
                    $("#star4").removeClass("far");
                    $("#star4").addClass("fa");
                    $("#star5").removeClass("far");
                    $("#star5").addClass("fa");
                }
            });
			
            $("#rate").click(function(){
                stars=0;
                $(".fa-star").each(function()
                {
                    if($(this).hasClass("fa"))
                    {
                        stars++;
                    }
                });
				$(".modal-body").html("Are you sure you want to rate this product for "+stars+" stars?");
				$("#modalbutton").click();
            });

		$("#confirm").click(function(){
			$.ajax({
							url: 'rating.php',
							type: "POST",
							datatype: "text",
							data: { "stars":stars,
									"pcode":$("#code").html(),
							},
							success: function(data){
								$(".modal-body").html(data);
								$("#modalbutton").click();
								setTimeout(function(){window.location.reload(); }, 1000);								
								},
					});
		  });


			$("#post").click(function(){
					$.ajax({
							url: 'review.php',
							type: "POST",
							datatype: "text",
							data: { "review":$("#review").val(),
									"pcode":$("#code").html(),
							},
							success: function(data){
								window.location.reload();
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
										<a id="tohover" class="dropdown-item" href="order_history.php">Order History</a>
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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="button" class="btn" id="confirm">Yes</button>
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
						</div>
					</div>
					<div class="col-12 col-lg-6 order-lg-3">
						<!-- productTextHolder -->
						<div class="productTextHolder overflow-hidden">
							<h2 class="fwEbold mb-2"><?=$row[1]?></h2>
							<strong class="price d-block mb-5 text-green"><?=$row[2]?> $</strong>
							<p class="mb-5"><strong>Description: <?=$row[6]?></strong> </p>
							<ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
								<li class="mb-2">Seller: <?=$firstname?> <?=$lastname?></li>
								<li class="mb-2">Product Code: <span id="code"><?=$store?></span></li>
								<li class="mb-2">Category: <?=$row[3]?></li>
							</br>
                            </ul>
							<?php 
								$username=$_SESSION["signedin"];
								$sql11 = "SELECT rating FROM rates WHERE customers_username='{$username}' AND products_pcode='{$store}' ";
								if($result11 = $mysqli -> query($sql11))
								{
									$row11 = $result11 -> fetch_row();
									$result11 -> free_result();
								}
								$rating=$row11[0];
								if($rating=="")
								{
							?>
                            <ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="far fa-star ifrate"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="far fa-star ifrate"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="far fa-star ifrate"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="far fa-star ifrate"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star ifrate"></i></a></li>
							</ul>
							<br>
							<button class="btn btnTheme btnShop fwEbold text-white py-3 px-4" id="rate">Rate</button>
								<?php }
								else {
								if($rating==0)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star"></i></a></li>
								</ul>
								<?php }else if($rating==1)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star"></i></a></li>
								</ul>
								<?php } else if($rating==2)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star"></i></a></li>
								</ul>
								<?php } else if($rating==3)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="far fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star"></i></a></li>
								</ul>
								<?php }  else if($rating==4)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="fas fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="far fa-star"></i></a></li>
								</ul>
								<?php } else if($rating==5)
								{?>
								<ul class="list-unstyled ratingList d-flex flex-nowrap mb-2">
								<li class="mr-2"><a><i id="star1" style="font-size:24px" class="fa fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star2" style="font-size:24px" class="fa fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star3" style="font-size:24px" class="fa fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star4" style="font-size:24px" class="fa fa-star"></i></a></li>
								<li class="mr-2"><a><i id="star5" style="font-size:24px" class="fa fa-star"></i></a></li>
								</ul>
								<?php }
								} ?>							
						</div>
					</div>
				</div>
			</div>
			<?php

			$username=$_SESSION["signedin"];
			$store=$_GET["pcode"];			
			$sql2 = "SELECT review FROM rates WHERE customers_username= '{$username}' AND products_pcode= '{$store}'";
			if($result2 = $mysqli -> query($sql2))
			{
				$row2 = $result2 -> fetch_row();
				$result2 -> free_result();
			}
			$review=$row2[0];
			if(($review!="")&&($review=="none"))
			{
			?>
			<div id="tohide" style="width:50%; margin-left:auto; margin-right:auto" class="row">
					<div class="col-12">
						<!-- commentFormArea -->
						<header class="col-12 mainHeader mb-sm-9 mb-6 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Write your review</h1>
						<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						</header>

						<div class="commentFormArea">
								<div class="form-group w-100 mb-5">
									<textarea style="color:white" id="review" maxlength="200" class="form-control" placeholder="I like this product."></textarea>
								</div>
								<div style="text-align:center">
										<button id="post" style="margin-right: auto; margin-left:auto" class="btn btnTheme btnShop fwEbold text-white py-3 px-4">Post<i class="fas fa-arrow-right ml-2"></i></button>
								</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br> <?php } ?>
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
										if(($row3[0] != null)&&(($row3[0] != "none")))
										    {
												$numofrev = $numofrev + 1;
											}
								}
								if($numofrev!=0)
								{
								?>
								<a href="#tab2-0" class="playfair fwEbold pb-2">Reviews  (<?=$numofrev?>)</a> <?php } ?>
							</li>
						</ul>
						<!-- tab-content -->
						<div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
						<?php
							$results4 = mysqli_query($mysqli, "SELECT customers_username, review FROM rates WHERE products_pcode={$store}");
	
							while($row4 = mysqli_fetch_row($results4))
								{
									if(($row4[1] != null ) && ($row4[1] !="none"))
									{
										?>
										<div id="tab1-0" class="active">
								       		 <p style="text-align:center"><label style="font-weight:700"><?=$row4[0]?>:</label> <?=$row4[1]?></p>
										</div>
										<?php
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
</body>
</html>