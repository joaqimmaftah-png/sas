<html>
    <head>
         <script type="text/javascript">setTimeout("window.close();", 3000);</script>
    </head>
    <body>
    
        <?php
        include 'authorized/db.php';
$date=date("Y-m-d");
    $random=rand();
    $time=date("H:i");
    $datee=date("M d Y");
    $te=mysql_query("SELECT * FROM tbl_class_a_site WHERE sitename<>'NOC TIGO'") or die(mysql_error());
    while ($nd=mysql_fetch_array($te)){
       $site[]=$nd['s_id'];
       $email[]=$nd['email'];
       
    }
        $to = implode(",",$email);            
    for ($i = 0; $i <11; $i++) {
                    $insert = mysql_query("INSERT INTO site_attendance_update(`site_id`, `token_number`,`sent_time`, `date`)"
                            . "values('$site[$i]','$random','$time','$date')") or die(mysql_error());
                            
                            
                            
                } 
    
    
  
    ?>
    </body>
    </html>

