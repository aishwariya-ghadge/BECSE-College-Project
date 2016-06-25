<?php
    error_reporting(0);

    require_once "adminhelper.php";
    $helper = new AdminHelper();
    
    $mapdata= $helper->mapData();
    $response = array("latitude"=>$mapdata->latitude,"longitude"=>$mapdata->longitude);
    echo json_encode($response);   

?>