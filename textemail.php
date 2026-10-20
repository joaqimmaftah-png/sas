<?php
require_once __DIR__ . '/mysql_compat.php';

    $webhook_secret = 'C92ZADQ4PU9TZKAQQW4GZ96HFPTQETRQ';
    
    if ($_POST['secret'] !== $webhook_secret)
    {
        header('HTTP/1.1 403 Forbidden');
        echo "Invalid webhook secret";
    }
    else 
    {
        if ($_POST['event'] == 'incoming_message')
        { 
        include 'db.php';
            $content = $_POST['content'];
            $from_number = $_POST['from_number'];
            $phone_id = $_POST['phone_id'];
            $b=mysql_query("INSERT INTO `tbl_sms`(`sms_body`,`sender`) VALUES ('$content','$from_number')") or die(mysql_error());
            if($b){
                $c=  mysql_query("SELECT * FROM tbl_sms WHERE sender='$from_number'") or die(mysql_error()); 
                $w=  mysql_fetch_array($c);
                $sms_body=$w['sms_body'];
                $sms_id=$w['sms_id'];
            // do something with the message, e.g. send an autoreply            
            header("Content-Type: application/json");
            echo json_encode(array(
                'messages' => array(
                    array('content' => $sms_body.$sms_id)
                )
            ));
            }
            
        }
    }
    ?>