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
    $(document).ready(function()
    {
	  $(".addrating").click(function()
			{
				var pcode=$(this).parent().parent().children().eq(1).html();
				window.location.href="addrating.php?pcode="+pcode;   
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
		<header class="col-12 mainHeader mb-7 text-center">
                <h2 class="headingIV playfair fwEblod mb-4">Your Order</h2> 
				<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
            </header>
			<div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
				<div class="row">
					<!-- table-responsive -->
					<div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
						<!-- cartTable -->
						<table id="myTable" class="table cartTable">
							<thead>
								<tr>
									<th scope="col" class="text-uppercase fwEbold border-top-0">product</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Product code</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">Seller</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">price</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">quantity</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">color</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0">size</th>
									<th scope="col" class="text-uppercase fwEbold border-top-0"></th>
									<th scope="col" class="text-uppercase fwEbold border-top-0"></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							error_reporting(E_ERROR | E_PARSE);
							$db_host="localhost";
							$db_user="root";
							$db_pass=null;
							$db_name="tueblue";
								
							$oid=$_GET["oid"];
							$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);
										 
							if (mysqli_connect_errno())
							{
								echo("connect failed");
								exit();
							}
							
							$stmt=$mysqli->prepare("SELECT products_pcode,color,size,quantity FROM orders_has_products WHERE orders_oid = ?");
							$stmt-> bind_param ("i", $oid); 
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
									<td class="border-top-0 border-bottom px-0 py-6"><?=$pcode?></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$firstname?> <?=$lastname?></td>
									<td class="fwEbold border-top-0 border-bottom px-0 py-6"><span><?=$newprice?></span> $</td>
									<td style="text-align:center" class="border-top-0 border-bottom px-0 py-6"><?=$quantity?></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$color?></td>
									<td class="border-top-0 border-bottom px-0 py-6"><?=$size?></td>
									<td class="border-top-0 border-bottom px-0 py-6">
										<button style="margin-right:-20px" class="addrating">Rate product</button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
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