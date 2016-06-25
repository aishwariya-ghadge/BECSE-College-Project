<?php

error_reporting(0);
session_start();
        
require_once "../inc/config.php";
require_once "../inc/dbhelper.php";

class AdminHelper
{
        
    
    static function sayHello()
    {
        echo "hiii";
    }
    
    static function checkLogin()
    {

        $username=$_POST['username'];
        $password=$_POST['password'];
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `admins` WHERE `username` ='$username' and `password`='$password'";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   

    }
    
    function getStaffList()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `staff` ORDER BY id DESC";
       
        $result = $db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Designation</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th style="text-align: center;">Published</th>
                <th style="text-align: center;">Remove</th>
                </tr>    
                <?php
                
                while($row = $db->fetcharray($result))
                {
                    
                    ?>
                     <tr>
            	        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['designation'];?></td>
            			<td><?php echo $row['username'];?></td>
            		    <td><?php echo $row['email'];?></td>
            			<td><?php echo $row['mobile'];?></td>
                        <td style="text-align:center;">
                            <?php if($row['published']) { ?>
                                
                                <a href="stafflist.php?id=<?php echo $row['id']; ?>&published=0&task=status"><img  src="../img/tick.png" /></a>
                                
                            <?php } else { ?>
                            <a href="stafflist.php?id=<?php echo $row['id']; ?>&published=1&task=status"><img src="../img/publish_x.png" /></a>
                             <?php } ?>
                        
                        </td>
                        <td style="text-align: center;">
                            <a href="stafflist.php?id=<?php echo $row['id']; ?>&task=remove">Remove</a>
                        </td>
                   </tr> 
                    <?php
                }
                ?>
            </table>
            <?php
        }
        else
        {
            ?>
            No Staff found
            <?php
        }
        
    }
        
    function updateStaffStatus($id)
    {        
        $db=new Database();
        $db->open();
               
        $sql="UPDATE `staff` SET `published` = '".$_GET['published']."' WHERE `id` =".$id;
        $result=$db->query($sql);

        if($result)
        {
            if($_REQUEST['published'])
            {
                $sql    = "SELECT * FROM `staff` WHERE id=".$id;
                $res    = $db->query($sql);
                $data   = $db->fetchobject($res);
                
                $sms_msg = "Your account is verified. Now you can Login.";
                $ch = curl_init();
                $smsurl="http://sms.svmindlogic.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=fd73cf0e1d8101afc6dc38f7399571b&senderId=SVMNDL&message=".urlencode($sms_msg)."&mobileNos=".$data->mobile."&smsContentType=english";
                curl_setopt($ch, CURLOPT_URL,$smsurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, '3');
                $content = trim(curl_exec($ch));
                curl_close($ch);
                
                echo "<script>window.location='stafflist.php';</script>";
            }
           // return "Staff Status Updated.";
        }
        else
        {
            return "Staff Status Not Updated.";
        }
    }
        
    function removeStaff($id)
    {        
        $db=new Database();
        $db->open();
               
        $sql="DELETE FROM `staff` WHERE `id` =".$id;
        $result=$db->query($sql);

        if($result)
        {
            echo "<script>window.location='stafflist.php';</script>";
            //return "Staff Removed.";
        }
        else
        {
            return "Staff Not Removed.";
        }
    }
      
}

?>