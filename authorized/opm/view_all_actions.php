<?php
include_once 'authorized/db.php';

$opm_idd=$_GET['opdm'];
$mimi=$_SESSION["emp_file_no"];
                 $noc = mysql_query("SELECT * FROM tbl_user_accounts where emp_file_no='$mimi'") or die(mysql_error());
                $noc_access = mysql_fetch_array($noc);
                $noc_yes = $noc_access['noc_operator'];

if(isset($_GET['st'])){
    if($_GET['st']==1){
        $status='Suspended';
        $status1='Closed';        
        $issued=$_GET['issued'];
        $datas=  mysql_query("UPDATE `tbl_action_list` SET Updatee='$status' WHERE opm_id='$opm_idd' AND Updatee!='$status1'") or die(mysql_error());
    }
    if($_GET['st']==2){        
        $status='';
        $issued=$_GET['issued'];
        $datas=  mysql_query("UPDATE `tbl_action_list` SET Updatee='$status' WHERE sn='$issued'") or die(mysql_error());
    }
     if($_GET['st']==3){        
        $status='';
        $issued=$_GET['issued'];
        $datas=  mysql_query("DELETE FROM `tbl_action_list` WHERE sn='$issued'") or die(mysql_error());
    }
}



if(isset($_POST['submit_et'])){
    $ststus=$_POST['submit_et'];
    $opds=$_POST['opds'];
    $emplo=$_POST['emplo'];
    $add_opm=  mysql_query("UPDATE `tbl_operational_monitor` SET overall_status='$ststus'  WHERE opm_id='$opds' AND key_owner='$emplo'") or die(mysql_error());
    
}


