<!--<head>
    <script type="text/javascript">  
        $(document).ready(function (e) {
             $("#uploadeducation"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/add_attendence.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#notifing").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            
            
            
        });
    </script>
</head>-->
<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['maisha'])){
if(!empty($_POST['timein'])  ){
    $emp_file_no = $_POST['emp_file_no'];
    $current_date = $_POST['cdate'];
    $time_cof = "08";
    $timein = $_POST['timein'];
    $timeout = $_POST['timeout'];
    $checkTime = strtotime($timein);
$loginTime = strtotime($timeout);
$diff = $loginTime-$checkTime;
$result['s'] = $diff;
 $timespent=gmdate("H:i", (int)$result['s']);
 $mudauliopangwa="08:05";

    $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $row= mysql_num_rows($ss);
    if($row!=0){

    if ($mudauliopangwa >= $timein) {
        $class = "bg-green";
        $status = "NO";
    }  
    else {
        $class = "bg-red";
        $status = "YES";
    }

    $upload = "INSERT INTO tbl_attendence(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification)"
            . " values('$emp_file_no','$timein','$timeout','$time_cof','$current_date','$timespent','$status','$class')";
    $updatee = mysql_query($upload) or die(mysql_error());
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
    }
//}  else {
//    echo '<div class="alert alert-danger fade in error">
//    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
//    <strong>Error!Employee ID,Time in and Time Out Must Be Filled Out</strong> 
//</div>'; 
//}
    else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!No Employee With Employee Id:'.$emp_file_no .'</strong> 
</div>';
}
}
else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!Employee ID,Time in and Time Out Must Be Filled Out</strong> 
</div>'; 
}
}

if (isset($_POST['excel'])) {
    require_once 'Classes/PHPExcel/IOFactory.php';
    $inputFileType = "Excel5";
    $target_file =$_FILES["file"]["name"];
    $inputFileName = $_FILES['file']['tmp_name'];    
       $extension=explode(".", $target_file);
       $name=$extension[1];
      if($name=="xls"){
          

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($inputFileName);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true); //HIZNI COLUMN

    $counter = count($sheetData);
	$year = $sheetData[1]['C']; 

    for ($i = 3; $i <= $counter; $i++) {//TUNAANZA NA ROW YA PILI KUCHUKUA DATA ZETU
        $emp_file_no = $tin = $tout ="";
        $emp_file_no = $sheetData[$i]['A'];
        $tin = $sheetData[$i]['B'];
        $tout = $sheetData[$i]['C'];
       
        $time_cof = "08";
        $kawaida = '08:10';
        //
        $muda1 = explode(":", $kawaida);
        $k1 = $muda1[0];
        $k2 = $muda1[1];

        //
        $time1in = explode(" ", $tin);
        $t1in = $time1in[0];
        $t2in = $time1in[1];
        $timein = $t1in . ":" . $t2in;

        //
        $timeout = explode(" ", $tout);
        $t1out = $timeout[0];
        $t2out = $timeout[1];
        $timeout = $t1out . ":" . $t2out;
        
        //
        $timedefault = '00:00';
        $time_of_entry = '07:59';
        $time1 = new DateTime($timein);
        $time2 = new DateTime($timeout);
        $timeof_entry = new DateTime($time_of_entry);
        $time_zero = new DateTime($timedefault);
        $kawaidamuda = new DateTime($kawaida);
        $yupokawaida = $kawaidamuda->diff($time_zero);
        $ontime = (int) $yupokawaida->format('%H%i');
        $entry_time = $timeof_entry->diff($time_zero);
        $mudauliopangwa = (int) $entry_time->format('%H%i');
        $badilimudaalioingia = $time1->diff($time_zero);
        $mudaaliongia = (int) $badilimudaalioingia->format('%H%i');
        $time_spent = $time2->diff($time1);
        $timespent = $time_spent->format('%H:%i');
        $interv=  explode(":",$timespent);
        $tw=$interv[0]-1;
        $tz=$interv[1];
        $sm=$tw.":".$tz;
//        $timee = new DateTime($val);
//         $tumiakutoa=$timespent->diff($timee);
         
         
//
//        /////////////////////
        if ($k1 < $t1in) {
            $class = "bg-red";
            $status = "Yes";
        } elseif ($mudauliopangwa > $mudaaliongia) {
            $class = "bg-green";
            $status = "No";
        } elseif ($mudaaliongia > $mudauliopangwa && $mudaaliongia <= $ontime) {
            $class = "";
            $status = "No";
        } else {
            $class = "bg-red";
            $status = "YES";
        }
       
///////////////////////////////
        if (!empty($timein) && !empty($timeout) && !empty($emp_file_no) && !empty($year)) {
            $upload = "INSERT INTO tbl_attendence"
                    . "(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification)"
                    . " values('$emp_file_no','$timein','$timeout','$time_cof','$year','$sm','$status','$class')";
            $updatee = mysql_query($upload) or die(mysql_error());
        }
    }

    if (!empty($timein) && !empty($timeout) && !empty($emp_file_no) && !empty($year)) {
        echo'<div class="shadow success" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
        echo'<center>Data Successful Submitted.....!</center>';
        echo'</div>';
    } else {
        echo'<div class="shadow error" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
        echo'<center>Error occur during uploadng.....!</center>';
        echo'</div>';
    }
      }  else {
          echo 'FORMAT NOT SUPPORTED';
      }
      
}
?>

