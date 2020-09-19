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

		$(".step2").hide();
		$("#upload").click(function()
		{
			var fd = new FormData();
			var files = $('#file')[0].files[0];
			fd.append('file',files);
			$.ajax({
                        url: 'addimage.php?token='+$("#token").html(),
                        type: "POST",
                        data: fd,
						contentType: false,
						processData:false,
    
                        success: function(data){
							$(".modal-body").html(data);
								$("#modalbutton").click();
								if(data=="Image uploaded succesfully.")
								{
									setTimeout(function(){window.location.href="seller.php"; }, 2000);
									
								}
                            },
                     });
		});

        $("#add_product").click(function(){
					var colors=[];
					$("input[name='colorcheckbox']:checked").each(function()
					{
						colors.push($(this).next().html());
					});
					var sizes=[];
					$("input[name='sizecheckbox']:checked").each(function()
					{
						sizes.push($(this).next().html());
					});

                   $.ajax({
                        url: 'addproduct.php',
                        type: "POST",
                        datatype: "text",
                        data: { 
						"pname":$("#product_name").val(),
                        "price":$("#price").val(),
                        "quantity":$("#quantity").val(),
                        "category":$("#category option:selected").text(),
                        "description":$("#description").val(),
						"color_boolean":$("input[name='colors']:checked").next().html(),
						"size_boolean":$("input[name='size']:checked").next().html(),
						"colors":colors,
						"sizes":sizes,
					},
                        async: false,
    
                        success: function(data){
							if((data=="Quantity can't be 0") || (data=="Please fill out all the requirements to proceed")||(data=="the price should only contain digits") ||(data=="the quantity should be a whole number")||(data=="You have supplied such a product already"))
							{
								$(".modal-body").html(data);
							    $("#modalbutton").click();							}
							else{
								$(".modal-body").html("upload the product's image");
								$("#modalbutton").click();	
								$("#token").html(data);
								$(".step1").hide();
								$(".step2").show();
							}
                            },
                     });
        });

        $("#tohide1").hide();
        $("#tohide2").hide();

        $("#coloryes").click(function()
        {	
			$("#tohide1").show();
		});
		$("#colorno").click(function()
        {
			$("#tohide1").hide();
		});
		
		$("#sizeyes").click(function()
        {
			$("#tohide2").show();
		});
		$("#sizeno").click(function()
        {
			$("#tohide2").hide();
		});

    });
	</script>