if(isset($_POST['submit_editdata'])){
$DSCF=$_POST['DSCF'];
$keyowner=$_POST['keyowner'];
$action=$_POST['action'];
$requirement=$_POST['requirement'];
$respons=$_POST['respons'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
$sn=$_POST['sn'];
$opd=$_POST['opd'];
$status=$_POST['status'];
$dependence=$_POST['dependence'];
$checkdate = date("Ymd", strtotime($enddate));

$add_opm=  mysql_query("UPDATE `tbl_operational_monitor` SET Description_of_Finding='$DSCF',key_owner='$keyowner' WHERE opm_id='$opd'") or die(mysql_error());
if($add_opm){

         $datas=  mysql_query("UPDATE `tbl_action_list` SET Action='$action',Requirements='$requirement',Responsible='$respons',Start_Date='$startdate',End_Date='$enddate',reportdate='$checkdate',Updatee='$status', dependence='$dependence' WHERE sn='$sn'") or die(mysql_error());
           
           if(empty($status)){
       $delet1=  mysql_query("delete FROM tbl_action_list_report where sn='$sn'") or die(mysql_error());
       $delet2=  mysql_query("delete FROM tbl_action_update where sn='$sn'") or die(mysql_error());
   } 
         
 /////////////////////////////////////////////////////////Emails config////////////////////////////////////////
              $css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';
   
      $en = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opd'") or die(mysql_error());
$low = mysql_fetch_array($en);
        $Description_of_Finding = $low['Description_of_Finding'];
                $key_owner = $low['key_owner'];
                $opm_idz = $low['opm_id'];
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
                
//                         $gt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
//            while ($ab = mysql_fetch_array($gt)) {
//                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$respons'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $responsiblr = $de['email'];
                 $su=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$keyowner'") or die(mysql_error());
                $deu=  mysql_fetch_array($su);
                 $owners = $deu['email'];
//            }
//         $too = implode(", ", $addresses);
              
          $emailing = $responsiblr .','.$owners;
                    $to = $emailing;
                    $subject = $DSCF;
                    $from = 'sas@sincrositewatch.com';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear Team,</p>';
                    $message .= '<p style="">'.$jinalake.' has opened the task for '.$DSCF.' as per below table.</p>';  
                    $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>sn</th>
                            <th>Action</th>
                            <th>Requirements</th>                            
                            <th>Responsible</th>
                            <th>Start</th> 
                            <th>Finish</th>                                                   
                        </tr>
                    </thead>
                    <tbody>';
                       $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
            $j=1;
            while ($QW = mysql_fetch_array($pur)) {
                $Action = $QW['Action'];
                $Requirements = $QW['Requirements'];
                $sn= $QW['sn'];               
                $End_Date= $QW['End_Date'];
                $Start_Date= $QW['Start_Date'];                
                $Responsible= $QW['Responsible'];
                $tbl_customerz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_customerz);
                $first_namee = $re['first_name'];
                $surnamee = $re['surname'];
                $yu=$first_namee.' '.$surnamee;
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                    <td class="product">'.$Action.'</td>
                                <td class="price">'.$Requirements.'</td>
                                <td class="price">'.$yu.'</td>
                                <td class="product">'.$Start_Date.'</td> 
                                <td class="price">'.$End_Date.'</td>       
                            </tr>';
  }
     $message .= '</tbody>
                </table>';
                    $message .= '<p style="">Regards,</p>';
                    $message .= '<p style="">sas(Sincro Automation System)</p>';
                    $message .= '<p style=""><br></p>';
                    $message .= '<h2 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h2>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
        
         
              
    
    
}
}
   

  if(isset($_POST['submit_opm'])){
$DSCF=$_POST['DSCF'];
$keyowner=$_POST['keyowner'];
$action=$_POST['action'];
$requirement=$_POST['requirement'];
$respons=$_POST['respons'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
$opm_id=$_POST['opds'];

    

    
     for ($i = 0; $i < sizeof($action); $i++) {
                        $ed=$enddate[$i];
$checkdate = date("Ymd", strtotime($ed));
         $datas=  mysql_query("INSERT INTO `tbl_action_list`(`Action`, `Requirements`,`Responsible`,`Start_Date`,End_Date,`opm_id`,reportdate)"
            . " VALUES ('$action[$i]','$requirement[$i]','$respons[$i]','$startdate[$i]','$enddate[$i]','$opm_id','$checkdate')") or die(mysql_error());
         
                }
                  /////////////////////////////////////////////////////////Emails config////////////////////////////////////////
              $css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';
   
      $en = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_id'") or die(mysql_error());
$low = mysql_fetch_array($en);
        $Description_of_Finding = $low['Description_of_Finding'];
                $key_owner = $low['key_owner'];
                $opm_idz = $low['opm_id'];
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$keyowner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
    
//                $gt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
//            while ($ab = mysql_fetch_array($gt)) {
//                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$respons'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                $too = $de['email'];
                $su=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$keyowner'") or die(mysql_error());
                $deu=  mysql_fetch_array($su);
                 $owners = $deu['email'];
//                 $addresses[] = $de['email'];
//            }
         
                      
          $emailing = $too .','.$owners;
                    $to = $emailing;
                    $subject = $DSCF;
                    $from = 'sas@sincrositewatch.com';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear Team,</p>';
                    $message .= '<p style="">'.$jinalake.' has opened the task for '.$DSCF.' as per below table.</p>';  
                    $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>sn</th>
                            <th>Action</th>
                            <th>Requirements</th>                            
                            <th>Responsible</th>
                            <th>Start</th> 
                            <th>Finish</th>                                                   
                        </tr>
                    </thead>
                    <tbody>';
                       $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
            $j=1;
            while ($QW = mysql_fetch_array($pur)) {
                $Action = $QW['Action'];
                $Requirements = $QW['Requirements'];
                $sn= $QW['sn'];               
                $End_Date= $QW['End_Date'];
                $Start_Date= $QW['Start_Date'];                
                $Responsible= $QW['Responsible'];
                $tbl_customerz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_customerz);
                $first_namee = $re['first_name'];
                $surnamee = $re['surname'];
                $yu=$first_namee.' '.$surnamee;
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                    <td class="product">'.$Action.'</td>
                                <td class="price">'.$Requirements.'</td>
                                <td class="price">'.$yu.'</td>
                                <td class="product">'.$Start_Date.'</td> 
                                <td class="price">'.$End_Date.'</td>       
                            </tr>';
  }
     $message .= '</tbody>
                </table>';
                    $message .= '<p style="">Regards,</p>';
                    $message .= '<p style="">sas(Sincro Automation System)</p>';
                    $message .= '<p style=""><br></p>';
                    $message .= '<h2 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h2>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////  
    
    


  }


