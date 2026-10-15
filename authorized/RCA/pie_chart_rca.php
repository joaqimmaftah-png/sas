<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "tbl_sincro";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
        or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");
    $gtu=mysql_query("SELECT DISTINCT(tech_name) FROM tbl_site_db") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $tech_name=$ab['tech_name'];
                
//                $gtuu=mysql_query("SELECT * FROM tbl_site_db where site_id='$site_id'") or die(mysql_error());
//                $abc = mysql_fetch_array($gtuu);
//                $site_id=$abc['site_id'];
//                              
                $b=  mysql_query("SELECT b.site_id,a.site_id,b.tech_name FROM tbl_rca a,tbl_site_db b WHERE b.site_id=a.site_id AND b.tech_name='$tech_name'") or die(mysql_error());
                $va=  mysql_num_rows($b);
                $bz=  mysql_query("SELECT * FROM tbl_rca") or die(mysql_error());
                $vz=  mysql_num_rows($bz);
                $perct=($va/$vz)*100;
                
                

//                $emplid=$ab['Responsible'];
                $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$tech_name' ")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
    
                 $addresses = $fullname.' ,'.$perct.'<br>';
                 echo $addresses;
            }
 
        
        
