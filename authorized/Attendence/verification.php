<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/Attendence/load_verfcation.php";
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'No'},
                            {name: 'id_no',type: 'string'},
                            {name: 'employee_name',type: 'string'},
                            {name: 'sitename',type: 'string'},
                            {name: 'entry_date',type: 'string'},
                            {name: 'timesent',type: 'string'},
                            {name: 'timeverified',type: 'string'},
                            {name: 'latitude'},
                            {name:'token',type:'string'},
                            {name: 'longitude',type: 'string'}                         
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
                            {text: 'No', datafield: 'No', width: '3%'},
                            {text: 'ID No', datafield: 'id_no', width: '5%'},
                            {text: 'EMPLOYEE No.', datafield: 'employee_name', width: '15%'},
                            {text: 'SITE NAME', datafield: 'sitename', width: '20%'},
                            {text: 'ENTRY DATE', datafield: 'entry_date',cellsformat: 'd', width: '10%'},
                            {text: 'TIME SENT', datafield: 'timesent', width: '7%'},
                            {text: 'TIME VERIFIED', datafield: 'timeverified', width: '10%'},
                            {text: 'TOKEN NUMBER', datafield: 'token', width: '10%'},
                            {text: 'LATITUDE', datafield: 'latitude', width: '10%'},
                            {text: 'LONGITUDE', datafield: 'longitude', width: '10%'}
                           
                           
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



