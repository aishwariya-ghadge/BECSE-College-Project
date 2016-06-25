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

		<script src="vendor/modernizr.js"></script></head>
	<body>
        
		<div class="body">
			<?php
            require_once "header.php";
            ?>

			<div role="main" class="main">
				<div id="content" class="content full">

					<div class="slider-container">
						<div class="slider" id="revolutionSlider">
							<ul>
								<li data-transition="fade" data-slotamount="10" data-masterspeed="300">
									<img src="img/slides/slide1.png" data-fullwidthcentering="on" alt=""/>

								</li>
								<li data-transition="fade" data-slotamount="10" data-masterspeed="300">
									<img src="img/slides/slide-2.jpg" data-fullwidthcentering="on" alt=""/>
											 
								</li>
							</ul>
						</div>
					</div>

					<div class="home-intro">
						<div class="container">

							<div class="row">
								<div class="span12" style="text-align: center;">
									<p>
										Android Application For Attendance Tracking System Using GPS</em>
									</p>
                                    
								</div>
								
							</div>

						</div>
					</div>

					<div class="container">

						<div class="row center">
							<div class="span12">
								<h2 class="short">Introduction</h2>
								<p class="featured lead">
									We develop Android application for attendance tracking system using GPS. Over the years the process of manual attendance has been carried out which is time consuming. Automated time and attendance monitoring system provides many benefits to organizations.								</p>
							</div>
						</div>

					</div>

					<div class="home-concept">
						<div class="container">

							<div class="row center">
								<span class="sun"></span>
								<span class="cloud"></span>
								<div class="span2 offset1">
								  <div class="process-image">
                                        <div class="sky">&nbsp;</div>
										<strong>Registration</strong>	</div>
										</div>
								
								<div class="span2">
									<div class="process-image">
										<div class="orange">&nbsp;</div>
										<strong>Attendance Login time</strong>									</div>
								</div>
								<div class="span2">
									<div class="process-image">
										<div class="green">&nbsp;</div>
										<strong>Tracking</strong>									</div>
								</div>
								<div class="span4 offset1">
									<div class="project-image">
										<div id="fcSlideshow" class="fc-slideshow">
											<ul class="fc-slides">
                                                <li><div class="orange">&nbsp;</div></li>
                                                <li><div class="sky">&nbsp;</div></li>
                                                <li><div class="green">&nbsp;</div></li>
											</ul>
										</div>
										<strong class="our-work">Attendance Logout time</strong>									</div>
								</div>
							</div>
                      </div>
                            <div class="container">
                            <div class="row">
							<div class="span8">
								<h2><strong>Modules</strong></h2>
								<div class="row">
									<div class="span4">
										<div class="feature-box">
											<div class="feature-box-icon">
												<i class="icon-star"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="shorter">Android Module</h4>
												<p class="tall">-registration of staff: In that faculty id,name,address,phone no are stored.
                                                                -IMEI updation: IMEI no of mobile,if any faculty change his/her mobile then this facility is used.</p>
											</div>
										</div>
										<div class="feature-box">
											<div class="feature-box-icon">
												<i class="icon-star"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="shorter">Admin Module</h4>
												<p class="tall">verify the staff: Verify whether this faculty is related to our organization or not.
                                                -report: To stored the report of attendance
                                                </p>
											</div>
										</div>
										 <div class="feature-box">
											<div class="feature-box-icon">
												<i class="icon-star"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="shorter">SMS sending module</h4>
												<p class="tall">	
                                                  After verifying the faculty details,  automatic SMS will be generated & send it to the faculty
                                                </p>
											</div>
										</div>
									</div>
								  <div class="span4">
                                       
										<div class="feature-box">
											<div class="feature-box-icon">
												<i class="icon-star"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="shorter">Live tracking Module</h4>
												<p class="tall">	
                                                Faculty keeps GPS ON, they enters in organizational area.Tracking facility provided for the faculty
                                                </p>
                                            </div>
										</div>
										<div class="feature-box">
											<div class="feature-box-icon">
												<i class="icon-star"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="shorter">Location based Time</h4>
												<p class="tall">To save the  latitude, longitude and radius of area within the organization. Faculty has to save the IP (Internet protocol) address of the office Internet.</p>
											</div>
										</div>
								  </div>
								</div>
							</div>
							<div class="span4">
								<h2>and more...</h2>
								<div class="accordion" id="accordion">
                                    <div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="icon-lightbulb"></i> # Goal</a>
										</div>
										<div id="collapseOne" class="accordion-body collapse in">
											<div class="accordion-inner">
												To identify employee location within organization premise using GPS via android smart phone application to keep track and maintain record of regular attendance.
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="icon-bell-alt"></i> # Application</a>
										</div>
										<div id="collapseTwo" class="accordion-body collapse">
											<div class="accordion-inner"><p>This application is useful for any organization such as colleges,banks, companies and many other organizations etc.
											  </p>
											</div>
										</div>
									</div>
								
										
							  </div>
							</div>
							</div>
						</div>

							<hr class="tall" />

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