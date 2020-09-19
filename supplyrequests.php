<?php session_start();
 if(isset($_SESSION["seller"]))
 {
	 header('location:seller.php');
 }
 else if(isset($_SESSION["customer"]))
 {
	 header('location:home.php');
 }
 else
 {
	 if((!isset($_SESSION["admin"]))&&(!isset($_SESSION["businessowner"]))&&(!isset($_SESSION["employee"])))
	 {
		 header('location:home.php');
	 }
 }
?>
<!doctype html>
<html lang="en">
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
        $(document).ready(function($)
      {
        $(".loader").hide();
          var email;
         $(".approve").click(function()
            {
                email= $(this).parent().parent().children().eq(2).children().eq(0).html();
                $("#flag").html("approved");
                $(".modal-body1").html("Are you sure you want to approve the request of "+$(this).parent().parent().children().eq(1).children().eq(0).html()+"?");
				$("#modalbutton1").click();
          });

          $("#confirm1").click(function(){
            $("#no").click();
            $("table").hide();
            $(".loader").show();
            if($("#flag").html()=="approved")
            {
                $.ajax({ url: 'approve_supply_request.php',
                    type: 'POST',
                    data:{
                          "email": email,
                    },
                    dataType: 'text',
                          success: function(txt) {
                                    $(".loader").hide();
                                    $("#flag").html("");
                                    $(".modal-body1").html(txt);
                                    $(".tohide").hide();
                                    $(".modal-title").html("Result");
                                    $("#modalbutton1").click();
                          },
                    
                      });
            }
            else if($("#flag").html()=="disapproved")
            {
                $.ajax({ url: 'disapprove_supply_request.php',
                    type: 'POST',
                    data:{
                          "email": email,
                    },
                    dataType: 'text',
                          success: function(txt) {
                                    $(".loader").hide();
                                    $("#flag").html("");
                                    $(".modal-body1").html(txt);
                                    $(".tohide").hide();
                                    $(".modal-title").html("Result");
                                    $("#modalbutton1").click();
                          },
                    
                      });
            }


		  });

          $(".disapprove").click(function()
            {
                email= $(this).parent().parent().children().eq(2).children().eq(0).html();
                $("#flag").html("disapproved");
                $(".modal-body1").html("Are you sure you want to disapprove "+$(this).parent().parent().children().eq(1).children().eq(0).html()+"?");
				$("#modalbutton1").click();
          });

          $("#x").click(function(){
            window.location.reload(); 
          });

      });

    </script>
    <style>
    .loader {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #080808;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      float: center;
      margin-left: calc(50% - 30px);
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
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
										<li class="nav-item dropdown">
                                                <?php 

                                                if(isset($_SESSION["admin"]))
                                                {?>
                                                    <a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="admin.html">home</a> <?php

                                                }
                                                else if(isset($_SESSION["businessowner"]))
                                                {?>
                                                    <a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="businessowner.html">home</a><?php

                                                } 
                                                ?> 
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
	<main>
            <!-- Modal1 -->
		<button id="modalbutton1" style="visibility:hidden" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Launch demo modal</button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <a id="x" class=" fas fa-times float-right"></a>                    
                </div>
                <div class="modal-body1">
                </div>
                <div class="modal-footer">
					<button type="button" class=" tohide btn btn-secondary" data-dismiss="modal" id="no">No</button>
					<button type="button" class="tohide btn" id="confirm1">Yes</button>
                </div>
                </div>
            </div>
            </div>
        <!-- Modal1 --> 

    <!-- this is used for approve and disapprove in script -->
    <p id="flag" style="visibility:hidden"></p>

	<header class="col-12 mainHeader mb-7 text-center">
        <h2 class="headingIV playfair fwEblod mb-4">Supply Requests</h2> 
		<span class="headerBorder d-block mb-md-5 mb-3"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
            <div style="text-align:center"><div style="inline-block" class="loader"></div></div>
    
    <div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
			<div class="row">
	        <div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
                <table id="myTable" class="table ">
                <thead>
                <tr>
                        <th><strong>Request </strong></td>
                        <th><strong>Name</strong></td>
                        <th><strong>Email</strong></td>
                        <th><strong>Phone Number</strong></td>
                        <th><strong></strong></td><!-- approve -->
                        <th><strong></strong></td><!-- disapprove -->
                </tr>
                </thead>
                <tbody>
                <?php
                error_reporting(E_ERROR | E_PARSE);
                header('Content-Type:text/plain');

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

                $sql = "SELECT requestid, firstname, lastname, email, phonenumber, status FROM supply_request";
                if($results = $mysqli -> query($sql))
                {
                    while($row = $results -> fetch_row())
                    {
                        ?>
                        <tr class="align-items-center">
                            <td><strong><?=$row[0]?></strong></td>
                            <td><strong><?=$row[1]?> <?=$row[2]?></strong></td>
                            <td><strong><?=$row[3]?></strong></td>
                            <td><strong><?=$row[4]?></strong></td>
                            <td><strong><?=$row[5]?></strong></td>
                            <td><button class="approve">Approve</button></td>
                            <td><button class="disapprove">Disapprove</button></td>
                        </tr>
                        <?php
                        }
                    }

                    ?>
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