$purchase = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_idd'") or die(mysql_error());
while($row = mysql_fetch_array($purchase)){
        $Description_of_Finding = $row['Description_of_Finding'];
                $key_owner = $row['key_owner'];
                $opm_id = $row['opm_id'];
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
?>


<script type="text/javascript">//<![CDATA[ 
        window.onload = function () {

            $(function () {
                $('table').on('click', 'tr a.cross-delete', function (e) {
                    e.preventDefault();
                    $(this).parents('tr').remove();
                });



                $("#add-invoice-row").click(function () {
                    $("#invoice-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });
                $("#add-asset-row").click(function () {
                    $("#asset-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });

                $("#add-cash-row").click(function () {
                    $("#cash-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });




            });
        };




        //]]>  
    </script>
<div class="col-lg-12">
    <br>

    
</div>
<div class="col-lg-12">
    <br>
    <div class = "well well-sm"><strong>Description of Finding:&nbsp;</strong><?php echo $Description_of_Finding;?></div>
    <div class = "well well-sm"><strong>Key Owner:&nbsp;</strong><?php echo $first_name.' '.$surname; ?></div>
    <div class = "well well-sm"><strong>Status:&nbsp;</strong><?php echo ''; ?>&nbsp;</div>

</div>
<div class="col-lg-12">
    <table class="table table-striped table-bordered" cellspacing="0"  >
        <thead>
            <tr>
                <th>sn</th>
                <th>Action</th>
                <th>Requirements</th>
                <th>Responsible</th>
                <th>Start</th> 
                <th>End</th>
                <th>Status</th>
                <th></th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'authorized/db.php';
            
            $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id'") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($pur)) {
                $Action = $row['Action'];
                $Requirements = $row['Requirements'];
                $sn= $row['sn'];
                $Execution_date= $row['Execution_date'];
                $End_Date= $row['End_Date'];
                $Start_Date= $row['Start_Date'];
                $Updatee= $row['Updatee'];
                $Responsible= $row['Responsible'];
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_namee = $rows['first_name'];
                $surnamee = $rows['surname'];                  
                ?>
                <tr>
                    <td>
<?php
                        if($key_owner==$mimi OR $noc_yes=='YES'){
                        ?>
                         <div class="dropdown">
  <a class="dropdown-toggle" href="#"  data-toggle="dropdown">Action</a>
  <ul class="dropdown-menu">
      <li><a href="?action=view_opp&st=1&opdm=<?php echo $opm_idd;?>&issued=<?php echo $sn; ?>">Suspend</a></li>
    <li><a href="?action=view_opp&st=2&opdm=<?php echo $opm_idd;?>&issued=<?php echo $sn; ?>">Active</a></li>
<li><a href="?action=view_opp&st=3&opdm=<?php echo $opm_idd;?>&issued=<?php echo $sn; ?>">Delete</a></li>    
  </ul>
</div> 
                         <?php
                        }
                        else
                        {
                            
                        }
                        ?>
                    </td>
                    <td>
                        <a href=""><?php echo $Action; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $Requirements; ?></a>
                    </td>
                    <td>
                        <?php echo $first_namee.' '.$surnamee; ?>
                    </td>
                    <td>
                        <?php echo $Start_Date; ?>
                    </td>
                    <td>
                        <?php echo $End_Date; ?>
                    </td>
                    <td>
                        <?php echo $Updatee; ?>
                    </td>
                    
                    <td>
                        <?php
                        if($key_owner==$mimi OR $noc_yes=="YES"){
                        ?>
                        <a href="#" onclick="edit_issuez('authorized/opm/edit_finding_issue.php?issued=<?php echo $sn; ?>')"  data-toggle="modal" data-target="#edit_findings">Edit</a>
                   <?php
                        }
                        else
                        {
                            
                        }
                        ?>
                    </td>
                    
                </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>
<?php
}

?>

<div class="col-lg-12">
                    <form  class="form-horizontal" action=""  method="post">
                   
                    <div class="row" >
 
                        <div class="col-lg-12">
                            <input name="DSCF" value="<?php echo $Description_of_Finding;?>"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                            <input name="keyowner" value="<?php echo $key_owner;?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                            <input name="opds" value="<?php echo $opm_idd;?>"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">

                            <table class="table table-striped table-hover bordered" id="cash-table">
                                <thead><tr>

                                        <th>No</th>
                                        <th>Action</th>                                      
                                        <th>Requirement</th>
                                        <th>Responsible</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px">

                                    <tr>

                                        <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:24%">
                                            <input name="action[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:24%">
                                            <input name="requirement[]" id="pric"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <select class="form-control" name="respons[]" id="fs">
                                    <option>---select</option>
<?php
$a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
while ($b = mysql_fetch_array($a)) {
    $first_name = $b['first_name'];
    $surname = $b['surname'];
    $emp_file_noo = $b['emp_file_no'];
    ?>
                                        <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                    <?php } ?>
                                </select>
                                        </td>
                                        <td style="width:8%">
                                            <input name="startdate[]"  class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:8%">
                                            <input name="enddate[]"  class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:30%">
                                            <input name="action[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:24%">
                                            <input name="requirement[]" id="pric"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <select class="form-control" name="respons[]" id="fs">
                                    <option>---select</option>
<?php
$a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
while ($b = mysql_fetch_array($a)) {
    $first_name = $b['first_name'];
    $surname = $b['surname'];
    $emp_file_noo = $b['emp_file_no'];
    ?>
                                <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                  <?php } ?>
                                </select>
                                        </td>
                                        <td style="width:8%">
                                            <input name="startdate[]"  class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:8%">
                                            <input name="enddate[]"  class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                       
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>


                                </tbody>
                            </table>



                            <button type="button" id="add-cash-row"  class="btn btn-success"   >
                                <span  aria-hidden="true"></span> + add new row&nbsp;
                            </button>
                            <button type="submit" name="submit_opm" class="btn btn-success" style="color:white"><i class="fa fa-save"></i>&nbsp;Save Data</button>

                        </div>
                    </div>
                </form>
</div>

<!-- Modal -->
<div id="edit_findings" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Finding</h4>
      </div>
      <div class="modal-body">
          <div class="row" id="letehapa">
             <!--lete hapa-->
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



