
<!DOCTYPE html>
<?php session_start();
	//session_destroy();
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
	<style> 
	.forcolor{
		color : green;
	}
	</style>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
    $(document).ready(function()
      {
		if(($(".number").first().children().eq(0).html())=="1")
		{
			$("#arrow2").hide();
			$("#arrow").show();
		}
		else
		{
			if((parseInt($(".number").first().children().eq(0).html()))==(parseInt($("#numofpages").html())-1))
			{
				$("#arrow").hide();
				$("#arrow2").show();
			}
			else if((parseInt($(".number").first().children().eq(0).html()))==(parseInt($("#numofpages").html())))
			{
				$("#arrow").hide();
				$("#arrow2").show();
			}
			else
			{
				$("#arrow").show();
				$("#arrow2").show();
			}

		}

        $("#subscribe").click(function()
            {
					 $.ajax({ url: 'subscribe.php',
                    type: 'POST',
                    dataType: 'text',

                    success: function(txt) {
									$(".modal-body").html(txt);
							        $("#modalbutton").click();
									setTimeout(function(){ window.location.reload();}, 3000);
                          },
                    
                      });
          });

            $(".number").click(function()
			{
				if($(this).hasClass("active"))
				{
					$(".modal-body").html("already clicked");
					$("#modalbutton").click();
				}
				else{
					var num=$(this).children().eq(0).html();
					$.ajax({
							url: 'changepage.php',
							type: "POST",
							datatype: "text",
							data: { "num":num,},
							success: function(data){
									setTimeout(function(){
										location.reload();
										},700);
									$(window).scrollTop(0);
								},
					});  
				}  
  			});

			$(".icon-eye").click(function()
			{
				var pcode=$(this).parent().parent().parent().parent().children().eq(1).children().eq(1).html();
				window.location.href="shop-detail.php?pcode="+pcode;
			});

			$(".category").click(function()
			{
				$.ajax({
						url: 'setcategory.php',
						type: "POST",
						datatype: "text",
						data: { "category":($(this).children().eq(0)).html(),},
						success: function(data){
								window.location.href="shop.php";
							},
				});   
			});
			$(".sort").click(function()
			{

				  $.ajax({
						url: 'setsort.php',
						type: "POST",
						datatype: "text",
						data: { "sort":$(this).html(),},
						success: function(data){
							$(this).addClass("selected");
							location.reload();
							},
				});   
			});

		$(".b_search").click(function()
			{
				var pcode=$(this).parent().children().eq(0).val();
				$.ajax({
						url: 'search.php',
						type: "POST",
						datatype: "text",
						data: { "search":pcode,},
						success: function(data){
							location.reload();
							},
				});    
  			});

			$("#price").click(function()
			{
				$(this).parent().children().eq(1).children("option:selected").html(am);
				var am = $(this).parent().children().eq(1).children("option:selected").val();
				if(am == "Back to default")
				{
					var am1 = 2;
					var am2 = 2;
				}
				else if(am != ">200")
				{
				    var am1 = am.substring(0, am.indexOf(' '));
				    var am2 = am.substring(am.indexOf(' ')+4);
				}
				else{
					var am1 = 200;
					var am2 = 1;
				}
				
				$.ajax({
						url: 'setfilter.php',
						type: "POST",
						datatype: "text",
						data: { "amount1":am1,
						        "amount2":am2},
						success: function(data){
								location.reload();
							},
				});    
			});

			$("#arrow").click(function()
            { 
				var number;
				$(".number").each(function(i){
					if(i==0)
					{
						number=parseInt($(this).children().eq(0).html())+2;
					}
					  if((parseInt($("#numofpages").html())) > (parseInt($(this).children().eq(0).html())+2))
					  {
						  $(this).children().eq(0).html(parseInt($(this).children().eq(0).html())+2);
					  }
					  else if((parseInt($("#numofpages").html())) == (parseInt($(this).children().eq(0).html())+2)){
						  
						$(this).children().eq(0).html(parseInt($(this).children().eq(0).html())+2);
					  }
					});
				
				$.ajax({
						url: 'changepage.php',
						type: "POST",
						datatype: "text",
						data: { "num":number,},
						success: function(data){
								setTimeout(function(){
									location.reload();
                                       },700);
								$(window).scrollTop(0);
							},
				}); 
				
			});
			
			$("#arrow2").click(function()
            { 
				var number;
				$(".number").each(function(i){
					if(i==0)
					{
						number=parseInt($(this).children().eq(0).html())-2;
					}
						  $(this).children().eq(0).html(parseInt($(this).children().eq(0).html())-2);
				});
				$.ajax({
						url: 'changepage.php',
						type: "POST",
						datatype: "text",
						data: { "num":number,},
						success: function(data){
								setTimeout(function(){
									location.reload();
                                       },700);
								$(window).scrollTop(0);
							},
				});
            });
		});


    </script>

	<style>
		html {
  scroll-behavior: smooth;
		}
		#hover{
			curser: pointer;
		}
		#tohover:hover{
			color:white;
			background-color:forestgreen;
		}

	</style>
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
										<li class="nav-item active dropdown">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
                </div>
            </div>
            </div>
		<!-- Modal -->
		
