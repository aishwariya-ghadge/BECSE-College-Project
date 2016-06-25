<?php

error_reporting(0);
session_start();
        
require_once "inc/config.php";
require_once "inc/dbhelper.php";

class SaHelper
{
    static function sayHello()
    {
        echo "hiii";
    }
    
    static function register()
    {
        $name           = $_REQUEST['name'];
        $email          = $_REQUEST['email'];
        $mobile         = $_REQUEST['mobile'];
        $username       = $_REQUEST['username'];
        $password       = $_REQUEST['password'];
        $address        = $_REQUEST['address'];
        $designation    = $_REQUEST['designation'];
        $branch         = $_REQUEST['branch'];
        $degree_diploma = $_REQUEST['degree_diploma'];
        $teaching_type  = $_REQUEST['teaching_type'];
        $designation    = $_REQUEST['designation'];
        
        $newfilename = "";
        
        if($_FILES['image']['type']=='image/jpeg' || $_FILES['image']['type']=='image/gif' || $_FILES['image']['type']=='image/png')
        {
            if($_FILES['image']['error']>0)
            {
                echo "Error :".$_FILES['image']['error'];
            }        
            else
            {
                $imagepath="images/";
                
                if(!is_dir($imagepath))
                {
                    mkdir($imagepath,0777);
                }
                
                if(is_uploaded_file($_FILES['image']['tmp_name']))
                {
                    $filename  = $_FILES['image']['name'];
                    $extension = end(explode(".",$filename)); 
                    $newfilename = "photo_".time().".".$extension;
                   
                    move_uploaded_file($_FILES['image']['tmp_name'],$imagepath.$newfilename); 
                }
            }
        }
        else
        {
            $newfilename=$imagefile;
        }
        
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM staff WHERE username='".$username."' OR `email`='".$email."' OR `mobile`='".$mobile."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row)
        {
            return "Already Registered.";
        }
        else
        {
            $sql = "INSERT INTO `staff` (`id`, `name`, `email`, `mobile`, `username`, `password`, `address`, `branch`, `degree_diploma`, `teaching_type`, `designation`, `image`, `published`) 
                    VALUES (NULL, '".$name."', '".$email."', '".$mobile."', '".$username."', '".$password."', '".$address."', '".$branch."', '".$degree_diploma."', '".$teaching_type."', '".$designation."', '".$newfilename."',  '0');";
            $result = $db->query($sql);
        }
        
        if($result)
        {
            return "Thank you for registration.";
        }
        else
        {
            return 0;  
        }    
    } 
    
    	 
    static function feedback()
	{
	echo "hiii";
	 $name=$_POST['name'];
        $email=$_POST['email'];
		  $mobile=$_POST['mobile'];
		  $subject=$_POST['subject'];
		   $message=$_POST['message'];
		  
		  
		  $msg='';
		
        $db=new Database();
        $db->open();
       
	   $sql="INSERT INTO `feedback`(`id`, `name`, `email`, `mobile`, `subject`, `message`) VALUES   (NULL, '".$name."', '".$email."', '".$mobile."','".$subject."','".$message."');";
		echo $sql;
        $result=$db->query($sql);
       // $row=$db->fetchobject($result);
		//echo $row;die;
       // return $result;   
	   if ($result)
	   {
	   return "feedback send successfully";
	 }
	 else
	 {
	 return "feedback is not send";
	 }
	 
    } 
   
   static function checkLogin()
    {

        $username=$_POST['username'];
        $password=$_POST['password'];
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `staff` WHERE `username` ='$username' and `password`='$password' and published=1";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
		//echo $row;die;
        return $row;   

    }
    
    	static function addnotice()
	{
	//echo "hiii";
	       $title=$_POST['title'];
           $branch=$_POST['branch'];
		   $description=$_POST['description'];
           $designation=$_POST['designation'];
           
		   $msg='';
           date_default_timezone_set('Asia/Kolkata');
		
        $db=new Database();
        $db->open();
       
	   $sql="INSERT INTO `addnotice` (`id`, `title`,`branch`, `description`, `designation`,`created_date`) VALUES (NULL, '".$title."','".$branch."', '".$description."', '".$designation."','".date('Y-m-d')."');";
	    //$sql="INSERT INTO `addnotice` (`branch`, `description`, `post`)   VALUES (NULL, '".$branch."', '".$description."','".$post.");";
		//echo $sql;
        $result=$db->query($sql);
       // $row=$db->fetchobject($result);
		//echo $row;die;
       // return $result;   
	   if ($result)
	   {
	   return "notice send successfully";
	 }
	 else
	 {
	 return "notice not send";
	 }
	 }
	 
    
}

?>