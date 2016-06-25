<!DOCTYPE html>

<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->

<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->

<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->

	<head>



		

		<meta charset="utf-8"/>

		<title>Smart Attendance</title>

		

		

		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="stylesheet" href="../css/bootstrap.css"/>

		<link rel="stylesheet" href="../css/fonts/font-awesome/css/font-awesome.css"/>

	

		<!-- Theme CSS -->

		<link rel="stylesheet" href="../css/theme.css"/>

		<link rel="stylesheet" href="../css/theme-elements.css"/>



		<!-- Custom CSS -->

		<link rel="stylesheet" href="../css/custom.css"/>



		<!-- Skin -->

		<link rel="stylesheet" href="../css/skins/blue.css"/>

		

		<!-- Responsive CSS -->

		<link rel="stylesheet" href="../css/bootstrap-responsive.css" />

		<link rel="stylesheet" href="../css/theme-responsive.css" />



		<script src="../vendor/modernizr.js"></script>

    <script type="text/javascript">

            function validate_form()

            {

                var username = document.getElementById("username").value;
                var usertype = document.getElementById("usertype").value;

                var password = document.getElementById("password").value;

                
                if(usertype=='')

                {

                    alert("Please Select User Type.");

                    return false;

                    

                }
                else if(username=='')

                {

                    alert("Please Enter User Name.");

                    return false;

                    

                }

                else if(password=='')

                {

                    alert("Please Enter Password.");

                    return false;

                    

                }

            }

         </script>

	   



	</head>

    <?php

        error_reporting(0);

    ?>

    

	<body>

        

		<div class="body">

			<style>footer{background:none;border-top:none medium;margin-top:0px;padding:0px;}</style>

            <header>

            	<div class="container">

            		<h1 class="logo">

            			<a href="index.php">

            				<img alt="" src="../img/logo.png">

            			</a>

            		</h1>

            		

            		<nav>

            			<ul class="nav nav-pills nav-top">

            				<li>

            				

            				</li>

            			</ul>

            		</nav>

            		<div class="social-icons">

            			

            		</div>

            		<nav>

            			<ul class="nav nav-pills nav-main" id="mainMenu">

            				<li class="active">

            				

            				</li>

            				

            			</ul>

            		</nav>

            	</div>

            </header>

			<div role="main" class="main">



				<section class="page-top">

					<div class="container">

						<div class="row">

							<div class="span12">

								<ul class="breadcrumb">

									<li><a href="index.php">Home</a> <span class="divider">/</span></li>

									<li class="active">Login</li>

								</ul>

							</div>

						</div>

						<div class="row">

							<div class="span12">

								<h2>Login</h2>

							</div>

						</div>

					</div>

				</section>



				<div class="container">



					<div class="row">

						<div class="span6">

                        

							<h2 class="short"><strong>Login</strong> </h2>

                            

                           <?php

                                if($_GET['error'])

                                {

                                    ?>

                                    <div class="alert alert-error">

								    <button data-dismiss="alert" class="close" type="button">&times;</button>

								    Invalid Login Details. 

							         </div>        

                                    <?php

                                }

                           

                           ?> 

                            
 
                            

							<form method="post" id="" action="checklogin.php" novalidate="novalidate" onSubmit="return validate_form();">

                                

                                <div class="row controls">
                                
                                    <div class="span3 control-group">

										<label>User Type *</label>

										<select name="usertype" id="usertype" style="width: 100%;">
                                            <option value="">Select User Type</option>
                                            <option value="Admin">Admin</option>
										    <option value="HOD">HOD</option>
										 </select>	

									</div>


									<div class="span3 control-group" style="clear: both;">

										<label>User Name *</label>

										<input type="text" id="username" name="username" class="span3" maxlength="100" value=""/>

									</div>

									<div class="span3 control-group" style="clear: both;">

										<label>Password *</label>

										<input type="password" id="password" name="password" class="span3" maxlength="100" value=""/>

									</div>

								</div>

                                

								<div class="btn-toolbar">

									<input type="submit" class="btn btn-primary btn-large" value="Login"/>

								</div>

							</form>

						</div>

						

					</div>



					<hr class="tall"/>



				</div>



			</div>

            

			<?php

            require_once "footer.php";

            ?>

		</div>



		

        <script src="../vendor/jquery.js"></script>

		<script src="../vendor/jquery.easing.js"></script>

		

		

		<script src="../vendor/bootstrap.js"></script>

		<script src="../vendor/selectnav.js"></script>

	

		<script src="../vendor/fancybox/jquery.fancybox.js"></script>

		<script src="../vendor/jquery.validate.js"></script>



		<script src="../js/plugins.js"></script>

		<script src="../js/custom.js"></script>



	</body>

</html>