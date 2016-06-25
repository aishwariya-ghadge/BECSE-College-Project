<?php
    
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    
    ob_clean();

    require_once "androidhelper.php";
    
    $task = $_REQUEST['task'];
    $helper = new AndroidHelper();
    
    if($task == "checklogin")
    {
        echo $helper->checkLogin();
    }
    else if($task == "register")
    {
        echo $helper->register();
    }
    else if($task == 'makeattendance')
    {
        echo $helper->makeattendance($_REQUEST);
    }
    else if($task == 'attend_info')
    {
       echo $helper->attend_info();
    }
    else if($task == 'updateOuttime')
    {
       echo $helper->updateOuttime();
    }
    else if($task == 'getNotices')
    {
       echo $helper->getNotices();
    }
    else if($task == 'getprofile')
    {
       echo $helper->getprofile();
    }
    else if($task == 'editprofile')
    {
       echo $helper->editprofile();
    }
    else if($task == 'updateLocation')
    {
       echo $helper->updateLocation();
    }
    else if($task == 'saveReason')
    {
       echo $helper->saveReason();
    }
    else if($task == 'getWeekAttendance')
    {
       echo $helper->getWeekAttendance();
    }
    

?>