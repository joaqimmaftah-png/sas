
<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/RCA/select_by_date.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/RCA/load_rca_report.php";
}
?>


<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "<?php echo $url;?>";
           
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
                            {name: 'alarm_date'},
                            {name: 'alarm_time'},
                            {name: 'oos_date'},
                            {name: 'oos_time'},
                            {name: 'date_reported'},
                            {name: 'time_reported'},
                            {name: 'time_in'},
                            {name: 'time_out'},
                            {name: 'fault_clear_date'},
                            {name: 'clear_time'},
                            {name: 'ac_down_time'},
                            {name: 'dc_down_time'},
                            {name: 'faults_alarm'},
                            {name: 'primary_cause'},
                            {name: 'route_cause'},
                            {name: 'faults_resolution'},
                            {name: 'tt_status'},
                            {name: 'tt_closed_by'},
                            {name: 'remarks'},
                            {name: 'tigo_reference'},
                            {name: 'sincro_reference'},
                            {name: 'field_supervisor'},
                            {name: 'tech_name'},
                            {name: 'tech_phone'}

                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#mj").jqxGrid(
                    {
                        width: '100%',
                        height: '1200',
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
                        columns: [
                            {text: 'No', datafield: 'link', width: 50},
                            {text: 'SITE ID', datafield: 'site_id', width: 100},
                            {text: 'SITE NAME', datafield: 'site_name', width: 100},
                            {text: 'WARD', datafield: 'ward', width: 100},
                            {text: 'DISTRICT', datafield: 'district', width: 100},
                            {text: 'REGION', datafield: 'region', width: 100},
                            {text: 'FIELD SUPERVISOR', datafield: 'field_supervisor', width: 100},
                            {text: 'TECH NAME', datafield: 'tech_name', width: 100},
                            {text: 'TECH PHONE', datafield: 'tech_phone', width: 100},
                            {text: 'NOC OPERATOR', datafield: 'noc_operator', width: 100},
                            {text: 'ALARM DATE', datafield: 'alarm_date', width: 100},
                            {text: 'ALARM TIME', datafield: 'alarm_time', width: 100},
                            {text: 'OOS DATE', datafield: 'oos_date', width: 100},
                            {text: 'OOS TIME', datafield: 'oos_time', width: 100},
                            {text: 'DATE REPORTED', datafield: 'date_reported', width: 100},
                            {text: 'TIME REPORTED', datafield: 'time_reported', width: 100},
                            {text: 'TIME IN', datafield: 'time_in', width: 100},
                            {text: 'TIME OUT', datafield: 'time_out', width: 100},
                            {text: 'FAULTY CLEAR DATE', datafield: 'fault_clear_date', width: 100},
                            {text: 'CLEAR TIME', datafield: 'clear_time', width: 100},
                            {text: 'AC DOWNTIME', datafield: 'ac_down_time', width: 100},
                            {text: 'DC DOWNTIME', datafield: 'dc_down_time', width: 100},
                            {text: 'FAULTY ALARM', datafield: 'faults_alarm', width: 100},
                            {text: 'PRIMARY CAUSE', datafield: 'primary_cause', width: 100},
                            {text: 'ROOT CAUSE', datafield: 'route_cause', width: 100},
                            {text: 'FAULTY RESOLUTION', datafield: 'faults_resolution', width: 100},
                            {text: 'TT STATUS', datafield: 'tt_status', width: 100},
                            {text: 'TT CLOSED BY', datafield: 'tt_closed_by', width: 100},
                            {text: 'REMARKS', datafield: 'remarks', width: 100},
                            {text: 'TIGO REFERENCE', datafield: 'tigo_reference', width: 100},
                            {text: 'SINCRO REFERENCE', datafield: 'sincro_reference', width: 100}


                        ],
                    });

            $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'xls', 'RCA_Excelsheet');
            });

            $("#csvExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'csv', 'RCA_Excelsheet');
            });

            $("#pdfExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'pdf', 'RCA_Excelsheet');
            });



        });
    </script>


</head>



<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-database"></i>&nbsp;Home</a></li>
        <li class=""><a data-toggle="tab" href="#menu1"><i class="fa fa-bar-chart"></i>&nbsp;Weekly callout Report</a></li>
<!--                                    <li class=""><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Category</a></li>-->

    </ul>
    <div class="col-lg-12">
    <div class="tab-content">          
            <div id="home" class="tab-pane fade in active" > 
                <div class="row" style="margin-top: 1%;">
                    <form action="" method="POST" id="search_date">
                         <div class="col-lg-4">
        <div class="input-group date ">
                    <input class="form-control" id="date1" name="from" placeholder="RCA From Date dd-mm-yyyy" type="text" value="" >
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-4">
        <div class="input-group date " >
                    <input class="form-control" id="date2" name="to" placeholder="RCA To Date dd-mm-yyyy" type="text" value="" >
                    
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-1">
        
        <button class="btn btn-default" type="submit" name="m" ><i class="glyphicon glyphicon-search"></i> Search</button>
    </div> 
                 <div class="col-lg-3">

    </div> 
                    </form>
                    </div>
                <hr>
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
    <div class="col-lg-12" id="mud">
                   <div id="mj" >
        </div>
        
                </div>
</div>
                
                

            </div>
        <!--------------------------------End home data-->
        
    </div> 
        </div>
    
    
    
</div>

