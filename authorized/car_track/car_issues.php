<?php
if(isset($_POST['register_car_issue'])){
    include_once 'db.php';
    $faultsdescr=$_POST['faultsdescr'];
    $datefaults=$_POST['datefaults'];
    $operationcond=$_POST['operationcond'];
    $planresolution=$_POST['planresolution'];
    $reasons=ucwords($_POST['reasons']);
    $car_reg_num=$_POST['car_reg_num'];
    $status="Open";
    $reportdate = date("Ymd", strtotime($datefaults));
    $reportplanresoln = date("Ymd", strtotime($planresolution));
   
    $insert_faults=mysql_query("INSERT INTO tbl_car_faults(vehicle_reg_num,fault_reported_date,operation_conditions,planned_resolution_date,reasons_remark,status,reportdate,planresolndate)"
            . " VALUES('$car_reg_num','$datefaults','$operationcond','$planresolution','$reasons','$status','$reportdate','$reportplanresoln')") or die(mysql_error());
    
    $Select_id=  mysql_query("SELECT * FROM tbl_car_faults ORDER BY fault_id DESC") or die(mysql_error());
    $tu=  mysql_fetch_array($Select_id);
    $fault_id=  $tu['fault_id'];
    
       for ($i = 0; $i < sizeof($faultsdescr); $i++) {
                             $description=ucwords($faultsdescr[$i]);
                        $insert = mysql_query("INSERT INTO tbl_car_faults_list(`fault_description`,`fault_id`)"
                                . "values('$description','$fault_id')") or die(mysql_error());
                    }
    
    if($insert_faults){
        echo "<script>
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
    
}

?> 



<script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementById("show_data").innerHTML = "";
                document.getElementById("show_data").style.border = "0px";
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
                    document.getElementById("show_data").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/search_car.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/car_track/load_car_issue.php";
             
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'Action'},
                           {name: 'check'},
                        {name: 'vehicle_reg_num'},
                        {name: 'vehicle_type'},
                        {name: 'owner'},
                        {name: 'driver_name'},
                        {name: 'driver_contact'},
                        {name: 'vehicle_centre'},
                        {name: 'fault_description'},
                        {name: 'fault_reported_date'},
                        {name: 'date_reported_accounts'},
                        {name: 'overlapped_days'},
                        {name: 'operation_conditions'},
                        {name: 'planned_resolution_date'},
                        {name: 'actual_resolution_date'},
                        {name: 'reasons_remark'},
                        {name: 'status'}

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
                            {text: 'Action', datafield: 'Action', width: 60},
                            {text: 'No', datafield: 'check', width: 50},
                        {text: 'Vehicle Registration #', datafield: 'vehicle_reg_num', width: 100},
                        {text: 'Vehicle Type', datafield: 'vehicle_type', width: 120},
                        {text: 'Owner', datafield: 'owner', width: 100},
                        {text: 'Driver Name', datafield: 'driver_name', width: 150},
                        {text: 'Driver Contact', datafield: 'driver_contact', width: 100},
                        {text: 'Vehicle Centre', datafield: 'vehicle_centre', width: 150},
                        {text: 'Faults Description', datafield: 'fault_description', width: 230},
                        {text: 'Faults Reported Date', datafield: 'fault_reported_date', width: 150},
                        {text: 'Date Reported Accounts', datafield: 'date_reported_accounts', width: 150},                       
                        {text: 'Operation Conditions', datafield: 'operation_conditions', width: 150},
                        {text: 'Planned Resolution Date', datafield: 'planned_resolution_date', width: 150},
                        {text: 'Actual Resolution Date', datafield: 'actual_resolution_date', width: 150},
                        {text: 'Reasons/Remark', datafield: 'reasons_remark', width: 150},
                        {text: 'Status', datafield: 'status', width: 150}


                        ],
                        
                    });
                    
