<?php

error_reporting(0);
require_once "../inc/config.php";
require_once "../inc/dbhelper.php";

class AndroidHelper
{
    public function checkLogin()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $mac      = $_REQUEST['mac'];
         
        $db = new Database();
        $db->open();
        
        //$sql    = "SELECT * FROM staff WHERE username = '".$username."' AND password='".$password."'";
        $sql    = "SELECT * FROM staff WHERE username = '".$username."' AND password='".$password."' AND published = 1";
        //echo $sql;die;
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row)
        {
            $sql    = "UPDATE staff SET mac='".$mac."' WHERE id=".$row->id;
            $result = $db->query($sql);
            
            return $row->id; 
        }
        else
        {
            return 0;  
        }
    }

    function getWeekAttendance()
    {
        $staff_id  = $_REQUEST['staff_id'];
        $db = new Database();
        $db->open();
        
        $rows = array();
        $dates = AndroidHelper::getLastNDays(7);
        foreach($dates as $date)
        {
            $sql = "SELECT `id` FROM `attendance` WHERE `staff_id`='".$staff_id."' AND `date`='".$date."'";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if($row->id)
            {
                $data = array();
                $data['date'] = date('l, jS \of F Y',strtotime($date));
                $data['status'] = 'P';
                $data['attn_class'] = 'button-positive';
                $rows[] = $data;
            }
            else
            {
                $data = array();
                $data['date'] = date('l, jS \of F Y',strtotime($date));
                $data['status'] = 'A';
                $data['attn_class'] = 'button-assertive';
                $rows[] = $data;
            }
        }
        echo json_encode($rows);   
    }
 
    function getLastNDays($days, $format = 'Y-m-d')
    {
        $m = date("m"); $de= date("d"); $y= date("Y");
        $dateArray = array();
        for($i=0; $i<=$days-1; $i++){
           $dateArray[] =  date($format, mktime(0,0,0,$m,($de-$i),$y)) ; 
        }
        return array_reverse($dateArray);
    }

    public function saveReason()
    {
        $staff_id  = $_REQUEST['staff_id'];
        $reason    = $_REQUEST['reason'];
        date_default_timezone_set('Asia/Kolkata');
        
        $db = new Database();
        $db->open();
                
        $sql = "INSERT INTO `office_duty` (`id`, `staff_id`, `reason`, `created_date`) 
                VALUES (NULL, '".$staff_id."', '".$reason."','".date('Y-m-d H:i:s')."');";
        $result = $db->query($sql);
        if($result)
        {
             return 1;
        }
        else
        {
            return 0;  
        }    
        
         
    }
    
    public function makeattendance($data)
    {
        $staff_id  = $data['staff_id'];
        $longitude = $data['longitude'];
        $latitude  = $data['latitude'];
        $distance  = $data['distance'];
        $mac       = $data['mac'];
        
        date_default_timezone_set('Asia/Kolkata');
        
        $db = new Database();
        $db->open();
        
        $sql = "SELECT * FROM `attendance` WHERE `staff_id`='".$staff_id."' AND date ='".date('Y-m-d')."'";
        $res = $db->query($sql);
        $row    = $db->fetchobject($res);
         
        if(!$row && (float)$distance <= (float)('0.10') && $mac!='' && $distance != '')
        {
            $sql = "INSERT INTO `attendance` (`id`, `staff_id`, `date`, `longitude`, `latitude`, `in_time`, `out_time`, `mac`,`distance`) 
                    VALUES (NULL, '".$staff_id."', '".date('Y-m-d')."', '".$longitude."', '".$latitude."', '".date('H:i:s')."', '', '".$mac."','".$distance."');";
            $result = $db->query($sql);
            if($result)
            {
                return 1;// $db->insertID();
            }
            else
            {
                return 0;  
            }    
        }
        else
        {
            return 2;
        }
    }
     
    public function updateOuttime()
    {
        $staff_id  = $_REQUEST['staff_id'];
        
        date_default_timezone_set('Asia/Kolkata');
        
        $db = new Database();
        $db->open();
        
        $sql = "UPDATE `attendance` SET `out_time`= '".date('H:i:s')."' WHERE `staff_id`='".$staff_id."' AND date ='".date('Y-m-d')."'";
        $result = $db->query($sql);
        if($result)
        {
            return 1;
        }
        else
        {
            return 0;  
        }   
        
    }
    
    public function attend_info()
    {
        $id = $_REQUEST['id'];
        
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `attendance` WHERE `staff_id`='".$id."' AND date ='".date('Y-m-d')."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        $row->in_time = ($row->in_time !='00:00:00') ? date('h:i A',strtotime($row->in_time)) : "";
        $row->out_time = ($row->out_time !='00:00:00') ? date('h:i A',strtotime($row->out_time)) : "Out Time Not Updated";
        echo json_encode($row);
    }
    
    public function register()
    {
        $name       = $_REQUEST['name'];
        $email      = $_REQUEST['email'];
        $mobile     = $_REQUEST['mobile'];
        $username   = $_REQUEST['username'];
        $password   = $_REQUEST['password'];
        $address    = $_REQUEST['address'];
        $designation= $_REQUEST['designation'];
        $mac        = $_REQUEST['mac'];
        $branch     = $_REQUEST['branch'];
        $db = new Database();
        $db->open();
        
    
        /*$sql    = "SELECT * FROM staff WHERE mac LIKE '".$mac."'"; 
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row)
        {
            return $row->id; //"-1";
        }
        else
        {*/
            $sql = "INSERT INTO `staff` (`id`, `name`, `email`, `mobile`, `username`, `password`, `address`,`branch`, `designation`, `mac`, `published`) 
                    VALUES (NULL, '".$name."', '".$email."', '".$mobile."', '".$username."', '".$password."', '".$address."', '".$branch."','".$designation."', '".$mac."', '0');";
           
            $result = $db->query($sql);
       // }
        
        if($result)
        {
            return 1;// $db->insertID();
        }
        else
        {
            return 0;  
        }    
    }
    
    public function editprofile()
    {
        $id         = $_REQUEST['id'];
        $name       = $_REQUEST['name'];
        $email      = $_REQUEST['email'];
        $mobile     = $_REQUEST['mobile'];
        $username   = $_REQUEST['username'];
        $password   = $_REQUEST['password'];
        $address    = $_REQUEST['address'];
        $designation= $_REQUEST['designation'];
        $branch     = $_REQUEST['branch'];
        $db = new Database();
        $db->open();
        
        $sql = "UPDATE `staff` SET name='".$name."',email='".$email."',mobile='".$mobile."',address='".$address."',designation='".$designation."',branch='".$branch."',username='".$username."',password='".$password."' WHERE id=".$id;
        $result = $db->query($sql);
        if($result)
        {
            return 1;
        }
        else
        {
            return 0;  
        }  
    }
    
    
    public function getNotices()
    {
        $staff_id  = $_REQUEST['staff_id'];
        
        $db = new Database();
        $db->open();
        
        $sql = "SELECT a.title,a.description,a.created_date FROM `addnotice` AS a JOIN `staff` AS b ON a.`branch` = b.`branch` AND a.`designation` = b.`designation` WHERE b.`id` =".$staff_id;
        $result = $db->query($sql);
        
        $rows = array();
        while($row = $db->fetcharray($result))
        {
            $rows[] = $row;
        }
        
        if(empty($rows))
        {
            $rows[] = array("title"=>"Notice","description"=>"No notice found");
        }
        
        echo json_encode($rows);
    }
    
    public function getprofile()
    {
        $id = $_REQUEST['id'];
        
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `staff` WHERE `id`='".$id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        echo json_encode($row);
    }
    
    public function updateLocation()
    {
        $helper    = new AndroidHelper();
        $staff_id  = $_REQUEST['staff_id'];
        $longitude = $_REQUEST['longitude'];
        $latitude  = $_REQUEST['latitude'];
        $distance  = $_REQUEST['distance'];
        $mac       = $_REQUEST['mac'];
        
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `current_location` WHERE `staff_id`='".$staff_id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row->staff_id)
        {
            $sql = "UPDATE `current_location` SET `longitude`='".$longitude."', `latitude`='".$latitude."', `distance`='".$distance."' WHERE `staff_id`='".$staff_id."'";
            $db->query($sql);
        }
        else
        {
            $sql = "INSERT INTO `current_location` (`staff_id`, `latitude`, `longitude`, `distance`) VALUES ('".$staff_id."', '".$latitude."', '".$longitude."', '".$distance."');";
            $db->query($sql);
        }
        
        $data              = array();
        $data['staff_id']  = $staff_id;
        $data['longitude'] = $longitude;
        $data['latitude']  = $latitude;
        $data['distance']  = $distance;
        $data['mac']       = $mac;
        
        $helper->makeattendance($data);
    }
    
}
?>