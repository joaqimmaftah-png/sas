<script>
    $(function () {
        $("#wth_excell").on('click', function () {
            $.Dialog({
                shadow: true,
                overlay: false,
                draggable: true,
                icon: '<span class="icon-user"></span>',
                title: 'Draggable window',
                width: 700,
                padding: 10,
                content: 'ADD ATTENDANCE.',
                onShow: function () {
                    var content = ' <form method="post" action="?action=add_attendant">' +
                            '<div class="grid">' +
                            // start
                            '<div class="row">' +
                            ' <div class="span8">' +
                            '<div class="span2 text-right">' +
                            '<label>Employee ID:</label>' +
                            '</div>' +
                            '<div class = "span2">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text"  name = "emp_file">' +
                            ' <button type = "button" class = "btn-clear" tabindex = "-1" > </button>' +
                            '</div>' +
                            '</div> ' +
                            '<div class="span2 text-right">' +
                            '<label>Current Date:</label>' +
                            '</div>' +
                            '<div class = "span2">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "11.06.2015" type = "text" name = "cdate">' +
                            '<button type = "button" class = "btn-clear" tabindex = "-1"> </button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
//                            end 
                            // start
                            '<div class="row">' +
                            ' <div class="span8">' +
                            '<div class="span2 text-right">' +
                            '<label>Time In:</label>' +
                            '</div>' +
                            '<div class = "span2">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text"  name = "timein">' +
                            ' <button type = "button" class = "btn-clear" tabindex = "-1" > </button>' +
                            '</div>' +
                            '</div> ' +
                            '<div class="span2 text-right">' +
                            '<label>Time Out:</label>' +
                            '</div>' +
                            '<div class = "span2">' +
                            '<div class = "input-control text" data - role = "input-control">' +
                            '<input placeholder = "" type = "text" name = "timeout">' +
                            '<button type = "button" class = "btn-clear" tabindex = "-1"> </button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
//                            end 
                            '<div class="row">' +
                            '<div class="span3">' +
                            '<label></label>' +
                            '</div>' +
                            '<div class="form-actions">' +
                            '<button class="button primary" name="add_attendant">import</button>&nbsp;' +
                            '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                            '</div>' +
                            '</div>' +
//                            end grid
                            '</div>' +
                            '</div>' +
                            '</form>';

                    $.Dialog.title("IMPORT ATTENDANCE.");
                    $.Dialog.content(content);
                }

            });
        });
//        mwisho
        $("#excell").on('click', function () {
            $.Dialog({
                shadow: true,
                overlay: false,
                draggable: true,
                icon: '<span class="icon-file-excel"></span>',
                title: 'Draggable window',
                width: 500,
                padding: 10,
                content: 'This Window is draggable by caption.',
                onShow: function () {
                    var content = '<form class="form elements"  method="post" action="?action=add_attendant" enctype="multipart/form-data">' +
                            '<div class="input-control file">' +
                            '<input type="file"  name="file" />' +
                            '<button class="btn-file"></button>' +
                            '</div>' +
                            '<input name="excell" type="submit" value="submit" />' +
                            '</form>';

                    $.Dialog.title("upload excell file");
                    $.Dialog.content(content);
                }
            });
        });
// mwisho
        $("#attendance_report").on('click', function () {
            $.Dialog({
                shadow: true,
                overlay: false,
                draggable: true,
                icon: '<span class="icon-book"></span>',
                title: 'Draggable window',
                width: 400,
                padding: 10,
                content: 'This Window is draggable by caption.',
                onShow: function () {
                    var content = '<div class="span7">' +
                            ' <div class="listview small">' +
                            '<a href="?action=attendance_report" class="list bg-lightBlue fg-white">' +
                            ' <div class="list-content">' +
                            '<img src="images/excel2013icon.png" class="icon">' +
                            '<div class="data">' +
                            '<span class="list-title">Weeks</span>' +
                            '<div class="rating small no-margin fg-yellow" data-score="4" data-role="rating" data-stars="5"><ul style="margin-bottom: 0px;"><li class="rated"></li><li class="rated"></li><li class="rated"></li><li class="rated"></li><li></li></ul></div>' +
                            '</div>' +
                            '</div>' +
                            ' </a>' +
                            '<a href="#" class="list shadow">' +
                            '<div class="list-content">' +
                            '<img src="images/excel2013icon.png" class="icon">' +
                            '<div class="data">' +
                            '<span class="list-title">Months</span>' +
                            '<div class="rating small no-margin" data-role="rating" data-stars="5"><ul style="margin-bottom: 0px;"><li></li><li></li><li></li><li></li><li></li></ul></div>' +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            '<a href="#" class="list shadow">' +
                            '<div class="list-content">' +
                            '<img src="images/excel2013icon.png" class="icon">' +
                            '<div class="data">' +
                            '<span class="list-title">Years</span>' +
                            '<div class="rating small no-margin" data-role="rating" data-stars="5"><ul style="margin-bottom: 0px;"><li></li><li></li><li></li><li></li><li></li></ul></div>' +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            ' </div>' +
                            '</div>' +
                            '</form>';

                    $.Dialog.title("SELECT REPORT");
                    $.Dialog.content(content);
                }
            });
        });
//mwisho
    })
