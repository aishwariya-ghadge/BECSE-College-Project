<?php







    error_reporting(0);



    session_start();



    $msg='';



    require_once "adminhelper.php";



    



    $helper = new AdminHelper();


  
    if($_POST)
    {

        $usertype=$_POST['usertype'];

        $r=$helper->checkLogin();

        if($r)
        {

            $_SESSION['usertype'] = $usertype;
            $_SESSION['userid']  = $r->id;
            $_SESSION['username']= $r->username;

            echo "<script type='text/javascript'>window.location='dashboard.php';</script>";
        }



        else



        {


            $_SESSION['usertype'] = '';
            $_SESSION['userid']='';



            $_SESSION['username']='';



            

            echo "<script type='text/javascript'>window.location='index.php?error=1';</script>";



            



        }



    }



    



?>    