<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="attendence"><i  class="icon-meter-medium fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattendence"><i class=" icon-plus-2"></i>&nbsp;Add attendance</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalexcell" ><i class="icon-file-excel fg-green"></i>&nbsp;Import  attendance(batch file)</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalpayroll"><i class="icon-diary fg-green"></i>&nbsp;Attendance Report</a>
            </li>
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Employee ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Time in</th>
                <th class="text-left">Time out</th>
                <th class="text-left">Date</th>
                <th class="text-left">Total hours</th>                                                 
                <th class="text-left">Required hours</th>
                <th class="text-left">Late Comer</th>


            </tr>
        </thead>

        <tbody>
<?php
$tbl_attendence = mysql_query("SELECT * FROM tbl_attendence ORDER BY attendence_id ASC")or die(mysql_error());
while ($row = mysql_fetch_array($tbl_attendence)) {
    $time_in = $row['time_in'];
    $time_out = $row['time_out'];
    $time_set = $row['time_set'];
    $date1 = $row['date1'];
    $time_spend = $row['time_spend'];
    $time_set = "08:00";
    $remark = $row['remark'];
    $notification = $row['notification'];
    $emp_file_no = $row['emp_file_no'];
    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
    ?>
                <tr class="<?php echo $notification; ?>">
                    <td><?php echo $emp_file_no; ?></td>
                    <td class="right"><?php echo $fullname; ?></td>
                    <td class="right"><?php echo $time_in; ?></td>
                    <td class="right"><?php echo $time_out; ?></td>
                    <td class="right"><?php echo $date1; ?></td>                   
                    <td class="right"><?php echo $time_spend ?></td>
                    <td class="right"><?php echo $time_set; ?></td>
                    <td class="right"><?php echo $remark; ?></td>

                </tr> 
<?php } ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div id="myModalattendence" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Attendance</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form id="uploadeducation" action="" method="post">                            
                            <div class="form-group">
                                <label for="education">Employee ID:</label>
                                <input type="text" class="form-control" id="education" name="emp_file_no">
                            </div>
                             <div class="form-group">
                                <label for="education">Date:</label>
                                    <div class="input-control text" data-role="datepicker" data-week-start="1">
                                                <input readonly="readonly" name="cdate" id="cdate"  type="text" class="form-control">
                                                <button type="button" class="btn-date"></button>
                                                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                                </div>
                                            </div>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                         <label for="education">Time In:</label>
                                          <input type="text" class="form-control" id="education" name="timein">
                                    </td>
                                    <td>
                                         <label for="education">Time Out:</label>
                                <input type="text" class="form-control" id="education" name="timeout">
                                    </td>
                                </tr>
                            </table>
                            <input type="submit"  value="Submit Data"  name="maisha" />    
                            
                        </form>
                        <div id="delete">
                           
                        </div>
                        <div class="" id="notifing">
<!--                            onyesha data-->
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModalexcell" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Attendance Using Excel Sheet</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form  action="" method="Post" enctype="multipart/form-data">                            
                               <div class="input-control file">
        <input type="file" name="file" />
        <button class="btn-file"></button>
    </div>                          
                            <input type="submit" name="excel"  value="Submit Data"/>    
                            
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>