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
        
        

	   

	</head>
    <?php
        error_reporting(0);
        session_start();
        
        require_once "adminhelper.php";
        $helper = new AdminHelper();
        
        $msg        = "";
        $id         = $_GET['id'];
        $task       = $_GET['task'];
        
        if($task=='status')
        {
            $msg=$helper->updateStaffStatus($id);
        }
        
        if($task=='remove')
        {
            $msg=$helper->removeNotice($id);
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
									<li class="active">Notice List</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="span12">
								<h2>Notice List</h2>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="span12">
                            
                            <?php
                            $helper->getNoticeList();
                            ?>
							
							
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