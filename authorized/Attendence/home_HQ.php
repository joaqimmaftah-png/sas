<?php
if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/Attendence/load_attendence.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/Attendence/load_attendence.php";
}
?>

<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "<?php echo $url;?>";  
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            
                            {name: 'No'},
                            {name: 'id_no',type: 'string'},
                            {name: 'employee_name',type: 'string'},
                            {name: 'entry_date',type:'string'},
                            {name: 'time_in',type: 'string'},
                            {name: 'time_out',type: 'string'},
                            {name: 'remarks',type: 'string'},
                            {name: 'total',type: 'string'}
                                                  
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
                            {text: 'No', datafield: 'No', width: '8%'},
                            {text: 'ID NUMBER', datafield: 'id_no', width: '12%'},
                            {text: 'EMPLOYEE NAME.', datafield: 'employee_name', width: '25%'},                           
                            {text: 'ENTRY DATE', datafield: 'entry_date',cellsformat: 'd', width: '15%'},
                            {text: 'TIME IN', datafield: 'time_in', width: '10%'},
                            {text: 'TIME OUT', datafield: 'time_out', width: '10%'},
                             {text: 'TOTAL HOUR', datafield: 'total', width: '10%'},
                             {text: 'LATE?', datafield: 'remarks', width: '10%'}
                            
                           
                        ],
                        
                    }); 
                    
                    
                               $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'HQ_ATTENDENCE');
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
       <div class="col-lg-12 col-xs-12">
                       <form action="" method="POST" >
                         <div class="col-lg-4">
                    <div class="input-group date ">
                    <input class="form-control"  name="from" placeholder="From Date (dd-mm-yyyy)" type="date" value="<?php echo $from=$_POST['from'];?>" >
               
		    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                 </div>
	<input type="hidden" id="dtp_input2" value="" />
        </div>
         <div class="col-lg-4">
         <div class="input-group date " >
             <input class="form-control"  name="to" placeholder="To date (dd-mm-yyyy)" type="date" value="<?php echo $to=$_POST['to'];?>" >
                    
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
    
                <br/>
                </div>
<br>  

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



