<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>

		
		<meta charset="utf-8"/>
		<title>Smart Attendance</title>
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/fonts/font-awesome/css/font-awesome.css"/>
	
		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css"/>
		<link rel="stylesheet" href="css/theme-elements.css"/>

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/custom.css"/>

		<!-- Skin -->
		<link rel="stylesheet" href="css/skins/blue.css"/>
		
		<!-- Responsive CSS -->
		<link rel="stylesheet" href="css/bootstrap-responsive.css" />
		<link rel="stylesheet" href="css/theme-responsive.css" />

		<script src="vendor/modernizr.js"></script>
        <script type="text/javascript">
            function validate_form()
            {
                var name            = document.getElementById("name").value;
                var address         = document.getElementById("address").value;
                var mobile          = document.getElementById("mobile").value;
                var email           = document.getElementById("email").value;
                var branch          = document.getElementById("branch").value;
                var degree_diploma  = document.getElementById("degree_diploma").value;
                var teaching_type   = document.getElementById("teaching_type").value;
                var designation     = document.getElementById("designation").value;
                var username        = document.getElementById("username").value;
                var password        = document.getElementById("password").value;
                
                var validchar = /^[A-Z a-z]+$/;
                 if(name=='')
                {
                    alert("Please Enter Full Name.");
                    return false;
                }
                else if(!validchar.test(name))
                {
                    alert("Full Name should not be numeric.");
                    return false;
                }
                else if(address=='')
                {
                    alert("Please Enter Address.");
                    return false;   
                }
                else if(mobile=='')
                {
                    alert("Please Enter Mobile Number.");
                    return false;  
                }
                else if(isNaN(mobile))
                {
                    alert("Mobile Number should be numeric.");
                    return false;  
                }
                else if(checkInternationalPhone(mobile)==false)
                {
                    alert("Please Enter a Valid Mobile Number");
            		return false;
                    
                }
                else if(email=='')
                {
                    alert("Please Enter Email Address.");
                    return false;
                }
                else if(validateEmail(email))
                {
                    alert("Please Enter Valid Email Address.");
                    return false;   
                }
                else if(branch=='')
                {
                    alert("Please Select Branch.");
                    return false;
                }
                else if(degree_diploma=='')
                {
                    alert("Please Select Degree/Diploma.");
                    return false;
                }
                else if(teaching_type=='')
                {
                    alert("Please Select Teaching Type.");
                    return false;
                }
                else if(designation=='')
                {
                    alert("Please Select Designation.");
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
            
            function validateEmail(email)
            {
                var atpos  = email.indexOf("@");   // The indexOf() method returns the position of the first occurrence of a specified value in a string. // Default value of start is 0  
                //alert(atpos);
                var dotpos = email.lastIndexOf(".");  // The lastIndexOf() method returns the position of the last occurrence of a specified value in a string. // Default value of start is 0  
                //alert(dotpos);
                
                if((atpos<1) || (dotpos<(atpos+2)) || (dotpos+2>=email.length))  
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
            // Declaring required variables
            var digits = "0123456789";
            // non-digit characters which are allowed in phone numbers
            var phoneNumberDelimiters = "()- ";
            // characters which are allowed in international phone numbers
            // (a leading + is OK)
            var validWorldPhoneChars = phoneNumberDelimiters + "+";
            // Minimum no of digits in an international phone no.
            var minDigitsInIPhoneNumber = 10;
            
            function isInteger(s)
            {   var i;
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character is number.
                    var c = s.charAt(i);
                    if (((c < "0") || (c > "9"))) return false;
                }
                // All characters are numbers.
                return true;
            }
            
            function trim(s)
            {   var i;
                var returnString = "";
                // Search through string's characters one by one.
                // If character is not a whitespace, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn'''t whitespace.
                    var c = s.charAt(i);
                    if (c != " ") returnString += c;
                }
                return returnString;
            }
            
            function stripCharsInBag(s, bag)
            {   var i;
                var returnString = "";
                // Search through string's characters one by one.
                // If character is not in bag, append to returnString.
                for (i = 0; i < s.length; i++)
                {   
                    // Check that current character isn't whitespace.
                    var c = s.charAt(i);
                    if (bag.indexOf(c) == -1) returnString += c;
                }
                return returnString;
            }
            
            function checkInternationalPhone(strPhone){
                var bracket=3;
                strPhone=trim(strPhone);
                if(strPhone.indexOf("+")>1) return false;
                if(strPhone.indexOf("-")!=-1)bracket=bracket+1;
                if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false;
                var brchr=strPhone.indexOf("(");
                if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false;
                if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false;
                s=stripCharsInBag(strPhone,validWorldPhoneChars);
                return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
            }

         </script>
	   

	</head>
    <?php
        error_reporting(0);
        $error=$_GET['error'];
        require_once "sahelper.php";
        $helper = new SaHelper();
        $msg = '';
        
        if($_POST)
        {
            $msg = $helper->register();
        }
    ?>
    
	<body>
        
		<div class="body">
           <?php
           require_once "header.php";
           ?>
			<div role="main" class="main">

				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="span12">
								<ul class="breadcrumb">
									<li><a href="admin/index.php">Home</a> <span class="divider">/</span></li>
									<li class="active">Registration</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="span12">
								<h2>Registration</h2>
							</div>
						</div>
					</div>
				</section>

			  <div class="container">

					<div class="row">
						<div class="span6">
                        
							<h2 class="short"><strong>Registration</strong> </h2>
                            
							<form method="post" id="" action="#" novalidate="novalidate" enctype="multipart/form-data" onSubmit="return validate_form();">
                                <?php
                                if($msg !='')
                                {
                                    ?>
                                    <div class="alert alert-success">
								        <button data-dismiss="alert" class="close" type="button">&times;</button>
								        <?php echo $msg;?> 
							         </div>        
                                    <?php
                                }
                           
                                ?> 
                                <div class="row controls">
									<div class="span3 control-group">
										<label>Full Name*</label>
										<input type="text" id="name" name="name" class="span3" maxlength="100" value=""/>
									</div>
									<div class="span3 control-group">
										<label>Address*</label>
										<input type="text" id="address" name="address" class="span3" maxlength="100" value=""/>
									</div>
									<div class="span3 control-group">
										<label>Mobile No*</label>
										<input type="text" id="mobile" name="mobile" class="span3" maxlength="10" value=""/>
									</div>
									<div class="span3 control-group">
										<label>Email*</label>
										<input type="text" id="email" name="email" class="span3" maxlength="100" value=""/>
									</div>
									<div class="span3 control-group">
										<label>Branch*</label>
										
										<select name="branch" id="branch">
                                            <option value="">Select Branch</option>
                                            <option value="1">Computer Sci & engg</option>
    										<option value="2">Civil engg</option>
    										<option value="3">Mechanical engg</option>
    										<option value="4">E & TC engg</option>
    										<option value="5">Electrical engg</option>
    									 </select>
									</div>
									<div class="span3 control-group">
										<label>Degree/Diploma*</label>
										<select name="degree_diploma" id="degree_diploma">
                                            <option value="">Select Degree/Diploma</option>
                                            <option value="1">Degree</option>
										      <option value="2">Diploma</option>
										 </select>	
										 </div>
									<div class="span3 control-group">
										<label>Teching/Nonteaching staff*</label>
										<select name="teaching_type" id="teaching_type">
                                            <option value="">Select Type</option>
                                            <option value="1">Teaching</option>
    										<!--<option value="2">Nonteaching</option>-->
										 </select>	
									</div>
									<div class="span3 control-group">
										<label>Designation*</label>
										
										<select name="designation" id="designation">
                                            <option value="">Select Designation</option>
                                            <option value="Principal">Principal</option>
										    <option value="HOD">HOD</option>
										    <option value="Professor">Professor</option>
										 </select>	
									</div>
									
									<!--<div class="span3 control-group">
										<label>Photo</label>
										<input type="file" id="image" name="image" class="span3" maxlength="100" value=""/>
										
									</div>-->
                                    <div class="span3 control-group">
			                             <!--<label>IMEI No*</label>
										<input type="text" id="imei" name="imei" class="span3" maxlength="100" value=""/>-->
									</div>
									<div class="clearfix"></div>
									<div class="span3 control-group" >
										<label>Username*</label>
										<input type="text" id="username" name="username" class="span3" maxlength="100" value=""/>
									</div>
									
									
									
									<div class="span3 control-group">
									<label>Password*</label>
										<input type="password" id="password" name="password" class="span3" maxlength="100" value=""/>
									</div>
									
									
								<div class="span3 control-group btn-toolbar">
									<input type="submit" class="btn btn-primary btn-large" value="Register"/>
                                    <input type="reset" class="btn btn-primary btn-large" value="Clear"/>
								</div>								
									
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

		
        <script src="vendor/jquery.js"></script>
		<script src="vendor/jquery.easing.js"></script>
		
		
		<script src="vendor/bootstrap.js"></script>
		<script src="vendor/selectnav.js"></script>
	
		<script src="vendor/fancybox/jquery.fancybox.js"></script>
		<script src="vendor/jquery.validate.js"></script>

		<script src="js/plugins.js"></script>
		<script src="js/custom.js"></script>

	</body>
</html>