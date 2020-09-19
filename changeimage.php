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

		<!-- this is to link the javascript page -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="changeprice.js?newversion"></script>

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
		$("#upload").click(function()
		{
			var fd = new FormData();
			var files = $('#file')[0].files[0];
			fd.append('file',files);
			$.ajax({
                        url: 'updateimage.php?pcode='+$(this).parent().children().eq(3).html(),
                        type: "POST",
                        data: fd,
						contentType: false,
						processData:false,
    
                        success: function(data){
								$(".modal-body").html(data);
								$("#modalbutton").click();
								if(data== "Image updated successfully")
								{
									setTimeout(function(){window.location.href="seller.php";}, 2000);
								}
                            },
                     });
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
										<li class="nav-item dropdown ">
											<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="seller.php" style="word-spacing:8px;">Home</a>
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
		
	<div class="twoColumns container pt-xl-23 pb-xl-20 pt-lg-20 pb-lg-20 py-md-16 py-10">
				<!-- backend part -->
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
					$store = $_GET["pcode"];
					$store = (int)$store;
					$results = mysqli_query($mysqli, "SELECT image_url, pname, newprice, category, quantity, description FROM products WHERE pcode={$store}");
	
					$row = mysqli_fetch_row($results);
							?>
                    <div class="row mb-6">
					<div class="col-12 col-lg-6 order-lg-1">
						<!-- productSliderImage -->
						<div class="productSliderImage mb-lg-0 mb-4">
							<div>
								<img src="<?=$row[0]?>" alt="image description" class="img-fluid w-100">
							</div>
						</div>
					</div>
					<div style="margin-top:150px" class="col-12 col-lg-6 order-lg-3">
						<!-- productTextHolder -->
						<div class="productTextHolder overflow-hidden">
							<h2 class="fwEbold mb-2"><?=$row[1]?></h2>
							<ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
								<li class="mb-2">Product Code: <span><?=$_GET["pcode"]?></span></li>
							</ul>
                            <section class="container-fluid bg">
				    <div class="form-group step2">
                      		<div><label for="exampleInputEmail1"style="color:white">Upload the product's image</label></div>
								<input type="file" id="file" name="files">
                                <button id="upload">Upload</button>
                                <p style="visibility:hidden"><?=$store?></p>
                    	</div>
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