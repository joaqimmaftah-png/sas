<?php
require_once __DIR__ . '/mysql_compat.php';

    $webhook_secret = 'ANERQF9T427DN966WX74KR4PQ7PFFW4N';
    
    if ($_POST['secret'] !== $webhook_secret)
    {
        header('HTTP/1.1 403 Forbidden');
        echo "Invalid webhook secret";
    }
    else 
    {
        if ($_POST['event'] == 'incoming_message')
        {
        
            $content = $_POST['content'];
            $from_number = $_POST['from_number'];
            $phone_id = $_POST['phone_id'];
            
            
          
            ////////////databaseconnection///////
            require_once __DIR__ . '/db.php';
            /////////////////////////////////////////////////////////
            
$smsArray33 = explode(" ", $content);
$muamala=$smsArray33['0'];
$amount=$smsArray33['2'];
$a=$smsArray33['8'];
$amountkiasi = str_replace(',', '',$a);
$sender=$smsArray33['11'];
$today=date("d.m.Y");
//select clients database
$select_solar = mysql_query("SELECT * FROM tbl_solar_clients WHERE phone_no='$sender' or phone_no2='$sender'") or die(mysql_error());
$mn=mysql_fetch_array($select_solar);
$kko=  mysql_num_rows($select_solar);
$client_id= $mn['client_id'];
 if($kko>0){ 
$ms=  mysql_query("SELECT * FROM tbl_solar_contract WHERE client_id='$client_id'") or die(mysql_error());
    $mt = mysql_fetch_array($ms);
    $Ref=$mt['Ref'];
// This variable sets up the information to send to your database


$update=  mysql_query("INSERT INTO `tbl_solar_payment`(`reference`, `client_id`, `amount`, `paid_date`) "
        . "VALUES ('$Ref','$client_id','$amountkiasi','$today')") or die(mysql_error());
            
            /////////////////////////////////////////////////////////
            
            
            
            // do something with the message, e.g. send an autoreply            
            header("Content-Type: application/json");
            echo json_encode(array(
                'messages' => array(
                    array('content' => "Thanks for your Payment.It has been a pleasure doing business with you. We wish you best of luck.")
                )
            ));
            
        }
            
        }
    }