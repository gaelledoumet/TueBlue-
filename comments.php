<?php session_start();
 if(isset($_SESSION["admin"]))
 {
	 header('location:admin.html');
 }
 else if(isset($_SESSION["businessowner"]))
 {
	 header('location:businessowner.html');
 }
 else if(isset($_SESSION["seller"]))
 {
	 header('location:seller.php');
 }
 else if(isset($_SESSION["customer"]))
 {
	 header('location:home.php');
 }
 else
 {
	 if(!isset($_SESSION["employee"]))
	 {
		 header('location:home.php');
	 }
 }
?>
<!doctype html>
<html lang="en">
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
			var id;
			$(".remove_comment").click(function(){
				 id=$(this).parent().children().eq(4).children().eq(0).html();
				$(".modal-body").html("Are you sure you want to remove comment "+ id +"?");
				$("#modalbutton").click();
			});

			$("#confirm").click(function(){
				$.ajax({ url: 'removecomment.php',
                    type: 'POST',
                    data:{
							"id":id
                    },
                    dataType: 'text',
                          success: function(txt) {
							window.location.reload();							
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
								<a href="employee.html"><img src="images/logo.jpeg" alt="TueBlue" class="img-fluid"></a>
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
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="employee.html">home</a>
											</li>
											<li class="nav-item dropdown">
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="logout.php">log out</a>
											</li>
										</ul>
									</div>
								</nav>
							</div>
                        </div>
					</div>
				</div>
      </header>
	  <main style="background-image: url(images/blackwallpaper.jpg);">
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

      <section class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-80 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7">
            
        <header class="col-12 mainHeader mb-7 text-center">
                    <h2 style="color:lightgrey" class="headingIV playfair fwEblod mb-4">Comments</h2> 
					<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
					
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
				 
					$results = mysqli_query($mysqli, "SELECT comments.comment,comments.username,comments.date, comments.commentid FROM comments ORDER BY comments.date DESC");
					$i=0;
					while($row = mysqli_fetch_row($results))
					{
					?><div class="row"><?php
					if($i%2==0){
					?>
					
						<div class="wow slideInLeft col-12 pl-xl-23 mb-lg-6 mb-10">
							<div class="stepCol position-relative bg-lightGray py-6 px-6">
								<a class=" remove_comment fas fa-times float-right"></a>
								<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3"> <?=$row[2]?></strong>
								<h2 class="headingV fwEblod mb-3">@<?=$row[1]?></h2>
								<p class="mb-5"><?=$row[0]?> </p>
								<p>Comment ID: <span> <?=$row[3]?></span></p>
							</div>
						</div>
						<br>
						<?php } else{ ?>
						<div class="wow slideInRight col-12 pr-xl-23 mb-lg-6 mb-10">
							<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
								<a class=" remove_comment fas fa-times float-right"></a>
								<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3"> <?=$row[2]?></strong>
								<h2 class="headingV fwEblod mb-3">@<?=$row[1]?></h2>
								<p class="mb-5"><?=$row[0]?></p>
								<p>Comment ID: <span><?=$row[3]?></span></p>
							</div>
						</div>
						<br>
					<?php } $i++;
				?></div> <?php
				} ?>

        </header>
		</section>
		</main>

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

	

      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>