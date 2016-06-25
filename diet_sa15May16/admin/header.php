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
					<a href="dashboard.php">Home</a>
				</li>
                <?php if($_SESSION['usertype']=='Admin') { ?> 
			    <li class="dropdown">
                    <a href="stafflist.php">View Staff</a>
                    <!--<ul  class="dropdown-menu">
                        <li><a href="#">Teaching</a></li>
                        <li><a href="#">Non-Teaching</a></li>
                    </ul>-->
                </li>
                <li>
					<a href="attendancelist.php" >Attendance</a>
                </li>
                
                <li>
					<a href="officelist.php">Office Duty</a>
                </li>
                <?php }?>
                <li class="dropdown">
					<a href="#">Notice</a>
                    <ul  class="dropdown-menu">
                        <li><a href="addnotice.php">Add Notice</a></li>
                        <li><a href="noticelist.php">View Notice</a></li>
                    </ul>
				</li>
                <?php if($_SESSION['usertype']=='Admin') { ?> 
				<li>
					<a href="tracking.php">Live Tracking</a>
				</li>
				<li>
					<a href="feedbacklist.php">View feedback</a>
				</li>
                <?php }?>
                <li>
					<a href="logout.php">Logout</a>
				</li>
			</ul>
		</nav>
	</div>
</header>