
<?php
if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/opm/load_opm_report.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/opm/load_opm_report.php";  
}
?>

<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "<?php echo $url;?>";
            
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                   
                    { name: 'SN'},
                    { name: 'finding'},
                    { name: 'action'},
                    { name: 'requirements'},
                    { name: 'responsible' },
                    { name: 'start_date'},
                    { name: 'end_date'},
                    { name: 'executed_date'},
                    { name: 'status'},
                    { name: 'update_status'},
                    { name: 'remarks'}
  
                ],
                root: 'data',
                id:'id',
                url: url
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%', 
                Height: 500,      
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                  

                   { text: 'SN', datafield: 'SN', width: '5%'},
                   { text: 'FINDINGS', datafield: 'finding', width: '20%'},
                   { text: 'ACTION', datafield: 'action', width: '15%'},
                   { text: 'REQUIREMENTS', datafield: 'requirements', width: '30%'},
                   { text: 'RESPONSIBLE', datafield: 'responsible', width: '10%'},
                   { text: 'START_DATE', datafield: 'start_date', width: '10%'},
                   { text: 'END_DATE', datafield: 'end_date', width: '10%'},
                   { text: 'EXECUTED_DATE', datafield: 'executed_date', width: '10%'},
                   { text: 'STATUS', datafield: 'status', width: '10%'},
                   { text: 'UPDATE_STATUS', datafield: 'update_status', width: '10%'},    
                   { text: 'REMARKS', datafield: 'remarks', width: '10%'}
                                  
                                   
                  
                ]
            });
            
            $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Operationreport');
            });

            $("#csvExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'csv', 'Operationreport');
            });

            $("#pdfExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'pdf', 'Operationreport');
            });
            
        });
    </script>
                  
    
</head>

<div class="row">
    
    <div class="col-lg-12">
<!--                     <button type="button" class="btn btn-default" id='excelExport' ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>-->
        
            <div style='float: left;'>
                <button type="button" class="btn btn-success" value="Export to Excel" id='excelExport'>Exporttoexcel</button>
                
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to CSV" id='csvExport' />
                
            </div>
           
            <div style='margin-left: 10px; float: left;'>
                <button type="button" value="Export to PDF" class="btn btn-success" id='pdfExport' >ExporttoPdf</button>
            </div>
        
                </div>
    <hr>
</div>


<div class="row">
    
       <div class="col-lg-12 col-xs-12">
                       <form action="" method="POST" id="search_date">
                         <div class="col-lg-4">
        <div class="input-group date ">
                    <input class="form-control"  name="from" placeholder="From Date (dd-mm-yyyy)" type="date" value="<?php echo $from=$_POST['from'];?>" >
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-4">
        <div class="input-group date " >
                    <input class="form-control"  name="to" placeholder="To date (dd-mm-yyyy)" type="date" value="<?php echo $to=$_POST['to'];?>">   
                    
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />  
    </div>
    <div class="col-lg-1">
        
        <button class="btn btn-default" type="submit" name="m" ><i class="glyphicon glyphicon-search"></i>Search</button>
    </div> 
                 <div class="col-lg-3">

    </div> 
                    </form>
                    </div>
    
    <br/>
    </div>
<hr>  

<div class="row">
    
    <div class="col-lg-12">
        
     <div id="jqxgrid">     
            
     </div>      
    </div>
    
    
</div>