<!-- twoColumns -->
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url(images/blog.jpg);"></section>
			<div class="twoColumns container pt-lg-23 pb-lg-20 pt-md-16 pb-md-4 pt-10 pb-4">
				<div class="row">
					<div class="col-12 col-lg-9 order-lg-3">
						<!-- content -->
						<article id="content">
							<!-- show-head -->
							<header class="show-head d-flex flex-wrap justify-content-between mb-7">
								<!-- sortGroup -->
								<div class="sortGroup">
									<div class="d-flex flex-nowrap align-items-center">
										<strong class="groupTitle mr-2">Sort by:</strong>
										<div class="dropdown">
										<?php
										if((!isset($_SESSION["sort"])))
										{
										?>
										<button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Default sorting</button>
											<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												<li class="sort"><a>Newest</a></li>
												<li class="sort"><a>Oldest</a></li>
												<li class="sort"><a>Price: low to high</a></li>
												<li class="sort"><a>Price: high to low</a></li>
											</ul> 
										<?php }
										 else{
											if($_SESSION["sort"] == "<a>Default sorting</a>")
											 {
												 ?>
				
												 <button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Default sorting</button>
											     <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												 <li class="sort"><a>Newest</a></li>
												<li class="sort"><a>Oldest</a></li>
												<li class="sort"><a>Price: low to high</a></li>
												<li class="sort"><a>Price: high to low</a></li>
											    </ul> 
												 <?php
											 }
											 if($_SESSION["sort"] == "<a>Newest</a>")
											 {
												 ?>
				
												 <button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Newest</button>
											     <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												 <li class="sort"><a>Default sorting</a></li>
												<li class="sort"><a>Oldest</a></li>
												<li class="sort"><a>Price: low to high</a></li>
												<li class="sort"><a>Price: high to low</a></li>
											    </ul> 
												 <?php
											 }
											 if($_SESSION["sort"] == "<a>Oldest</a>")
											 {
												 ?>
												<button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Oldest</button>
											     <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												 <li class="sort"><a>Default sorting</a></li>
												<li class="sort"><a>Newest</a></li>
												<li class="sort"><a>Price: low to high</a></li>
												<li class="sort"><a>Price: high to low</a></li>
											    </ul> 
												 <?php
											 }
											 if($_SESSION["sort"] == "<a>Price: low to high</a>")
											 {
												 ?>
												<button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Price: low to high</button>
											     <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												 <li class="sort"><a>Default sorting</a></li>
												<li class="sort"><a>Newest</a></li>
												<li class="sort"><a>Oldest</a></li>
												<li class="sort"><a>Price: high to low</a></li>
											    </ul> 
												 <?php
											 }
											 if($_SESSION["sort"] == "<a>Price: high to low</a>")
											 {
												 ?>
												<button class="dropdown-toggle buttonReset" type="button" id="sortGroup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Price: high to low</button>
											     <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sortGroup">
												 <li class="sort"><a>Default sorting</a></li>
												<li class="sort"><a>Newest</a></li>
												<li class="sort"><a>Oldest</a></li>
												<li class="sort"><a>Price: low to high</a></li>
											    </ul> 
												 <?php
											 }
										 }
											?>
										</div>
									</div>
								</div>
							</header>
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
									  
									 if(!isset($_SESSION["number"]))
									 {
										 $savenumber = 1;
									 }
									 else{
										 $savenumber = $_SESSION["number"];
									 }
									 
									 if((!isset($_SESSION["category"])) || (isset($_SESSION["category"]) && $_SESSION["category"] == "Uncategorized"))
									 { 
										if((!isset($_SESSION["sort"])))
										{ 
											if(!isset($_SESSION["filter1"]) || $_SESSION["filter1"]==2)
											{
											$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products");
											$stmt2->execute();
											$stmt2->store_result();
											$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
											}
											
											else if($_SESSION["filter2"] == 1){
												$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ?");
												$stmt2->bind_param("i", $_SESSION["filter1"]);
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
											}
											else{
												$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice <= ? && newprice >= ?");
												$stmt2->bind_param("ii", $_SESSION["filter2"], $_SESSION["filter1"]);
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
											}
										}
										 else if(isset($_SESSION["sort"]))
										 {
											if($_SESSION["sort"] == "<a>Default sorting</a>")
											{
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products");
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1)
													{
															$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ?");
															$stmt2->bind_param("i", $_SESSION["filter1"]);
															$stmt2->execute();
															$stmt2->store_result();
															$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? && newprice <= ?");
														$stmt2->bind_param("ii", $_SESSION["filter1"], $_SESSION["filter2"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
												}
											}
											 if($_SESSION["sort"] == "<a>Newest</a>")
											 {
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products ORDER BY dateadded DESC");
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? ORDER BY dateadded DESC");
														$stmt2->bind_param("i", $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? && newprice <= ? ORDER BY dateadded DESC");
														$stmt2->bind_param("ii", $_SESSION["filter1"], $_SESSION["filter2"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
												}
											 }
											 if($_SESSION["sort"] == "<a>Oldest</a>")
											 {
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products ORDER BY dateadded ASC");
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1) {
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? ORDER BY dateadded ASC");
														$stmt2->bind_param("i", $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? && newprice <= ? ORDER BY dateadded ASC");
														$stmt2->bind_param("ii", $_SESSION["filter1"], $_SESSION["filter2"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
												}
											 }
											 if($_SESSION["sort"] == "<a>Price: low to high</a>")
											 {
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products ORDER BY newprice ASC");
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1) {
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? ORDER BY newprice ASC");
														$stmt2->bind_param("i", $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? && newprice <= ? ORDER BY newprice ASC");
														$stmt2->bind_param("ii", $_SESSION["filter1"], $_SESSION["filter2"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
												}
											 }
											 if($_SESSION["sort"] == "<a>Price: high to low</a>")
											 {
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products ORDER BY newprice DESC");
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1) {
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? ORDER BY newprice DESC");
														$stmt2->bind_param("i", $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE newprice >= ? && newprice <= ? ORDER BY newprice DESC");
														$stmt2->bind_param("ii", $_SESSION["filter1"], $_SESSION["filter2"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
												}
											 }
										 }
									}
									 else
									 {	
										if((!isset($_SESSION["sort"])))
										{
											if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
											$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =?");
											$stmt2->bind_param("s", $_SESSION["category"]);
											$stmt2->execute();
											$stmt2->store_result();
											$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
											}

											else{
												if($_SESSION["filter2"] == 1)
												{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =?&& newprice >= ?");
													$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
												$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ?");
												$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
											}
										}
										else if(isset($_SESSION["sort"]))
										{
											if($_SESSION["sort"] == "<a>Default sorting</a>")
											{
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
												$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =?");
												$stmt2->bind_param("s", $_SESSION["category"]);
												$stmt2->execute();
												$stmt2->store_result();
												$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}
												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =?&& newprice >= ?");
														$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ?");
													$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												} 
											}
											}

											if($_SESSION["sort"] == "<a>Newest</a>")
											{ 
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
											   $stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products WHERE category=? ORDER BY dateadded DESC");
											   $stmt2->bind_param("s", $_SESSION["category"]);
											   $stmt2->execute();
											   $stmt2->store_result();
											   $stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}

												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice >= ? ORDER BY dateadded DESC");
														$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ? ORDER BY dateadded DESC");
													$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												} }
											}
											if($_SESSION["sort"] == "<a>Oldest</a>")
											{
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
											   $stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products WHERE category=? ORDER BY dateadded ASC");
											   $stmt2->bind_param("s", $_SESSION["category"]);
											   $stmt2->execute();
											   $stmt2->store_result();
											   $stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}

												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice >= ? ORDER BY dateadded ASC");
														$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ? ORDER BY dateadded ASC");
													$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												} }
											}
											if($_SESSION["sort"] == "<a>Price: low to high</a>")
											{
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
											   $stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products WHERE category=? ORDER BY newprice ASC");
											   $stmt2->bind_param("s", $_SESSION["category"]);
											   $stmt2->execute();
											   $stmt2->store_result();
											   $stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}

												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice >= ? ORDER BY newprice ASC");
														$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ? ORDER BY newprice ASC");
													$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												} }
											}
											if($_SESSION["sort"] == "<a>Price: high to low</a>")
											{
												if((!isset($_SESSION["filter1"])) || $_SESSION["filter1"]==2) {
											   $stmt2=$mysqli->prepare("SELECT pcode,oldprice,newprice,pname,image_url, initialquantity, quantity FROM products WHERE category=? ORDER BY newprice DESC");
											   $stmt2->bind_param("s", $_SESSION["category"]);
											   $stmt2->execute();
											   $stmt2->store_result();
											   $stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												}

												else{
													if($_SESSION["filter2"] == 1)
													{
														$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice >= ? ORDER BY newprice DESC");
														$stmt2->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
														$stmt2->execute();
														$stmt2->store_result();
														$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
													}
													else{
													$stmt2=$mysqli->prepare("SELECT pcode, oldprice, newprice, pname, image_url, initialquantity, quantity FROM products WHERE category =? && newprice <= ? && newprice >= ? ORDER BY newprice DESC");
													$stmt2->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
													$stmt2->execute();
													$stmt2->store_result();
													$stmt2->bind_result($pcode,$oldprice,$newprice,$pname,$url, $initial, $quantity);
												} }
											}
										}
										}

									 $count= 0;
									 $x = (($savenumber-1)*12)+1;
									 $y = $savenumber*12;	   
									  while($stmt2->fetch()) {
										  if(!isset($_SESSION["search"]))
										  {
												   $count++;
										      if($count>=$x && $count<=$y)
										      {
									  
									 ?>
								<!-- featureCol -->
								<div class="col-12 col-sm-6 col-lg-4 featureCol mb-7">
									<div class="border">
										<div class="imgHolder position-relative w-100 overflow-hidden">
											<img  style="width:80px;height:300px" src="<?=$url?>" alt="image description" class="img-fluid w-100">
											<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
											<li class="mr-2 overflow-hidden">
											<li class="mr-2 overflow-hidden"><a class="icon-eye d-block"></a></li>
											<li class="mr-2 overflow-hidden">
											</ul>
										</div>
										<div class="text-center py-5 px-4">
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
												<?php }
												$stmt5=$mysqli->prepare("SELECT rating FROM rates WHERE products_pcode = ?");
												$stmt5->bind_param("i", $pcode);
												$stmt5->execute();
												$stmt5->store_result();
												$stmt5->bind_result($rates);
												$count5 = $stmt5->num_rows;
												$sum =0;

												while($stmt5->fetch())
												{
													$sum=$sum+$rates;
												}
												if($count5!=0)
												{
													$avv=$sum/$count5;
													if($avv >=3)
													{
														?>
														<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
														<?php
													}
												}
												?>
										</div>
									</div>
								</div>
							
							
			
					
								<?php 
										  } } 
										else if(isset($_SESSION["search"]))
										{
											if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
												$count++;
												if($count>=$x && $count<=$y)
												{
										
									   ?>
								  <!-- featureCol -->
								  <div class="col-12 col-sm-6 col-lg-4 featureCol mb-7">
									  <div class="border">
										  <div class="imgHolder position-relative w-100 overflow-hidden">
											  <img  style="width:80px;height:300px" src="<?=$url?>" alt="image description" class="img-fluid w-100">
											  <ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0"> 
												<li class="mr-2 overflow-hidden">
												<li class="mr-2 overflow-hidden"><a class="icon-eye d-block"></a></li>
												<li class="mr-2 overflow-hidden">
											</ul>
										  </div>
										  <div class="text-center py-5 px-4">
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
												  $stmt5=$mysqli->prepare("SELECT rating FROM rates WHERE products_pcode = ?");
												  $stmt5->bind_param("i", $pcode);
												  $stmt5->execute();
												  $stmt5->store_result();
												  $stmt5->bind_result($rates);
												  $count5 = $stmt5->num_rows;
												  $sum =0;
  
												  while($stmt5->fetch())
												  {
													  $sum=$sum+$rates;
												  }
												  if($count5!=0)
												  {
													  $avv=$sum/$count5;
													  if($avv >=3)
													  {
														  ?>
														  <span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
														  <?php
													  }
												  }
												  ?>
										  </div>
									  </div>
								  </div>
								  <?php 
											} }
										}
									} //while
								?>
								<div class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3">
									<!-- pagination -->
									<ul class="list-unstyled pagination d-flex justify-content-center align-items-end">
										<!-- <li><a href="javascript:void(0);"><i class="fas fa-chevron-left"></i></a></li> -->
										<?php
										if( (!(isset($_SESSION["category"]))) || ((isset($_SESSION["category"]))&& ($_SESSION["category"]=="Uncategorized")))
										{
										  if(!isset($_SESSION["filter1"]))
											{
										  $stmt6=$mysqli->prepare("SELECT pcode FROM products");
										  $stmt6->execute();
										  $stmt6->store_result();
										  $stmt6->bind_result($ppcode);
											
										  $count6 = 0;
										  if(!isset($_SESSION["search"]))
										  {
										  while($stmt6->fetch())
											  $count6 = $count6 + 1;
										  }
										  else{
											if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
												$count6 = $count6 + 1;
											}
										  }
										}
										else if (isset($_SESSION["filter1"]) && $_SESSION["filter1"]!=200)
										{
											$stmt6=$mysqli->prepare("SELECT pcode FROM products WHERE newprice <=? && newprice >=?");
											$stmt6->bind_param("ii", $_SESSION["filter2"], $_SESSION["filter1"]);
											$stmt6->execute();
											$stmt6->store_result();
											$stmt6->bind_result($ppcode);
											$count6 = 0;
											if(!isset($_SESSION["search"])) {
											while($stmt6->fetch())
												$count6 = $count6 + 1;
											}
											else{
												if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
													$count6 = $count6 + 1;
												}
											}
										}
										else if($_SESSION["filter1"]==200)
										{
											$stmt6=$mysqli->prepare("SELECT pcode FROM products WHERE newprice >=?");
											$stmt6->bind_param("i", $_SESSION["filter1"]);
											$stmt6->execute();
											$stmt6->store_result();
											$stmt6->bind_result($ppcode);
											$count6 = 0;
											if(!isset($_SESSION["search"])) {
											while($stmt6->fetch())
												$count6 = $count6 + 1;
											}
											else{
												if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
													$count6 = $count6 + 1;
												}
											}
										}
										}
										else{
											if(!isset($_SESSION["filter1"])) {
											$stmt6=$mysqli->prepare("SELECT pcode FROM products WHERE category=?");
											$stmt6->bind_param("s", $_SESSION["category"]);
											$stmt6->execute();
											$stmt6->store_result();
											$stmt6->bind_result($ppcode);
											$count6 = 0;
											if(!isset($_SESSION["search"])) {
											while($stmt6->fetch())
												$count6 = $count6 + 1;
											}
											else{
												if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
													$count6 = $count6 + 1;
												}
											}
											}

											else if (isset($_SESSION["filter1"]) && $_SESSION["filter1"]!=200)
											{
												$stmt6=$mysqli->prepare("SELECT pcode FROM products WHERE category=? && newprice <=? && newprice >=?");
												$stmt6->bind_param("sii", $_SESSION["category"], $_SESSION["filter2"], $_SESSION["filter1"]);
												$stmt6->execute();
												$stmt6->store_result();
												$stmt6->bind_result($ppcode);
												$count6 = 0;
												if(!isset($_SESSION["search"])) {
												while($stmt6->fetch())
													$count6 = $count6 + 1;
												}
												else{
													if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
														$count6 = $count6 + 1;
													}
												}
											}
											else if ($_SESSION["filter1"]==200)
											{
												$stmt6=$mysqli->prepare("SELECT pcode FROM products WHERE category=? &&  newprice >=?");
												$stmt6->bind_param("si", $_SESSION["category"], $_SESSION["filter1"]);
												$stmt6->execute();
												$stmt6->store_result();
												$stmt6->bind_result($ppcode);
												$count6 = 0;
												if(!isset($_SESSION["search"])) {
												while($stmt6->fetch())
													$count6 = $count6 + 1;
												}
												else{
													if ((stripos($description, $_SESSION["search"]) !== false) || (stripos($pname, $_SESSION["search"]) !== false)) {
														$count6 = $count6 + 1;
													}
												}
											}
										}
										  
										  if($count6!=0)
										  {
											
											  if($count6%12 == 0){
												 $numofpages = (int)($count6/12);
											  }
											  else{
												 $numofpages = (int)(($count6+12)/12);
											  }
										  }
										  ?>
										  <p hidden id="numofpages"><?=$numofpages?></p>
										  <?php
										  if($numofpages==0)
										  {
											  ?><p>There are no results.</p><?php
										  }
										  if($numofpages < 3)
										  {
											if($numofpages==1)
											{?>
												<li class="active number"><a>1</a></li><?php
											}
											else if($numofpages==2)
											{
												if(isset($_SESSION["number"]))
												{
													$number = $_SESSION["number"];
													if($number==1)
													{?>
														<li class="active number"><a>1</a></li>
														<li class="number"><a>2</a></li>
														<?php
													}
													else
													{?>
														<li class="number"><a>1</a></li>
														<li class="active number"><a>2</a></li><?php
													}
												}
												else
												{?>
													<li class="active number"><a>1</a></li>
													<li class="number"><a>2</a></li><?php
												}
											}
										  }
										else{
												?>

												<li><a id="arrow2"><i class="fas fa-chevron-left"></i></a></li><?php

												if($numofpages%2==1)
												{
													if(isset($_SESSION["number"]))
													{
														$number = $_SESSION["number"];
														if($number==$numofpages)
														{?>
															<li class="active number"><a><?=$number?></a></li><?php
														}
														else
														{
															if($number%2==0)
															{?>
																<li class="number"><a><?=$number-1?></a></li>
																<li class="active number"><a><?=$number?></a></li><?php
															}
															else
															{
																?>
																<li class="active number"><a><?=$number?></a></li>
																<li class="number"><a><?=$number+1?></a></li><?php
															}
														}
													}
													else
													{?>
														<li class="active number"><a>1</a></li>
														<li class="number"><a>2</a></li><?php
													}
												}
												else
												{
													if(isset($_SESSION["number"]))
													{
														$number = $_SESSION["number"];
														if($number%2==0)
														{?>
															<li class="number"><a><?=$number-1?></a></li>
															<li class="active number"><a><?=$number?></a></li><?php
														}
														else
														{
															?>
															<li class="active number"><a><?=$number?></a></li>
															<li class="number"><a><?=$number+1?></a></li><?php
														}
													}
													else
													{?>
														<li class="active number"><a>1</a></li>
														<li class="number"><a>2</a></li><?php
													}
												}?>
												<li><a id="arrow"><i class="fas fa-chevron-right"></i></a></li><?php
																								
											}
										?>
									</ul>
								</div>
							</div>
						</article>
					</div>
					<div class="col-12 col-lg-3 order-lg-1">
						<!-- sidebar -->
						<aside id="sidebar">
							<!-- widget -->
							<section class="widget overflow-hidden mb-9">
								<form action="javascript:void(0);" class="searchForm position-relative border">
									<fieldset>
										<input id="searching" type="search" class="form-control" placeholder="Search product..."/>
										<button class="b_search position-absolute"><i class="icon-search"></i></button>
									</fieldset>
								</form>
							</section>
							<!-- widget -->
							<section class="widget overflow-hidden mb-9">
								<h3 class="headingVII fwEbold text-uppercase mb-5">PRODUCT CATEGORIES</h3>
								<ul class="list-unstyled categoryList mb-0">
									<?php 
									  if($_SESSION["category"] == "Clothes for men") {
									?>
									<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Clothes for men</span></a></li>
									  <?php } 
									  else {?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Clothes for men</span></a></li>
									<?php } ?>
									<?php 
									  if($_SESSION["category"] == "Clothes for women") {
									?>
									<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Clothes for women</span></a></li>
									  <?php } 
									  else {?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Clothes for women</span></a></li>
									<?php } ?>
									<?php 
									  if($_SESSION["category"] == "Automobiles and Motorcycles") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Automobiles and Motorcycles</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Automobiles and Motorcycles</span></a></li>
									<?php } ?>
									<?php 
									  if($_SESSION["category"] == "Beauty and Health") {
									?>
									<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Beauty and Health</span></a></li>
									  <?php } 
									  else {?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Beauty and Health</span></a></li>
									<?php } ?>
									<?php 
									  if($_SESSION["category"] == "Smartphones and Computers") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Smartphones and Computers</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Smartphones and Computers</span></a></li>
									<?php } ?>
									<?php
									if($_SESSION["category"] == "Furniture") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Furniture</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Furniture</span></a></li>
									<?php } ?>
									<?php
									if($_SESSION["category"] == "Jewerly and Accessories") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Jewerly and Accessories</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Jewerly and Accessories</span></a></li>
									<?php } ?>
									<?php
									if($_SESSION["category"] == "Sports and entertainment") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Sports and entertainment</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Sports and entertainment</span></a></li>
									<?php } ?>

									<?php
									if($_SESSION["category"] == "Books") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Books</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Books</span></a></li>
									<?php } ?>
									<?php
									if($_SESSION["category"] == "Home utilities and decoration") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Home utilities and decoration</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Home utilities and decoration</span></a></li>
									<?php } ?>
									<?php
									if($_SESSION["category"] == "Uncategorized") {
									?>
												<li class="mb-5 overflow-hidden"><a class="category"><span class="forcolor">Uncategorized</span></a></li>
									  <?php } 
									  else{ ?>
									<li class="mb-5 overflow-hidden"><a class="category"><span>Uncategorized</span></a></li>
									  <?php } ?>

								</ul>
							</section>
						</br>
					</br>
							<!-- widget -->
							<section class="widget mb-9">
								<h3 class="headingVII fwEbold text-uppercase mb-6">Filter by price</h3>
								<!-- filter ranger form -->
						<form action="javascript:void(0);">
									<!--<div id="slider-range"></div>
									<input type="hidden" id="amount1" name="amount1">
									<input type="hidden" id="amount2" name="amount2">-->
								<p style="color:gray">Filter your price</p>
                     	 <select style="border-width: 1.5px;color:black; background-color:lightgray; width:250px; height:40px; margin-right:auto; margin-left:-10px;margin-bottom:10px;" id="gov" class="form-control" id="exampleInputGov">
						  <?php 
						  if((!isset($_SESSION["filter1"])) || ($_SESSION["filter1"] == 2)) {
						  ?>
                        	<option selected="true" disabled="disabled">Choose one option</option>
                        	<option>0 to 20</option>
                        	<option>20 to 50</option>
                        	<option>50 to 100</option>
                        	<option>150 to 200</option>
                        	<option>>200</option>
						  <?php } 
						  else if($_SESSION["filter1"] == 0) { ?>
						    <option>Back to default</option>
						    <option selected="true" disabled="disabled">0 to 20</option>
                        	<option>20 to 50</option>
                        	<option>50 to 100</option>
                        	<option>150 to 200</option>
                        	<option>>200</option>
						 <?php }
						 else if($_SESSION["filter1"] == 20) { ?>
						    <option>Back to default</option>
						    <option>0 to 20</option>
                        	<option selected="true" disabled="disabled">20 to 50</option>
                        	<option>50 to 100</option>
                        	<option>150 to 200</option>
                        	<option>>200</option>
						 <?php }
						else if($_SESSION["filter1"] == 50) { ?>
						   <option>Back to default</option>
						    <option>0 to 20</option>
						    <option>20 to 50</option>
						    <option selected="true" disabled="disabled">50 to 100</option>
							<option>150 to 200</option>
							<option>>200</option>
						 <?php }
						else if($_SESSION["filter1"] == 150) { ?>
						    <option>Back to default</option>
							<option>0 to 20</option>
							<option>20 to 50</option>
							<option>50 to 100</option>
							<option selected="true" disabled="disabled">150 to 200</option>
							<option>>200</option>
						<?php }
						else if($_SESSION["filter1"] == 200) { ?>
						   <option>Back to default</option>
							<option>0 to 20</option>
							<option>20 to 50</option>
							<option>50 to 100</option>
							<option>150 to 200</option>
							<option selected="true" disabled="disabled">>200</option>
						<?php } ?>
						  
                      	</select>
                      <button id="price" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4" style="display: inline-block; width:150px; margin-left:30px; margin-top:20px;">Filter</button>                    
								</form>
							</section>
						</br>
					</br>
						</aside>
					</div>
				</div>
			</div>
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
			<div class="container-fluid px-xl-20 px-lg-14">
				<!-- subscribeSecBlock -->
				<section class="subscribeSecBlock bgCover col-12 pt-xl-24 pb-xl-12 pt-lg-20 pt-md-16 pt-10 pb-md-8 pb-5">
					<header class="col-12 mainHeader mb-sm-9 mb-6 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Subscribe</h1>
						<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
						<p class="mb-sm-6 mb-3">Subsribe to join our mailing list and keep yourself updated</p>
					</header>
					<div style="text-align:center">
					<div class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
						<button id="subscribe" style="margin-right: auto; margin-left:auto" type="submit" class="btn btnTheme btnShop fwEbold text-white py-3 px-4">Subscribe <i class="fas fa-arrow-right ml-2"></i></button>
				</div>
					</div>
				</section>
			</div> <?php } }?>
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