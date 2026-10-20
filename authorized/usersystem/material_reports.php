<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
ob_start();
@session_start();
$message = '';
if (!isset($_SESSION["emp_file_no"])) {
    header("location:index.php");
}

/////////////////Print Report ya vehicle///////////////////////////////  
$ids = $_SESSION["emp_file_no"];
$cashlist = mysql_query("SELECT * FROM tbl_request_spare ORDER BY request_date") or die(mysql_error());
while ($roww = mysql_fetch_array($cashlist)) {
    $requester = $roww['requester'];
    $request_id = $roww['request_id'];
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $request_id);

    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    $jinalako = $jstt['first_name'] . ' ' . $jstt['surname'];
    $data[] = array(
        'Request ID' => $identificationnumber,
        'Requested by' => $jinalako,
        'Request For' => $roww['Request_title'],
        'Request Date' => $roww['request_date'],
        'Store Status' => $roww['store_status'],
        'HOD Status' => $roww['hod_status']
    );
}
if (isset($_POST["ExportType"])) {

    switch ($_POST["ExportType"]) {
        case "export-to-excel" :
            // Submission from
            $filename = $_POST["ExportType"] . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            ExportFile($data);
            //$_POST["ExportType"] = '';
            exit();
        default :
            die("Unknown action : " . $_POST["action"]);
            break;
    }
}

function ExportFile($records) {
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                // display field/column names as a first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    exit;
}
?>

<head>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="print">
    <link href="../../assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet" media="print">
    <link href="../../assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" media="print">
    <link href="../../font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="../../Chart.js"></script>
    <script src="../../js/jquery/jquery.min.js"></script>                    
    <link href="../../datable/jquery.dataTables.css" rel="stylesheet">
    <script src="../../datable/jquery.dataTables.js"></script>     
    <link href="../../js/bootstrap.min.css" rel="stylesheet">  

    <script src="../../js/bootstrap.min.js"></script>        
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


</head>     




<div class=" container-fluid">
    <div class="row noprint">
        <div class="col-lg-12">                                  
            <div class="pull-right">
                <ul class="pagination" id="export-menu">
                    <li id="export-to-excel">
                        <a href="#" class="btn btn-default"><i class="fa fa-file-excel-o fg-green"></i>&nbsp;Download Excel </a>
                    </li>
                    <li >
                        <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i>&nbsp;Print PDF</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:15%">

                <label for="dtp_input2" class="control-label">From</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd.mm.yy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
           
                                           
                                        </td>
                                         <td style="width:15%">

                <label for="dtp_input2" class="control-label">To</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd.mm.yy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
           
                                           
                                        </td>
                                        <td style="width:15%">
                             <label for="sel1">Store Status:</label>
                                                <select class="form-control" id="sel1" name="hod_sel">
                                                    <option value="">Select HOD</option>
                                                </select>
                                        </td>
                                        <td style="width:15%">
                                            <label for="sel1">HOD Status:</label>
                                                <select class="form-control" id="sel1" name="hod_sel">
                                                    <option value="">Select HOD</option>
                                                </select>
                                        </td>
                                         <td style="width:40%">
                                             <label for="sel1">Request Title:</label>
                                                <input name="req_title" placeholder="This field is Mandatory"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                           
                                        </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
             
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="export-form">
                <input type="hidden" value='' id='hidden-type' name='ExportType'/>
            </form>
            <table class="table table-striped" id="report" style="font-size: 14px;">
                <thead>
                    <tr>                                        
                        <th class="text-left">Request ID</th> 
                        <th class="text-left">Requested by</th>                                        
                        <th class="text-left">Request For</th>
                        <th class="text-left">Request Date</th>                                       
                        <th class="text-left">Store Status</th>
                        <th class="text-left">HOD Status</th>
                    </tr>
                </thead>

                <tbody>


                    <!--//////////////End of Report vehicle//////////////////////////////////////-->
<?php foreach ($data as $row): ?>
                        <tr>                                           
                            <td class="right"><?php echo $row['Request ID']; ?></td>
                            <td class="right"><?php echo $row['Requested by']; ?></td> 
                            <td class="right"><?php echo $row['Request For']; ?></td>
                            <td class="right"><?php echo $row['Request Date']; ?></td>                                  
                            <td class="right"><?php echo $row['Store Status']; ?></td>
                            <td class="right"><?php echo $row['HOD Status']; ?></td>


                        </tr> 
<?php endforeach; ?>
                </tbody>

                <script  type="text/javascript">
                    $(document).ready(function () {
                        jQuery('#export-menu li').bind("click", function () {
                            var target = $(this).attr('id');
                            switch (target) {
                                case 'export-to-excel' :
                                    $('#hidden-type').val(target);
                                    //alert($('#hidden-type').val());
                                    $('#export-form').submit();
                                    $('#hidden-type').val('');
                                    break
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function () {
                        $('#report').DataTable();
                    });
                </script>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.error').delay(5000).fadeOut('normal');
                        $('.success').delay(4000).fadeOut('normal');
                    });
                </script>

                <style type="text/css">

                    @media print
                    {    
                        .noprint, .bottom-menu-wrapper,.menusss *
                        {
                            display: none !important;
                        }
                    }


                </style>

            </table>
        </div>
    </div>

</div>

<script type="text/javascript" src="bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                language: '',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
</script>