</script>
<?php
require_once __DIR__ . '/mysql_compat.php';

if (isset($_POST['add_attendant'])) {
    $emp_file_no = $_POST['emp_file'];
    $current_date = $_POST['cdate'];
    $time_cof = "09";
    $timein = $_POST['timein'];
    $timeout = $_POST['timeout'];
    $timedefault = '00:00';
    $time_of_entry = '07:59';
    $kawaida = '08:30';
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


    if ($mudauliopangwa > $mudaaliongia) {
        $class = "bg-green";
        $status = "high performed";
    } elseif ($mudaaliongia > $mudauliopangwa && $mudaaliongia <= $ontime) {
        $class = "";
        $status = "on time";
    } else {
        $class = "bg-red";
        $status = "later comer";
    }

    $upload = "INSERT INTO tbl_attendence(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification) values('$emp_file_no','$timein','$timeout','$time_cof','$current_date','$timespent','$status','$class')";
    $updatee = mysql_query($upload) or die(mysql_error());
}

if (isset($_POST['excell'])) {
    require_once 'Classes/PHPExcel/IOFactory.php';
    $inputFileType = 'Excel5';
    $inputFileName = $_FILES['file']['tmp_name'];
//	$subject_id = $_POST['sid'];

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($inputFileName);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true, true); //HIZNI COLUMN

    $counter = count($sheetData);
//	$year = $sheetData[2]['B']; 

    for ($i = 2; $i <= $counter; $i++) {//TUNAANZA NA ROW YA PILI KUCHUKUA DATA ZETU
        $emp_file_no = $tin = $tout = $date1 = "";
        $emp_file_no = $sheetData[$i]['A'];
        $tin = $sheetData[$i]['C'];
        $tout = $sheetData[$i]['D'];
        $date1 = $sheetData[$i]['B'];
        $time_cof = "09";
        $kawaida = '08:30';
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

        /////////////////////
        if ($k1 < $t1in) {
            $class = "bg-red";
            $status = "later comer";
        } elseif ($mudauliopangwa > $mudaaliongia) {
            $class = "bg-green";
            $status = "high performed";
        } elseif ($mudaaliongia > $mudauliopangwa && $mudaaliongia <= $ontime) {
            $class = "";
            $status = "on time";
        } else {
            $class = "bg-red";
            $status = "later comer";
        }
/////////////////////////////
        if (!empty($timein) && !empty($timeout) && !empty($emp_file_no) && !empty($date1)) {
            $upload = "INSERT INTO tbl_attendence"
                    . "(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification)"
                    . " values('$emp_file_no','$timein','$timeout','$time_cof','$date1','$timespent','$status','$class')";
            $updatee = mysql_query($upload) or die(mysql_error());
        }
    }

    if (!empty($timein) && !empty($timeout) && !empty($emp_file_no) && !empty($date1)) {
        echo'<div class="shadow success" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
        echo'<center>DATA SUCCESSFUL SUBMITED.....!</center>';
        echo'</div>';
    } else {
        echo'<div class="shadow error" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
        echo'<center>error occur during uploadng.....!</center>';
        echo'</div>';
    }
}
?>

<div class="shadow" style="height: 38px; width: 100%; background-color: #60A917; border:1px #60A917 solid; color:white;">
    <nav class="breadcrumbs">
        <ul>
            <li><a href="?action=attendence"><i class="icon-home"></i>Home</a></li>
            <li><a href="#" id="excell"><i class="icon-file-excel fg-green"></i>&nbsp;Import  attendance(batch file)</a></li>
            <li><a href="#" id="wth_excell"><i class="icon-user"></i>&nbsp;Add attendance</a></li>
            <li><a href="#" id="attendance_report"><i class="icon-file-excel fg-green"></i>&nbsp;Attendance Report</a></li>           
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
                <th class="text-left">Status</th>


            </tr>
        </thead>

        <tbody>
<?php
$tbl_attendence = mysql_query("SELECT * FROM tbl_attendence")or die(mysql_error());
while ($row = mysql_fetch_array($tbl_attendence)) {
    $time_in = $row['time_in'];
    $time_out = $row['time_out'];
    $time_set = $row['time_set'];
    $date1 = $row['date1'];
    $time_spend = $row['time_spend'];
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
                    <td class="right"><?php echo $time_spend; ?></td>
                    <td class="right"><?php echo $remark; ?></td>

                </tr> 
<?php } ?>
        </tbody>
    </table>
</div>

