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
    
    static function approveAttendance()
    {
        $staff_id = $_REQUEST['staff_id'];
        $date     = date('Y-m-d',$_REQUEST['date']);
        $id       = $_REQUEST['id'];
        
        $db       = new Database();
        $db->open();
        
        $sql = "SELECT `id` FROM `attendance` WHERE `staff_id`='".$staff_id."' AND `date`='".$date."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row->id == 0)
        {
            $sql = "INSERT INTO `attendance` (`id`, `staff_id`, `date`, `in_time`, `out_time`) 
                    VALUES (NULL, '".$staff_id."', '".$date."', '11:00:00', '19:00:00');";
            $result = $db->query($sql);
            
            $sql = "UPDATE `office_duty` SET approved=1 WHERE `id`='".$id."'";
            $result = $db->query($sql);
        }
    }
    
    static function checkLogin()
    {
        $usertype=$_POST['usertype'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $db=new Database();
        $db->open();
        $sql = "";
        if($usertype == 'Admin')
        {
            $sql="SELECT * FROM `admins` WHERE `username` ='$username' and `password`='$password'";
        }
        else
        {
            $sql="SELECT * FROM `staff` WHERE `username` ='$username' and `password`='$password' AND designation='HOD'";
        }
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   

    }
    
    function getAttendanceList()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT a.*,b.`name`,b.`designation` FROM `attendance` as a JOIN `staff` as b ON a.`staff_id`=b.`id` ORDER BY a.id DESC";
       
        $result = $db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Date</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th style="text-align: center;">Remove</th>
                </tr>    
                <?php
                
                while($row = $db->fetcharray($result))
                {
                    
                    ?>
                     <tr>
            	        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['designation'];?></td>
            			<td><?php echo date('d/m/Y',strtotime($row['date']));?></td>
            		    <td><?php echo ($row['in_time'] !='00:00:00') ? date('h:i A',strtotime($row['in_time'])) : "";?></td>
            			<td><?php echo ($row['out_time'] !='00:00:00') ? date('h:i A',strtotime($row['out_time'])) : "";?></td>
                        <td style="text-align: center;">
                            <a href="attendancelist.php?id=<?php echo $row['id']; ?>&task=remove">Remove</a>
                        </td>
                   </tr> 
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function removeAttendance($id)
    {        
        $db=new Database();
        $db->open();
               
        $sql="DELETE FROM `attendance` WHERE `id` =".$id;
        $result=$db->query($sql);

        if($result)
        {
            echo "<script>window.location='attendancelist.php';</script>";
        }
        else
        {
            return "Attendance Not Removed.";
        }
    }
    
    function getOfficeDutyList()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT a.*,b.`name`,b.`designation` FROM `office_duty` as a JOIN `staff` as b ON a.`staff_id`=b.`id` ORDER BY a.id DESC";
       
        $result = $db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                <th style="width: 25%;">Name</th>
                <th style="width: 10%;">Designation</th>
                <th style="width: 10%;">Date</th>
                <th>Reason</th>
                <th style="width: 12%;">Make Attendance</th>
                </tr>    
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                     <tr>
            	        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['designation'];?></td>
            			<td><?php echo date('d/m/Y',strtotime($row['created_date']));?></td>
            		    <td><?php echo $row['reason'];?></td>
                        <td>
                            <?php if($row['approved']) { echo "Approved";}else{ ?>
                            <a href="officelist.php?staff_id=<?php echo $row['staff_id'];?>&date=<?php echo strtotime($row['created_date']);?>&id=<?php echo $row['id'];?>&task=approve">Make Attendance</a>
                            <?php } ?>
                        </td>
                   </tr> 
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    	
	function getFeedbackList()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `feedback` ORDER BY id DESC";
       
        $result = $db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                <th>Name</th>
                <th>email</th>
                <th>Mobile No</th>
                <th>Subject</th>
                <th>Message</th>
                
                
                <th style="text-align: center;">Remove</th>
                </tr>    
                <?php
                
                while($row = $db->fetcharray($result))
                {
                    
                    ?>
                     <tr>
            	        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['mobile'];?></td>
            			<td><?php echo $row['subject'];?></td>
            		    <td><?php echo $row['message'];?></td>
            			
                        
                        <td style="text-align: center;">
                            <a href="feedbacklist.php?id=<?php echo $row['id']; ?>&task=remove">Remove</a>
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
            No feedback found
            <?php
        }
        
    }
	
    function removeFeedback($id)
    {        
        $db=new Database();
        $db->open();
               
        $sql="DELETE FROM `feedback` WHERE `id` =".$id;
        $result=$db->query($sql);

        if($result)
        {
            echo "<script>window.location='feedbacklist.php';</script>";
        }
        else
        {
            return "feedback Not Removed.";
        }
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
    
     
    function removeNotice($id)
    {        
        $db=new Database();
        $db->open();
               
        $sql="DELETE FROM `addnotice` WHERE `id` =".$id;
        $result=$db->query($sql);

        if($result)
        {
            echo "<script>window.location='noticelist.php';</script>";
            //return "Staff Removed.";
        }
        else
        {
            return "Notice Not Removed.";
        }
    }
    
     function getNoticeList()
    {
        $db = new Database();
        $db->open();
        $branch_array=array("1"=>"Computer Sci &amp; engg","2"=>"Civil engg","3"=>"Mechanical engg","4"=>"E &amp; TC engg","5"=>"Electrical engg");
        
        $sql    = "SELECT * FROM `addnotice` ORDER BY id DESC";
       
        $result = $db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered" align="left" cellpadding="5px" cellspacing="5px" border="1px">
                <tr>
                <th>Title</th>
                <th>Branch</th>
                <th>Description</th>
                <th>Designation</th>
                <th>Created_date.</th>
                <th style="text-align: center;">Remove</th>
                </tr>    
                <?php
                
                while($row = $db->fetcharray($result))
                {
                    
                    ?>
                     <tr>
            	        <td><?php echo $row['title'];?></td>
                        <td>
                            <?php
                                
                                    
                                    echo $branch_array[$row['branch']];
                                   
                               
                            ?>
                        
                        
                        </td>
                        <td><?php echo $row['description'];?></td>
            			<td><?php echo $row['designation'];?></td>
            		    <td><?php echo date('d-m-Y',strtotime($row['created_date']));?></td>
            			
                        
                        <td style="text-align: center;">
                            <a href="noticelist.php?id=<?php echo $row['id']; ?>&task=remove">Remove</a>
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
            No Notice found
            <?php
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
    
    function mapData()
    {      
        $db=new Database();
        $db->open();
        
		$sql="SELECT a.latitude,a.longitude,b.name FROM `current_location` as a JOIN `staff` as b ON b.id=a.staff_id WHERE b.id=".$_REQUEST['userid'];
        //echo $sql;die;
		$result=$db->query($sql);
        
		return $db->fetchobject($result);
    }
      
}

?>