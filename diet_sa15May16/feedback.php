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
		<link rel="stylesheet" href="vendor/flexslider/flexslider.css" media="screen" />
		<link rel="stylesheet" href="vendor/fancybox/jquery.fancybox.css" media="screen" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css"/>
		<link rel="stylesheet" href="css/theme-elements.css"/>

		<!-- Current Page Styles -->
		<link rel="stylesheet" href="vendor/revolution-slider/css/settings.css" media="screen" />
		<link rel="stylesheet" href="vendor/revolution-slider/css/captions.css" media="screen" />
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen" />

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
                var email         = document.getElementById("email").value;
                var mobile           = document.getElementById("mobile").value;
                var subject           = document.getElementById("subject").value;
                var message          = document.getElementById("message").value;
               
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
                    
                }  else if(subject=='')
                {
                    alert("Please enter text.");
                    return false;
                }
             
               
                else if(message=='')
                {
                    alert("Please enter text.");
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
	require_once "sahelper.php";
	$helper = new SaHelper();
	 error_reporting(0);
        $error=$_GET['error'];
        require_once "sahelper.php";
        $helper = new SaHelper();
        $msg = '';
        
	
        
	if($_POST)
        {
            $msg = $helper->feedback();
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
									<li><a href="index.php">Home</a> <span class="divider">/</span></li>
									<li class="active">Feedback</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="span12">
								<h2>Feedback</h2>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="span12">
                            
			
				

					
							
							  <?php
							if($msg!='')
							{
								?>
									<div class="alert alert-error">
								    <button data-dismiss="alert" class="close" type="button">&times;</button>
								    <?php  echo $msg;?> 
							 </div>
								
								<?php
							}
						?>    		
                        
                                <form method="post" name="feedback" action="#" onSubmit="return validate_form();">

                            
                                    <label for="author"><h4>Name</h4></label>
                                        <input name="name" type="text" class="required input_field" id="name" maxlength="40"/>
                                    <div class="cleaner h10"></div> 
                            
                                    <label for="email"><h4>Email</h4></label> 
                                        <input name="email" type="text" class="validate-email required input_field" id="email" maxlength="40" /> 
                                    <div class="cleaner h10"></div> 
                                    
                                    <label for="mobile"><h4>Mobile No</h4></label> 
                                        <input name="mobile" type="text" class="validate-subject required input_field" id="mobile" maxlength="10"/> 
                                    <div class="cleaner h10"></div> 
                                    
                                    <label for="subject"><h4>Subject</h4></label> 
                                        <input name="subject" type="text" class="validate-subject required input_field" id="subject" maxlength="80"/> 
                                    <div class="cleaner h10"></div> 
                                    
                                    <label for="text"><h4>Message</h4></label> 
                                        <textarea id="message" name="message" rows="0" cols="0" ></textarea> 
                                    <div class="cleaner h10"></div>                
                                    
                                    
                                    <div class="btn-toolbar">
                                        <input name="submit" type="submit" class="btn btn-primary btn-large" value="Send"/>
                                        <input type="submit" class="btn btn-primary btn-large" value="Reset"/>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>

					</div>
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
		<script src="vendor/twitterjs/twitter.js"></script>
		<script src="vendor/revolution-slider/js/jquery.themepunch.plugins.js"></script>
		<script src="vendor/revolution-slider/js/jquery.themepunch.revolution.js"></script>
		<script src="vendor/flexslider/jquery.flexslider.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="vendor/fancybox/jquery.fancybox.js"></script>
		<script src="vendor/jquery.validate.js"></script>

		<script src="js/plugins.js"></script>
		<script src="js/views/view.home.js"></script>
		<script src="js/theme.js"></script>
		<script src="js/custom.js"></script>

	</body>
</html>