</head>
  <body>
    <!-- header -->
	<header id="header" class="position-relative">
				<!-- headerHolder -->
				<div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
					<div class="row">
						<div class="col-6 col-sm-6">
							<!-- mainLogo -->
							<div style="width:50%;" class="logo">
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
										<li class="nav-item dropdown active">
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
	<main style="background-image: url(images/blackwallpaper.jpg);background-size: 1660px 1200px;">
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
		
		<p style="visibility: hidden" id="token"></p>
    	<section class="container-fluid bg">
        	<section class="row justify-content-center">
          		<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
                	<form class="form-container w-100 bc">	
						<div class="form-group step1" style="margin-left: 250px">
						  <label for="exampleInputFirst" style="color:white">Enter the product's name</label>
						  <input maxlength="15" style="width:200px; border-color:forestgreen; border-width: 1.5px; background-color:lightgrey" id="product_name" type="text" class="form-control" id="exampleInputFirst" placeholder="product name">
						</div>
					</form>
				</section>
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
					<form class="form-container w-100 bc">	
						<div class="form-group step1" style="margin-left: 250px">
						  <label for="exampleInputLast"style="color:white">Enter the product's price</label>
						  <input style="width:200px; border-color:forestgreen; border-width: 1.5px; background-color:lightgrey" id="price" type="text" class="form-control" id="exampleInputLast" placeholder="in USD">
						</div>
					</form>
				</section>
			</section>
		</section>

		<section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
                	<form class="form-container w-100 bc">
                    	<div class="form-group step1" style="margin-left: 250px">
                      		<label for="exampleInputUsername" style="color:white">Create the product's quantity</label>
                     		<input style="width:200px; border-color:forestgreen; border-width: 1.5px; background-color:lightgrey" id="quantity" type="text" class="form-control" id="exampleInputUsername" placeholder="5">
						</div>
					</form>
				</section>
				
			<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
                <form class="form-container w-100 bc">
                <div class="form-group step1" style="margin-left: 250px">
                      	<label style="color: white" for="category">Select the category</label>
                      	<select style="border-color:forestgreen; border-width: 1.5px; width:200px; background-color:lightgrey" id="category" class="form-control" id="exampleInputType">
                    	<option selected="true" disabled="disabled">Choose one option</option>
									<option>Clothes for men</option>
									<option>Clothes for women</option>
									<option>Automobiles and Motorcycles</option>
									<option>Beauty and Health</option>
									<option>Smartphones and Computers</option>
									<option>Furniture</option>
									<option>Jewerly and Accessories</option>
									<option>Sports and entertainment</option>
									<option>Books</option>
									<option>Home utilities and decoration</option>
									<option>Uncategorized</option>
                      </select>
				</div>
				</form>
				</section>
			</section>
		</section>
		<section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
				<form class="form-container w-100 bc">
                <div class="form-group step1" style="margin-left: 250px">
                      	<label style="color: white" for="category">Are there different colors?</label> <br>
							<input type="radio" id="coloryes" name="colors">
							<label for="coloryes">Yes</label><br>
							<input type="radio" id="colorno" name="colors">
							<label for="colorno">No</label><br>
				</div>
				</form>
				</section>

				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
				<form class="form-container w-100 bc">
                <div class="form-group step1" style="margin-left: 250px">
                      	<label style="color: white" for="category">Are there different sizes?</label> <br>
						  <input type="radio" id="sizeyes" name="size">
							<label for="sizeyes">Yes</label><br>
							<input type="radio" id="sizeno" name="size">
							<label for="sizeno">No</label><br>
				</div>
				</form>
				</section>
			</section>
		</section>
		<section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
				<form class="form-container w-100 bc">
                <div id="tohide1" class="form-group  step1" style="margin-left: 250px">
                      	<label style="color: white" for="category">Select colors</label><br>
						  <input class="colorchosen" type="checkbox" id="blue" name="colorcheckbox">
							<label for="blue">Blue</label><br>
							<input class="colorchosen" type="checkbox" id="red" name="colorcheckbox">
							<label for="red">Red</label><br>
							<input class="colorchosen" type="checkbox" id="green" name="colorcheckbox">
							<label for="green">Green</label><br>
							<input class="colorchosen" type="checkbox" id="black" name="colorcheckbox">
							<label for="black">Black</label><br>
							<input class="colorchosen" type="checkbox" id="white" name="colorcheckbox">
							<label for="white">White</label><br>
							<input class="colorchosen" type="checkbox" id="gray" name="colorcheckbox">
							<label for="gray">Gray</label><br>
							<input class="colorchosen" type="checkbox" id="yellow" name="colorcheckbox">
							<label for="yellow">Yellow</label><br>
							<input class="colorchosen" type="checkbox" id="orange" name="colorcheckbox">
							<label for="orange">Orange</label><br>
							<input class="colorchosen" type="checkbox" id="pink" name="colorcheckbox">
							<label for="pink">Pink</label><br>
							<input class="colorchosen" type="checkbox" id="purple" name="colorcheckbox">
							<label for="purple">Purple</label><br>
							<input class="colorchosen" type="checkbox" id="burgundy" name="colorcheckbox">
							<label for="burgundy">Burgundy</label><br>
							<input class="colorchosen" type="checkbox" id="beige" name="colorcheckbox">
							<label for="beige">Beige</label><br>
							<input class="colorchosen" type="checkbox" id="brown" name="colorcheckbox">
							<label for="brown">Brown</label><br>
				</div>
				</form>
				</section>

				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
				<form class="form-container w-100 bc">
                <div id="tohide2" class="form-group  step1" style="margin-left: 250px">
                      	<label style="color: white" for="category">Select sizes</label><br>
						  <input class="colorchosen" type="checkbox" name="sizecheckbox">
							<label for="blue">Small</label><br>
							<input class="colorchosen" type="checkbox" name="sizecheckbox">
							<label for="red">Medium</label><br>
							<input class="colorchosen" type="checkbox" name="sizecheckbox">
							<label for="green">Large</label><br>
				</div>
				</form>
				</section>
			</section>
		</section>
		<section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
                	<form class="form-container w-100 bc">
					<div class="form-group step1" style="text-align: center;">
						<div ><label for="exampleInputAddress" style="color:white;">Enter the product's description</label></div>
							<textarea maxlength="70" id="description" class="form-group" style="border-color:forestgreen; border-width: 1.5px; background-color:lightgrey;border-radius: 25px;width:350px"  placeholder="Description"></textarea>
						</div>
					</form>
				</section>	
        	</section>
		  </section>
		  <section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
				<div class="form-group step2" style="text-align: center;">
                      		<div><label for="exampleInputEmail1"style="color:white">Upload the product's image</label></div>
								<input type="file" id="file" name="files">
								<button id="upload">Upload</button>
                    	</div>
					</form>
				</section>	
        	</section>
		  </section>
		  <section class="container-fluid bg">
        	<section class="row justify-content-center">
				<section class="col-sm-12 col-md-6 col-lg-6 mt-5">
                	<form class="form-container w-100 bc">
						<div style="text-align: center;">
							<div class="form-group step1">
                     	 		<button id="add_product" type="button" class="btn btnTheme btnShop fwEbold text-white py-3 px-4" style="display: inline-block;">Add product</button>                    
							</div> 
							</div>
					</form>
				</section>	
        	</section>
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