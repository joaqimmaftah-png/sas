<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/Attendence/load_verfcation2.php";
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'No'},
                            {name: 'site_name',type: 'string'},
                            {name: 'code',type: 'string'},
                            {name: 'long',type: 'string'},
                            {name: 'lat',type: 'string'},
                            {name: 'time_in',type: 'string'},
                            {name: 'verify_time',type: 'string'},
                            {name: 'status',type: 'string'}                                                 
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
                            {text: 'No', datafield: 'No', width: '5%'},
                            {text: 'SITE NAME', datafield: 'site_name', width: '10%'},
                            {text: 'TOKEN NUMBER', datafield: 'code', width: '10%'},
                            {text: 'LONGTUDE', datafield: 'long', width: '15%'},
                            {text: 'LATITUDE', datafield: 'lat',cellsformat: 'd', width: '15%'},
                            {text: 'TIME SENT', datafield: 'time_in', width: '15%'},
                            {text: 'TIME VERIFIED', datafield: 'verify_time', width: '15%'},                           
                            {text: 'STATUS', datafield: 'status', width: '15%'}
                            
                           
                           
                        ],
                        
                    }); 
                    
                    
                               $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'CLASS_A_ATTENDENCE');
            });

            $("#csvExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'csv', 'RCA_Excelsheet');
            });

            $("#pdfExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'pdf', 'RCA_Excelsheet');
            });
                    
                    
                    
                    
                            
        });
        
        
        
    </script>

</head>
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
<div class="row" >


    <div class="col-lg-12">
        <div id="jqxgrid" >
        </div>
    </div>
</div>



