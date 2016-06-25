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
                var title = document.getElementById("title").value;
                var branch = document.getElementById("branch").value;
                var description = document.getElementById("description").value;
                var designation = document.getElementById("designation").value;
                
                if(title=='')
                {
                    alert("Please Enter Title.");
                    return false;
                    
                }
                else if(branch=='')
                {
                    alert("Please Select branch.");
                    return false;
                    
                }
                else if(description=='')
                {
                    alert("Please Enter description.");
                    return false;
                    
                }
                else if(designation=='')
                {
                    alert("Please Select Designation.");
                    return false;
                    
                }
            }
    </script>
	   

	</head>
	<?php
	require_once "../sahelper.php";
	$helper = new SaHelper();
        
	if($_POST)
        {
           
            $msg = $helper->addnotice();
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
									<li class="active">Add Notice</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="span12">
								<h2>Add Notice</h2>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="span6">
							<h2 class="short"><strong>Add Notice</strong> </h2>
                        <?php
							if($msg!='')
							{
								?>
									<div class="alert alert-error">
								    <button data-dismiss="alert" class="close" type="button">�</button>
								    <?php  echo $msg;?> 
							 </div>
								
								<?php
							}
						?>    
							
							<form method="post" id="" action="" novalidate="novalidate" onSubmit="return validate_form();">
							 <div class="row controls">
									<div class="span3 control-group">
										<label>Title</label>
										<input type="text" name="title" id="title" class="span3"/>
                                          
									</div>
								</div>
                            
                                <div class="row controls">
									<div class="span3 control-group">
										<label>Branch</label>
										<select id="branch" name="branch">
                                            <option value="">Select Branch</option>
                                            <option value="1">Computer Sci &amp; engg</option>
    										<option value="2">Civil engg</option>
    										<option value="3">Mechanical engg</option>
    										<option value="4">E &amp; TC engg</option>
    										<option value="5">Electrical engg</option>
    									 </select>
										
									</div>
									<div class="span3 control-group" style="clear: both;">
										<label>Description *</label>
										<textarea name="description" id="description" class="span3"></textarea>
									</div>
								</div>
                                
                                <div class="row controls">
									<div class="span3 control-group">
										<label>Designation</label>
										<select id="designation" name="designation">
                                            <option value="">Select Designation</option>
                                            <!--<option value="Principal">Principal</option>-->
										    <option value="HOD">HOD</option>
										    <option value="Professor">Professor</option>
										 </select>
									</div>
								</div>
                                
								<div class="btn-toolbar">
									<input type="submit" class="btn btn-primary btn-large" value="Send Notice"/>
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