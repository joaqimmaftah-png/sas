<?php
error_reporting(E_ALL & ~E_NOTICE);
$message='';
$ref='';
if (isset($_POST['reg_rca'])) {
    $alarm_date=$_POST['alarm_date'];
$alarm_time=$_POST['alarm_time'];
$time_report=$_POST['time_report'];
$date_report=$_POST['date_report'];
$falarm=$_POST['falarm'];
    if(!empty($alarm_date) AND !empty($alarm_time) AND !empty($time_report) AND !empty($date_report) AND !empty($falarm)){
$noc_operator = $_SESSION["emp_file_no"];
$remarks=$_POST['remarks'];
$ttstatus=$_POST['ttstatus'];
$ttclosedd=$_POST['ttclosedd'];
$sincrorefn=$_POST['sincrorefn'];
$tgrefno=$_POST['tgrefno'];
$fresolution=$_POST['fresolution'];
$rcause=$_POST['rcause'];
$pcause=$_POST['pcause'];
$falarm=$_POST['falarm'];
$dcdowntime=$_POST['dcdowntime'];
$acdtime=$_POST['acdtime'];
$ctime=$_POST['ctime'];
$fcdate=$_POST['fcdate'];
$tout=$_POST['tout'];
$tin=$_POST['tin'];
$time_report=$_POST['time_report'];
$date_report=$_POST['date_report'];
$oost=$_POST['oost'];
$oosd=$_POST['oosd'];
$alarm_date=$_POST['alarm_date'];
$alarm_time=$_POST['alarm_time'];
$phone1=$_POST['phone1'];
$phone2=$_POST['phone2'];
$siteid=$_POST['siteid'];
$checkdate = date("Ymd", strtotime($date_report));


$a=  mysql_query("INSERT INTO `tbl_rca`(`site_id`, `noc_operator`, `alarm_date`, `alarm_time`, `oos_date`, `oos_time`, `date_reported`, `time_reported`, `time_in`, `time_out`, `fault_clear_date`, `clear_time`, `ac_down_time`, `dc_down_time`, `faults_alarm`, `primary_cause`, `route_cause`, `faults_resolution`, `tt_status`, `tt_closed_by`, `remarks`, `tigo_reference`, `sincro_reference`,date_report_format)"
        . " VALUES ('$siteid','$noc_operator','$alarm_date','$alarm_time','$oosd','$oost','$date_report','$time_report','$tin','$tout','$fcdate','$ctime','$acdtime','$dcdowntime','$falarm','$pcause','$rcause','$fresolution','$ttstatus','$ttclosedd','$remarks','$tgrefno','$sincrorefn','$checkdate')") or die(mysql_error());

if($a){
    $ref=$sincrorefn;
    $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification').modal('show');
            });
        </script>";
}
 else {
    
}
}
 else {
    $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification2').modal('show');
            });
        </script>";
}
}


if(isset($_POST['update_rca'])){
  $noc_operator = $_SESSION["emp_file_no"];
$remarks=$_POST['remarks'];
$ttstatus=$_POST['ttstatus'];
$fresolution=$_POST['fresolution'];
$rcause=$_POST['rcause'];
$pcause=$_POST['pcause'];
$ctime=$_POST['ctime'];
$fcdate=$_POST['fcdate'];
$tout=$_POST['tout'];
$tin=$_POST['tin'];
$rca_id=$_POST['rca_id']; 
$sincrorefn=$_POST['sincrorefn'];
$oost=$_POST['oost'];
$oosd=$_POST['oosd'];
$d1=date("d-m-Y",strtotime($fcdate));
$d2=date("d-m-Y",strtotime($oosd));
$t1 = strtotime($oost);
$ms=  explode(":",$ctime);
$we=$ms[0];
$we1=$ms[1];


if($we=='00' AND $we1=='00'){
              $dd= new DateTime($d1.' '.$ctime); 
$dd2= new DateTime($d2.' '.$oost);

$interval= $dd->diff($dd2);
$dcdowntime= ($interval->days * 24) + $interval->h.':'.$interval->i;

  


    $gd=  mysql_query("UPDATE `tbl_rca` SET `time_in`='$tin',`time_out`='$tout',`fault_clear_date`='$fcdate',`clear_time`='$ctime',`ac_down_time`='$acdtime',`dc_down_time`='$dcdowntime',`primary_cause`='$pcause',`route_cause`='$rcause',`faults_resolution`='$fresolution',`tt_status`='$ttstatus',`tt_closed_by`='$noc_operator',`remarks`='$remarks' WHERE `rcs_id`='$rca_id'") or die(mysql_error());
 if($gd){     
     $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#updatenotification').modal('show');
            });
        </script>";
 } 
}
 else {
   $wt=(int)$we; 
   $wts=(int)$we1;
     if($wt==0 AND $wts==0){
                  
$dcdowntime= $we;
    $gd=  mysql_query("UPDATE `tbl_rca` SET `time_in`='$tin',`time_out`='$tout',`fault_clear_date`='$fcdate',`clear_time`='$ctime',`ac_down_time`='$acdtime',`dc_down_time`='$dcdowntime',`primary_cause`='$pcause',`route_cause`='$rcause',`faults_resolution`='$fresolution',`tt_status`='$ttstatus',`tt_closed_by`='$noc_operator',`remarks`='$remarks' WHERE `rcs_id`='$rca_id'") or die(mysql_error());
 if($gd){     
     $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#updatenotification').modal('show');
            });
        </script>";
 } 
     }
 else {
          $dd= new DateTime($d1.' '.$ctime); 
$dd2= new DateTime($d2.' '.$oost);

$interval= $dd->diff($dd2);
$dcdowntime= ($interval->days * 24) + $interval->h.':'.$interval->i;

  


    $gd=  mysql_query("UPDATE `tbl_rca` SET `time_in`='$tin',`time_out`='$tout',`fault_clear_date`='$fcdate',`clear_time`='$ctime',`ac_down_time`='$acdtime',`dc_down_time`='$dcdowntime',`primary_cause`='$pcause',`route_cause`='$rcause',`faults_resolution`='$fresolution',`tt_status`='$ttstatus',`tt_closed_by`='$noc_operator',`remarks`='$remarks' WHERE `rcs_id`='$rca_id'") or die(mysql_error());
 if($gd){     
     $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#updatenotification').modal('show');
            });
        </script>";
 }   
    
    
    
    
}
 }
}


