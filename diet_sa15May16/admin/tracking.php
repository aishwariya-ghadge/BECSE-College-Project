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
        
        $db=new Database();
        $db->open();
        
        $sql="SELECT b.id,b.name FROM `current_location` as a JOIN `staff` as b ON b.id=a.staff_id";
        //echo $sql;die;
		$result=$db->query($sql);
        $userid = $_REQUEST['userid'];
    ?>

    <style>
    .fld_box select{padding: 6px;}
    div#map{position: relative;}
    #map_canvas{min-height: 350px;}
    </style>

   
    

	<body  onLoad="initialize()">

        

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

									<li class="active">Live Tracking</li>

								</ul>

							</div>

						</div>

						<div class="row">

							<div class="span12">

								<h2>Live Tracking</h2>

							</div>

						</div>

					</div>

				</section>



				<div class="container">



					<div class="row">

						<div class="span6">

                        

							<h3 class="short">Live Tracking </h3>

							

						</div>

						

					</div>



					<hr class="tall"/>
                    
                    <div class="">
                		<form method="post" id="adminform">
                            <select id="userid" name="userid">
                                <option value="">Select Staff</option>
                                <?php
                                if($result)
                                {
                                    
                                    while($row = $db->fetcharray($result))
                                    {
                                        $sel = '';
                                        if($row['id'] == $userid) 
                                        {
                                            $sel = 'selected="selected"';
                                        }
                                        ?>
                                        <option value="<?php echo $row['id'];?>" <?php echo $sel;?>><?php echo $row['name'];?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            
                            <input type="hidden" id="txtlatitude" value="<?php echo $mapdata->latitude;?>"/>
                    		<input type="hidden" id="txtlongitude" value="<?php echo $mapdata->longitude;?>"/>
                            <input type="submit" value="Track" class="button btn btn-primary" style="margin-top: -8px;" />
                        </form>
                        <div id="map" style="width:100%; height:100%;min-height:350px;">
                            <div id="map_canvas" style="width:100%; height:100%;min-height:350px;"></div>
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
        
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
         <?php 
         $latitude = '17.648636';
         $longitude = '73.921199';
         if($userid) 
         { 
            $mapdata  = $helper->mapData();
            $latitude = $mapdata->latitude;
            $longitude= $mapdata->longitude;
         }
        ?>
        
    <script type="text/javascript">
            var map;
            var geocoder;
            var centerChangedLast;
            var reverseGeocodedLast;
            var currentReverseGeocodeResponse;

			function AutoRefresh( t ) 
			{
				setTimeout("location.reload(true);", t);
			}

            function initialize() 
			{
				var lat=document.getElementById('txtlatitude').value;	
				var lon=document.getElementById('txtlongitude').value;	

                
				var latlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);			

                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                };

                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                geocoder = new google.maps.Geocoder();

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Hello World!",

                });
            }
    </script>
    <script src="js/libs/jquery.min.js"></script>
    <?php if($userid) { ?> 
    <script>
        jQuery(document).ready(function(){
            var callAjax = function(){
                jQuery.ajax({
                    method:'POST',
                    url:'updatemap.php',
                    cache: false,
                    dataType: "json",
                    data : $("#adminform").serialize(),
                    success:function(response)
                    {
                        var image ="marker.png";
                        var myLatLng = new google.maps.LatLng( response.latitude, response.longitude ),
                        myOptions = {
                        zoom: 16,
                        center: myLatLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        },
                        map = new google.maps.Map( document.getElementById( 'map_canvas' ), myOptions ),
                        marker = new google.maps.Marker( {position: myLatLng, map: map} );
                        
                        map.panTo(new google.maps.LatLng(
                            response.latitude,
                            response.longitude
                        ));
                    
                        marker.setMap( map );
                    }
                });
            }
            setInterval(callAjax,12000);
        });
    </script>
    <?php } ?>


	</body>

</html>