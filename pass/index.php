<?php 
    error_reporting(E_ALL);
    $conn = mysqli_connect("localhost","medilife","medilife","medilifeApp");
    $email = $_GET['email'];
    if($_GET['password']!=''){
        $otp = $_GET['otp'];
        $query = "select * from users where email='$email' and otp='$otp'";
        //echo $query;die;
        $new = mysqli_query($conn,$query);
        if(mysqli_num_rows($new)<1){
            $message['success'] = '0';
            $message['message'] = "Otp doesn't match";
        }else{
            $otp = mt_rand(1000,9999);
            $password = password_hash($_GET['password'], PASSWORD_DEFAULT);
            $sql = "update users set otp='$otp',password='$password' where email='$email'";
            $up = mysqli_query($conn,$sql);
            if($up){
                $message['success'] = '1';
                $message['message'] = "Password changed successfully";
            }else{
                $message['success'] = '0';
                $message['message'] = "Try after sometime";
            }
        } 
    }else{
        $otp = mt_rand(1000,9999);
        $query = "select * from users where email='$email'";
        $new = mysqli_query($conn,$query);
        if(mysqli_num_rows($new)<1){
            $message['success'] = '0';
            $message['message'] = "Email not exist";
        }else{
            $sql = "update users set otp='$otp' where email='$email'";
            $up = mysqli_query($conn,$sql);
            if($up){
                $to = $email;
                $subject = "Medilife Pharmacy";
                $message1 = "<b>Your Otp is here.</b>";
                $message1 .= "<h1>".$otp."</h1>";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                $retval = mail ($to,$subject,$message1,$header);
                $message['success'] = '1';
                $message['message'] = "Otp sent successfully to your email";
                if($retval){
                    $message['msg'] ="sent";
                }else{
                    $message['msg'] ="not sent";
                }
                
            }else{
                $message['success'] = '0';
                $message['message'] = "Try after sometime";
            }
        } 
    }
    echo json_encode($message);
    

?>