?>




<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/RCA/load_pm.php";
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'link'},
                            {name: 'site_id'},
                            {name: 'site_name'},
                            {name: 'ward'},
                            {name: 'district'},
                            {name: 'region'},
                            {name: 'noc_operator'},
                            {name: 'field_supervisor'},
                            {name: 'tech_name'},
                            {name: 'tech_phone'},
                            {name: 'activity_date'},
                            {name: 'time_in'},
                            {name: 'opening_ticket'},
                            {name: 'time_out'},
                            {name: 'closing_ticket'},                           
                            {name: 'access_type'},
                            {name: 'Remarks'}
                        ],
                        id: 'id',
                        url: url,
                        root: 'data' 
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
                    {
                        width: '100%',
                        height: 551,
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
               
                        columns: [
                            {text: '', datafield: 'link', width: 50},
                            {text: 'SITE ID', datafield: 'site_id', width: 100},
                            {text: 'SITE NAME', datafield: 'site_name', width: 100},
                            {text: 'WARD', datafield: 'ward', width: 100},
                            {text: 'DISTRICT', datafield: 'district', width: 100},
                            {text: 'REGION', datafield: 'region', width: 100},
                            {text: 'FIELD SUPERVISOR', datafield: 'field_supervisor', width: 100},
                            {text: 'TECH NAME', datafield: 'tech_name', width: 100},
                            {text: 'TECH PHONE', datafield: 'tech_phone', width: 100},
                            {text: 'NOC OPERATOR', datafield: 'noc_operator', width: 100},
                            {text: 'ACTIVITY DATE', datafield: 'activity_date', width: 100},
                            {text: 'TIME IN', datafield: 'time_in', width: 100},
                            {text: 'OPENING TICKET', datafield: 'opening_ticket', width: 100},
                            {text: 'TIME OUT', datafield: 'time_out', width: 100},
                            {text: 'CLOSING TICKET', datafield: 'closing_ticket', width: 100},                           
                            {text: 'ACCESS TYPE', datafield: 'access_type', width: 100},
                            {text: 'REMARKS', datafield: 'Remarks', width: 100}
                        ],
                        
                    });         
        });
        
        
        
    </script>
    <script>
        function findata(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/RCA/search.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>
<div class="row">
    <div class="col-lg-12">
       <?php
       echo $message;
       ?> 
    </div>
<div class="col-lg-12"> 
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-plus"></i>&nbsp;Add PM</button>
      <br><br>
            </div>
</div>
<div class="row" >


    <div class="col-lg-12">
        <div id="jqxgrid" >
        </div>
    </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New RCA</h4>
            </div>
            <div class="modal-body">
                <!--maaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->
                <div class="container-fluid">

                    <div class="row">
                        <?php
                        $emp_file_no1 = $_SESSION["emp_file_no"];
                        $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$emp_file_no1'") or die(mysql_error());
                        $rows = mysql_fetch_array($tbl_customer);
                        $first_name = $rows['first_name'];
                        $surname = $rows['surname'];
                        $field_supervisor = $first_name . " " . $surname;
                        ?>
                        <div class="col-lg-6">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">NOC Operator:</span></span>
                                <input name="noc_operator" id="product_name" class="form-control editable" placeholder="" value="<?php echo $emp_file_no1; ?>" aria-describedby="sizing-addon1" type="hidden">
                                <input name="noc_operator" id="product_name" class="form-control editable" placeholder="" value="<?php echo $field_supervisor; ?>" aria-describedby="sizing-addon1" disabled="" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="search" method="post" action="">
                                <input type="search" name="q"  onkeyup="findata(this.value)" value="" placeholder="Search by id" autocomplete="off">
                                <ul class="search-ac" id="action">       
                                </ul>

                            </form> 

                        </div>
                    </div>
                    <form action="" method="POST">
 
                        <div class="row" id="show_rca">

                            <input name="noc_operator" id="product_name" class="form-control editable" placeholder="" value="<?php echo $emp_file_no1; ?>" aria-describedby="sizing-addon1" type="hidden">


                            <!--kkkkkkkkkkkkkkkkkkkkkkk-->
                        </div>

                    </form>

                </div>

                <!--msssssssssdjsjsjjsjjjjjjjjjjjjjjj-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Thanks!</strong> RCA with Sincro Reference No. <strong><?php echo $ref;?></strong> Successful Inserted. 
</div>

  </div>
</div>
<div id="updatenotification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Thanks!</strong> RCA with Sincro Reference No. <strong><?php echo $sincrorefn;?></strong> Successful Updated. 
</div>

  </div>
</div>
<div id="notification2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Error!&nbsp;alarm date,alarm time,report time,report date and faulty alarm</strong> can't be empty 
</div>

  </div>
</div>


<!-- Modal -->
<div id="editrca" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<?php
$emp_file_no1 = $_SESSION["emp_file_no"];
$tbl_uo = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$emp_file_no1'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_uo);
                $f1 = $re['first_name'];
                $s1 = $re['surname'];
                $noc_operator=$f1." ".$s1;
?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update RCA</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                  <form  action="" method="POST">
                 <!--////////////////////////////////////////////////////////////////////////////////////////-->
                 <div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Site ID:</span></span>
        <input name="rca_id" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="hidden">
        <input name="siteid" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Site Name:</span></span>
        <input name="sitename" id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Ward:</span></span>
        <input name="ward" id="d" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">District:</span></span>
        <input name="district" id="e" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Region:</span></span>
        <input name="region" id="f" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Supervisor:</span></span>
        <input name="supervisor" id="h" class="form-control editable" placeholder="" value=""  aria-describedby="sizing-addon1" type="hidden">
        <input name="supervisorr" id="g" class="form-control editable" placeholder="" value="" disabled="" aria-describedby="sizing-addon1" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Technician Name:</span></span>
        <input name="tech_name" id="i" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="hidden">
        <input name="tech_namee" id="j" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Technician Number:</span></span>
        <input name="phone1" id="k" class="form-control editable" placeholder="" value="<?php echo $phone; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Supervisor Number:</span></span>
        <input name="phone2" id="l" class="form-control editable" placeholder="" value="<?php echo $phone; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Alarm Time:</span></span>
        <input name="alarm_date" id="m" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Alarm Date:</span></span>
        <input name="alarm_time" id="n" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">OOS Date:</span></span>
        <input name="oosdd" id="o" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">
        <input name="oosd" id="o" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1"  type="hidden">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">OOS Time:</span></span>
        <input name="oostt" id="p" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">
        <input name="oost" id="p" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1"  type="hidden">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Date Reported:</span></span>
        <input name="date_report" id="q" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time Reported:</span></span>
        <input name="time_report" id="r" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time In:</span></span>
        <input name="tin" id="s" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time Out:</span></span>
        <input name="tout" id="t" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Clear Date:</span></span>
        <input name="fcdate" id="u" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Clear Time:</span></span>
        <input name="ctime" id="v" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">AC Downtime:</span></span>
        <input name="acdtime" id="w" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">DC Downtime:</span></span>
        <input name="dcdowntime" id="x" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Alarm:</span></span>
        <input name="falarm" id="y" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Primary Cause:</span></span>
        <input name="pcause" id="z" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Root Cause:</span></span>
        <input name="rcause" id="aa" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Resolution:</span></span>
        <input name="fresolution" id="ab" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Tigo Ref No:</span></span>
        <input name="tgrefno" id="ac" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Sincro Ref No:</span></span>
        <input name="sincrorefn" id="ad" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="hidden">
        <input name="sincrorefnv" id="ad" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">TT Closed By:</span></span>
        <input name="ttclosed" id="" class="form-control editable" placeholder="" value="<?php echo $emp_file_no1; ?>" aria-describedby="sizing-addon1" type="hidden">
        <input name="ttclosedd" id="" class="form-control editable" placeholder="" value="<?php echo $noc_operator; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
<!--        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">TT Status:</span></span>
        <input name="ttstatus" id="af" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">-->
<div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                                                        <select class="form-control" id="af" name="ttstatus">
                                                            <option value=""><span id="sn"></span></option>                                       
                                                            <option value="closed">closed</option>
                                                            <option value="open">open</option>

                                                        </select>
                                                    </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Remarks:</span></span>
        <input name="remarks" id="ag" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-12">
    <button type="submit" class="btn btn-success" name="update_rca" style="color:white"><i class="glyphicon glyphicon-plus"></i>Submit  Changes</button>
</div>
                 <!--//////////////////////////////////////////////////////////////////////////////////////////-->
             </form>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

