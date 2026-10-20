  <?php
require_once __DIR__ . '/../../mysql_compat.php';

 include_once 'authorized/db.php';
  if(isset($_POST['submit_opm'])){
$DSCF=mysql_escape_string($_POST['DSCF']);
$keyowner=$_POST['keyowner'];
$action=$_POST['action'];
$requirement=$_POST['requirement'];
$respons=$_POST['respons'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
$open_by=$_POST['open_by'];
$op_category=$_POST['op_category'];

$add_opm=  mysql_query("INSERT INTO `tbl_operational_monitor`(`Description_of_Finding`,`key_owner`,open_by,category_type) VALUES ('$DSCF','$keyowner','$open_by','$op_category')") or die(mysql_error());
if($add_opm){
    $select_qw=  mysql_query("SELECT * FROM tbl_operational_monitor ORDER BY opm_id DESC") or die(mysql_error());
    $ds=mysql_fetch_array($select_qw);
    $opm_id=$ds['opm_id'];


    
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
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
    
                $gt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
            while ($ab = mysql_fetch_array($gt)) {
                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
         $too = implode(", ", $addresses);
              
          $emailing = $too . ',nadhifa.omar@sincrositewatch.com,noc_a@sincrositewatch.com';
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

<br>




<div class="col-lg-12">
            <button data-toggle="modal" data-target="#monitor" class="btn btn-success" style="color:white"><i class="fa fa-plus"></i>&nbsp;Add New</button>
           
            <br />
            <br />
        </div>
<div class="col-lg-12">
    <table id="home" class="table table-striped table-bordered" cellspacing="0" style=" font-size: 12px;" >
        <thead>
            <tr>
                <th>SN</th>
                <th>Ref No</th>
                <th>Description of work</th>
                <th>Key Owner</th>
                <th>Open Date</th>
                 <th>Finish Date</th>
                <th>Open By</th>
                <th>Status</th>
                <th>My Action(s)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'authorized/db.php';
            $purchase = mysql_query("SELECT * FROM tbl_operational_monitor WHERE category_type=2 ORDER BY opm_id DESC") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($purchase)) {
                $Description_of_Finding = $row['Description_of_Finding'];
                $key_owner = $row['key_owner'];
                $opm_id = $row['opm_id'];
                $mimi=$_SESSION["emp_file_no"];
                $open_by=$row['open_by'];
                $owner=$row['key_owner'];
                    
    if(!empty($open_by)){
        $openname=$open_by; 
    }
 else {
      $openname=$owner;
        
    }
                $tbl_customerz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$openname'") or die(mysql_error());
                $rowsz = mysql_fetch_array($tbl_customerz);
                $first_namee = $rowsz['first_name'];
                $surnamee = $rowsz['surname'];

    
 
                
        $pur=mysql_query("SELECT * FROM tbl_action_list where Responsible='$mimi' AND opm_id='$opm_id' AND updatee!='Closed' AND Updatee!='Suspended'") or die(mysql_error());
        $num=  mysql_num_rows($pur);
                     
         
 
  
  $gf=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND (Updatee='Closed' OR Updatee='On Progress' OR Updatee='')") or die(mysql_error());
  $progress=  mysql_num_rows($gf);
  
  $gtt2=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND Updatee='Suspended'") or die(mysql_error());
  $koo=  mysql_num_rows($gtt2);
  
  $gfv=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND Updatee='Closed'") or die(mysql_error());
  $complete=  mysql_num_rows($gfv);
  
  $vc=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id'") or die(mysql_error());
  $a=  mysql_num_rows($vc);
  $b=$a-$complete;
  
  $vcz=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' order by reportdate DESC LIMIT 1") or die(mysql_error());
  $ax=  mysql_fetch_array($vcz);
  $cvfg=date('Y-m-d',strtotime($ax['Start_Date']));
  $vczz=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' order by reportdate ASC LIMIT 1") or die(mysql_error());
  $axz=  mysql_fetch_array($vczz);
  $cvfgz=date('Y-m-d',strtotime($axz['End_Date']));
  
   $noc_person=$_SESSION["emp_file_no"];
                     $noc = mysql_query("SELECT * FROM tbl_user_accounts where emp_file_no='$noc_person'") or die(mysql_error());
                $noc_access = mysql_fetch_array($noc);
                $noc_yes = $noc_access['noc_operator'];
  
  if($progress>0 && $koo==0 && $b!=0){
      $makestatus='On Progress';
      $onprogress="";
      
  }
  elseif ($progress>=0 && $koo>0 && $b!=0) {
  $makestatus='Suspended';
  $onprogress="danger";
}
  else {
     $makestatus='Complete'; 
     $onprogress="success";
}

if($num!=0 OR $noc_yes=='YES'){
    $my_action=' <a href="?action=view_finding&opdm='.$opm_id.'">View&nbsp;<span class="badge label-warning">'.$num.'</span></a>' ;
}
 else {
    $my_action='Null' ;
}
         
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
               
               

                
                ?>
            <tr class="<?php echo $onprogress;?>">
                    <td>
                        <a href=""><?php echo $j++; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo 'OPM'.sprintf("%04d", $opm_id);?></a>
                    </td>
                    <td>
                        <a href="?action=view_opp&opdm=<?php echo $opm_id;?>"><?php echo htmlspecialchars($Description_of_Finding); ?></a>
                    </td>
                    <td>
                        <?php echo $first_name.' '.$surname; ?>
                    </td>
                    <td>
                        <?php echo $cvfg; ?>
                    </td>
                    <td>
                        <?php echo $cvfgz;?> 
                    </td>
                     <td>
                        <?php echo $first_namee.' '.$surnamee; ?>
                    </td>
                    <td>
                        <?php echo $makestatus; ?>
                    </td>
                    
                    <td>
                       <?php echo $my_action;?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <th>SN</th>
                <th>Ref No</th>
                <th>Description of work</th>
                <th>Key Owner</th>
                 <th>Open Date</th>
                 <th>Finish Date</th>
                  <th>Open By</th>
                <th>Status</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
<br>
<br>

            <div class="col-lg-12">
                <br><br>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive Pure -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6960259539797167"
     data-ad-slot="5444808775"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
            </div> 
                 

<!-- Modal -->

<!--end solar clients-->


<div id="monitor" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Operational Monitor</h5>
            </div>
            <div class="modal-body">
                <form  class="form-horizontal" action=""  method="post">
                   
                    <div class="row" >
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:100%">

                                            <input name="DSCF" required="" placeholder="Description of work:"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>

                                    </tr> 
                                     <tr>
                                        
                                            <td style="width:100%">
                                                <?php
                                            $mimi=$_SESSION["emp_file_no"];                                           
                                            $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                                                ?>
                                                <input name="open_by" placeholder="" value="<?php echo $mimi; ?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                                                <select class="form-control amount editable"  aria-describedby="sizing-addon1" name="op_category" required="">
                                                    <option value="">Select category</option>
                                                    <option value="2">Operational</option>
                                                    <option value="1">Personal</option>

                                                </select>
                                                <!--<input name="keyownerr" placeholder="" value=""  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                        

                                    </tr> 
                                   <tr>
                                         
                                            <td style="width:100%">
                                                <?php
                                            $mimi=$_SESSION["emp_file_no"];                                           
                                            $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                                                ?>
                                                <input name="open_by" placeholder="" value="<?php echo $mimi; ?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                                                <select class="form-control amount editable"  aria-describedby="sizing-addon1" name="keyowner">
                                                   <?php
                                                                                                   while ($b = mysql_fetch_array($a)){
$first_name = $b['first_name'];
$surname = $b['surname'];
$employee_code=$b['emp_file_no'];
                                                   ?>
                                                    <option value="<?php echo $employee_code;?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>
                                                    <?php
                                                      }
                                                    ?>
                                                </select>
                                                <!--<input name="keyownerr" placeholder="" value=""  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                        

                                    </tr> 
                                    
                                </tbody>
                            </table>
                        </div>

                       

                        <div class="col-lg-12">


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
                                            <input name="text" required=""  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:24%">
                                            <input name="action[]"  required="" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:24%">
                                            <input name="requirement[]" required="" id="pric"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <select class="form-control" required="" name="respons[]" id="fs">
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
                                            <input name="startdate[]" required=""  class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="date">

                                        </td>
                                        <td style="width:8%">
                                            <input name="enddate[]" required=""   class="form-control amount editable" placeholder="dd.mm.yyyy"  aria-describedby="sizing-addon1" type="date">

                                        </td>
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:30%">
                                            <input name="action[]" required=""  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:24%">
                                            <input name="requirement[]" required="" id="pric"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <select class="form-control" required="" name="respons[]" id="fs">
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
                                            <input name="startdate[]"  class="form-control amount editable" placeholder="mm/dd/yyyy"  aria-describedby="sizing-addon1" type="date">

                                        </td>
                                        <td style="width:8%">
                                            <input name="enddate[]"  class="form-control amount editable" placeholder="mm/dd/yyyy"  aria-describedby="sizing-addon1" type="date">

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
        </div>
    </div>
</div>