<?php
 error_reporting(0);

    session_start();

?>
<header>

	<div class="container">
		<h1 class="logo">
			<a href="index.php">
				<img alt="" src="img/logo.png">
			</a>
		</h1>
		
		<nav>
			<ul class="nav nav-pills nav-top">
				
				<li>
					<a href="#"><i class="icon-angle-right"></i>Contact</a>
				</li>
				<li class="phone">
					<span><i class="icon-phone"></i>8600009009</span>
				</li>
			</ul>
		</nav>
		<div class="social-icons">
			<ul class="social-icons">
				<li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>
				<li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
				<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
			</ul>
		</div>
		<nav>
			<ul class="nav nav-pills nav-main" id="mainMenu">
				<li class="active">
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="aboutus.php">About Us</a>
				</li>
                
                <?php
				if($_SESSION['fuserid']=='')
				{
				?>
                <li class="dropdown">
                    <a href="registration.php">Registration</a>
                    
				</li>
                <li>
					<a href="flogin.php">Faculty Login</a>
				</li>
                
                <?php
			
				}
				
				?>
				

				<li>
					<a href="feedback.php">Feedback</a>
				</li>
				<?php
				if($_SESSION['fuserid']!='')
				{
				?>
				<li>
					<a href="logout.php">Logout</a>
				</li>
				<?php
			
				}
				
				?>
				
				
			</ul>
		</nav>
	</div>
</header>