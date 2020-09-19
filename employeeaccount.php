<?php session_start(); 
     if(isset($_SESSION["admin"]))
    {
		header("location:admin.html");
    }
    else if(isset($_SESSION["seller"]))
    {
		header("location:seller.php");
    }
    else if(isset($_SESSION["businessowner"]))
    {
		header("location:businessowner.html");
	} 
    else
    {
        if(!isset($_SESSION["employee"]))
        {
            header("location:home.php");
        }
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

	<!-- this is to link the javascript page -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script>
	$(document).ready(function($){

        $("#changenumber").hide();
        $("#currentpassword").hide();
        $("#changepassword").hide();
        $("#changeAddress").hide();

        $("#change_password").click(function(){
            $("#changenumber").hide();
            $("#changepassword").hide();
            $("#changeAddress").hide();
            $("#currentpassword").show();
        });
        $("#change_number").click(function(){
            $("#changenumber").show();
            $("#changepassword").hide();
            $("#changeAddress").hide();
            $("#currentpassword").hide();
        });
        $("#change_gov").click(function(){
            $("#changenumber").hide();
            $("#currentpassword").hide();
            $("#changepassword").hide();
            $("#changeAddress").hide();
        });
        $("#change_address").click(function(){
            $("#changenumber").hide();
            $("#currentpassword").hide();
            $("#changepassword").hide();
            $("#changeAddress").show();
        });

        $(function () {
            $("#pass10").bind("keyup", function () {
                //TextBox left blank.
                if ($(this).val().length == 0) {
                    $("#password_strength").html("");
                    return;
                }

                //Regular Expressions.
                var regex = new Array();
                regex.push("[A-Z]"); //Uppercase Alphabet.
                regex.push("[a-z]"); //Lowercase Alphabet.
                regex.push("[0-9]"); //Digit.
                regex.push("[$@$!%*#?&]"); //Special Character.

                var passed = 0;

                //Validate for each Regular Expression.
                for (var i = 0; i < regex.length; i++) {
                    if (new RegExp(regex[i]).test($(this).val())) {
                        passed++;
                    }
                }


                //Validate for length of Password.
                if (passed > 2 && $(this).val().length > 8) {
                    passed++;
                }

                //Display status.
                var color = "";
                var strength = "";
                switch (passed) {
                    case 0:
                    case 1:
                        strength = "Weak";
                        color = "red";
                        break;
                    case 2:
                        strength = "Good";
                        color = "darkorange";
                        break;
                    case 3:
                    case 4:
                        strength = "Strong";
                        color = "green";
                        break;
                    case 5:
                        strength = "Very Strong";
                        color = "darkgreen";
                        break;
                }
                $("#password_strength").html(strength);
                $("#password_strength").css("color", color);
            });
    });
        $("#bt_pass").click(function(){
            var flag = "employee";
            $.ajax({
                    url: 'checkpassword.php',
                    type: "POST",
                    datatype: "text",
                    data: {  "password":$(this).parent().children().eq(1).val(),
                            "flag":flag,
                    },
                    success: function(data){
                                if(data=="wrong password")
                                {
                                    $(".modal-body").html('Wrong password');
							        $("#modalbutton").click();                                }
                                else if(data=="empty")
                                {
                                    $(".modal-body").html("Please enter your current password.");
							        $("#modalbutton").click();                                }
                                else
                                {
                                    $("#currentpassword").hide();
                                    $("#changepassword").show();
                                }                               
                        },
                 });
        });
        
        $("#bt_confirm").click(function(){
            var flag = "employee";
            $.ajax({
                    url: 'confirmpassword.php',
                    type: "POST",
                    datatype: "text",
                    data: {  "password":$(this).parent().children().eq(1).val(),
                            "confirm":$(this).parent().children().eq(4).val(),
                            "flag":flag,
                    },
                    success: function(data){
                                if(data=="Passwords do not match")
                                {
                                    $(".modal-body").html('Passwords do not match.');
                                    $("#modalbutton").click();
                                }
                                else if(data=="empty")
                                {
                                    $(".modal-body").html('Please fill out all of the requirements');
							        $("#modalbutton").click();                                }
                                else
                                {
                                    $("#changepassword").hide();
                                    $(".modal-body").html('Password changed successfully.');
                                    $("#modalbutton").click();
                                }                               
                        },
                 });
        });

        $("#bt_number").click(function(){
            var flag="employee";
            $.ajax({
                    url: 'changenumber.php',
                    type: "POST",
                    datatype: "text",
                    data: {  "number":$(this).parent().children().eq(1).val(),
                            "flag":flag,
                    },
                    success: function(data){
                                    if(data=="empty")
                                    {
                                        $(".modal-body").html("Please fill out all requirements.");
                                        $("#modalbutton").click();
                                   }
                                    else if(data=="wrong format")
                                    {
                                        $(".modal-body").html("Wrong phone number format");
                                        $("#modalbutton").click();
                                    }
                                    else if(data == "this phone number already exists")
                                    {
                                        $(".modal-body").html("This phone number already exists.");
							            $("#modalbutton").click();
                                    }
                                    else
                                    {
                                        $(".modal-body").html("Phone number changed succesfully");
                                        $("#modalbutton").click();
                                        setTimeout(function(){window.location.href="employeeaccount.php";}, 2000);                                       
                                    }
                        },
                 });
        });
        $("#bt_address").click(function(){
             var flag="employee";
            $.ajax({
                    url: 'changeaddress.php',
                    type: "POST",
                    datatype: "text",
                    data: {"address":$(this).parent().children().eq(1).val(),
                            "flag":flag,
                    },

                    success: function(data){
                                 if(data=="empty")
                                    {
                                        $(".modal-body").html("Please fill out all requirements.");
							            $("#modalbutton").click();                                    }
                                    else
                                    {
                                        $(".modal-body").html("Governorate changed succesfully");
                                        $("#modalbutton").click();
                                        setTimeout(function(){window.location.href="employeeaccount.php";}, 2000); 
                                    }                              
                        },
                 });
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
		<!-- pageHeader -->
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
											<li class="nav-item dropdown  active">
												<a class="d-block" role="button" aria-haspopup="true" aria-expanded="false" href="employeeaccount.php">My account</a>
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
                $username=$_SESSION["signedin"];
                $sql = "SELECT phonenumber, address, fullname, email FROM employees WHERE username = '{$username}' ";

                if($result = $mysqli -> query($sql))
                {
                    $row = $result -> fetch_row();
                    $result -> free_result();
                }
                $phone_number=$row[0];
                $location=$row[1];
                $name=ucfirst($row[2]);
                $email=$row[3];
            ?>
			<!-- featureSec -->
			<section id="NewArrival" class="featureSec container overflow-hidden pt-xl-12 pb-xl-9 pt-lg-10 pb-lg-4 pt-md-8 pb-md-2 pt-5">
				<div class="row">
					<!-- mainHeader -->
					<header class="col-12 mainHeader mb-4 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Your Account</h1>
						<span class="headerBorder d-block mb-5"><img src="images/hbdr.png" alt="Header Border" class="img-fluid img-bdr"></span>
                        <h2 class="headingIII playfair fwEblod mb-4"><?=$name?></h2>
                        <p class="headingI playfair fwEblod mb-4">Email: <?=$email?></p>
                        <p class="headingI playfair fwEblod mb-4">Phone Number: <?=$phone_number?></p>
                        <p class="headingI playfair fwEblod mb-4">Address: <?=$location?></p>
                    </header>
                    <section class="container-fluid bg">
                        <section class="row justify-content-center">
                            <section class="col-sm-12 col-md-2 mt-5">
                                <div style="text-align:center">
                                </div>  
                            </section>
                            <section class="col-sm-12 col-md-2 mt-5">
                                <div style="text-align:center">
                                <button id="change_password" class="btn btnTheme btnShop fwEbold text-white py-3 px-3">Change <br> Password</button>
                                </div>  
                            </section>
                            <section class="col-sm-12 col-md-2 mt-5">
                                <div style="text-align:center">
                                <button id="change_number" class="btn btnTheme btnShop fwEbold text-white py-3 px-3">Change <br> Phone Number</button>
                                </div>
                            </section>
                            <section class="col-sm-12 col-md-2 mt-5">
                                <div style="text-align:center">
                                <button id="change_address" class="btn btnTheme btnShop fwEbold text-white py-3 px-3">Change <br> Address</button>
                                </div>
                            </section>
                            <section class="col-sm-12 col-md-2 mt-5">
                                <div style="text-align:center">
                                </div>  
                            </section>
                        </section>
                     </section>
                    <br>
                    <div id="changenumber" class="container form-group" style="text-align:center">
                        <p style="color:black">Enter a new Phone-Number:</p>
						<input style="width:250px; border-width: 1.5px; margin-right:auto;margin-left:auto;color:white;margin-bottom:10px" id="phone" type="tel" class="form-control" id="exampleInputNumber" placeholder="78888777" pattern="[0-9]{8}" maxlength="8">	
                        <button id="bt_number" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4;margin-top:100px;height:30px" style="display: inline-block;">Submit</button>                    
                    </div>   
                    <div id="currentpassword" class="container form-group" style="text-align:center">
                        <p style="color:black">Enter your current password:</p>
						<input style="width:250px; border-width: 1.5px; margin-right:auto;margin-left:auto;color:white;margin-bottom:10px" id="current_password" type="password" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"class="form-control" id="exampleInputNumber" placeholder="Password">	
                        <button id="bt_pass" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4" style="display: inline-block;">Submit</button>                    
                    </div> 
                    <div id="changepassword" class="container form-group" style="text-align:center">
                        <p style="color:black">Enter your new password:</p>
						<input style="width:250px; border-width: 1.5px; margin-right:auto;margin-left:auto;color:white;" id="pass10" type="password" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"class="form-control" id="exampleInputNumber" placeholder="Password">	
                        <span id="password_strength"></span>
                        <p style="color:black">Confirm password:</p>
						<input style="width:250px; border-width: 1.5px; margin-right:auto;margin-left:auto;color:white;margin-bottom:10px" id="current_password" type="password" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"class="form-control" id="exampleInputNumber" placeholder="Confirm Password">	
                        <button id="bt_confirm" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4" style="display: inline-block;">Submit</button>                    
                    </div> 
                    <div id="changeAddress" class="container form-group" style="text-align:center">
                    <p style="color:black">Add your new address</p>
                    <input style="color:white; border-width: 1.5px;margin-right:auto; margin-left:auto; width:400px;margin-bottom:10px" maxlength="150" id="address" type="text" class="form-control" id="exampleInputAddress" placeholder="Help us know where you live">
                    <button id="bt_address" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4" style="display: inline-block;">Submit</button>                    
                </div>

				</div>
			</section>

	</section>
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
		<!-- footer -->
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