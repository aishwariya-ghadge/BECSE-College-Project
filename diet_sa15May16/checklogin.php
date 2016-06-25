<?php



    error_reporting(0);

    session_start();

    $msg='';

    require_once "sahelper.php";

    

    $helper = new SaHelper();

    if($_POST)

    {

        $r=$helper->checkLogin();

        if($r)

        {

            

            $_SESSION['fuserid']  = $r->id;

            $_SESSION['fusername']= $r->username;

            
            echo "<script type='text/javascript'>window.location='aboutus.php';</script>";

        }

        else

        {

            $_SESSION['fuserid']='';

            $_SESSION['fusername']='';

            
            echo "<script type='text/javascript'>window.location='flogin.php?error=1';</script>";

            

        }

    }

    

?>    