//                           $("#excelExport").jqxButton();
//            $("#xmlExport").jqxButton();
//            $("#csvExport").jqxButton();
//            $("#tsvExport").jqxButton();
//            $("#htmlExport").jqxButton();
//            $("#jsonExport").jqxButton();
//            $("#pdfExport").jqxButton();
//            $("#excelExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'jqxGrid');           
//            });
//            $("#xmlExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'xml', 'jqxGrid');
//            });
//            $("#csvExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'csv', 'jqxGrid');
//            });
//            $("#tsvExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'tsv', 'jqxGrid');
//            });
//            $("#htmlExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'html', 'jqxGrid');
//            });
//            $("#jsonExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'json', 'jqxGrid');
//            });
//            $("#pdfExport").click(function () {
//                $("#jqxgrid").jqxGrid('exportdata', 'pdf', 'jqxGrid');
//            });
                    
                    
                    
        });
        
        
        
    </script>
     <script>
        function shoform(str) {
            if (str.length == 0) {
                document.getElementById("show_form").innerHTML = "";
                document.getElementById("show_form").style.border = "0px";
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
                    document.getElementById("show_form").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/car_reg_form.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    
    <script type="text/javascript">//<![CDATA[ 
    window.onload = function () {

        $(function () {
            $('table').on('click', 'tr a', function (e) {
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

           


        });
    };
    //]]>  
</script>
</head>
<div class="row fixed-top" >
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse" id="myNavbar"  style=" margin: 2px 0px 5px 0px;" >

            <nav class="horizontal-menu compact" >
                <ul>
                    
                    <li >
                        <a class="" style="" href="#" data-toggle="modal" data-target="#add_issue">Add New Issue</a>
                    </li>
                     <li >
                        <a class="" style="" href="?action=vehicle_report" >Generate Report</a>
                    </li>
                    


                </ul>
            </nav>
        </div>

    </div>


</div>


<div class="row">
    
    <div class="col-lg-12">
<!--                     <button type="button" class="btn btn-default" id='excelExport' ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>-->
        
            <div style='float: left;'>
                <button type="button" class="btn btn-success" value="Export to Excel" id='excelExport'>Exportto excel</button>
                
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to CSV" id='csvExport' />
                
            </div>
           
            <div style='margin-left: 10px; float: left;'>
                <button type="button" value="Export to PDF" class="btn btn-success" id='pdfExport' >Export Pdf</button>
            </div>
        
                </div>
    <hr>
</div>

<div class="row">
    <div class="col-lg-12">
    <div id="jqxgrid">

        <!------------------------------------contents appear hire-->
    </div>
        </div>
</div>

    
<div id="add_issue" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="">
            <form  action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">ADD NEW ISSUE</h4>
                </div>

                <div class="modal-body ">
                    <div class="row">
                        <div class="col-lg-12">
                             <div class="">
                    <div class="input-control text">
                        <input type="text" name="" placeholder="Search By Vehicle Registration Number" onkeyup="showResult(this.value)" />
                        <button class="btn-search"></button>
                    </div>
                </div>

                <div class="" id="show_data">
                    <!--                  show data-->
                </div>
                            <div class="" id="show_form">
                    <!--                  show data-->
                    
                </div>
                        </div>
                    </div>

                    
                    <div role="tabpanel" class="">
                        <div class="row">
                            <div class="col-lg-12">
                            <table class="table" id="invoice-table">
                                <tr>
                                    <td>
                        <div class="input-group" style="width:100%; margin:0px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fault Description:</span></span>
                            <input name="faultsdescr[]" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">                           
                        </div>
                                    </td>
                                    <td>
                                         <a href="#" class="cross-delete btn btn-success fg-white" >x</a>
                                    </td>
                                </tr>
                                
                                 
                            </table>
                               <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                    <span  aria-hidden="true"></span> + Add Description Field
                                </button>
                                <br><br>
                            </div>
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fault Reported Date:</span></span>
                            <input name="datefaults" id="date1" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Planned Resolution Date:</span></span>
                            <input name="planresolution" id="date2" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Operation Conditions:</span></span>
                            <input name="operationcond" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Reasons/Remark</span></span>
                            <input name="reasons" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                       
                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" name="register_car_issue" class="btn btn-primary">Submit</button>
                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>
<!--model linces-->

<div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Your data was successfully submitted!</strong> .
</div>

  </div>
</div>


<div id="edit_issue" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="">
            <form  action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">VIEW VEHICLE ISSUE</h4>
                </div>

                <div class="modal-body ">
                    <div role="tabpanel" class="">
                        <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Registration No:</span></span>                    
                                    <input name="reg_no" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>  
                        <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Vehicle Type:</span></span>                    
                                    <input name="vehcle_type" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>
                        <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Vehicle Type:</span></span>                    
                                    <input name="owner" id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>

                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Driver Name:</span></span>
                                    <input name="dname" id="d" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>
                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="pnum" id="e" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>
                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Location:</span></span>
                                    <input name="team" id="o" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Faults Description:</span></span>
                            <input name="faultsdescr" id="f" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fault Reported Date:</span></span>
                            <input name="datefaults" id="g" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Planned Resolution Date:</span></span>
                            <input name="planresolution" id="h" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                             <span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Actual Resolution Date:</span></span>
                            <input name="actual_resolution" id="k" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Cash Reference No:</span></span>
                            <input name="crefno" id="p" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                         <div class="input-group" style="width:100%; margin:2px 0">
                            
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Amount Requested:</span></span>
                            <input name="amountrequest" id="q" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Operation Conditions:</span></span>
                            <input name="operationcond" id="i" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Reasons/Remark</span></span>
                            <input name="reasons" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Status</span></span>
                            <input name="status" id="m" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <input name="fault_id" id="n" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="hidden">
                        </div>
                       
                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" name="register_car_issue" class="btn btn-primary">Submit</button>
                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>
<!--model linces-->


