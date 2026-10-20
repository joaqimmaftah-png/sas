<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/account_dashboard/load_account_dashboard.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/account_dashboard/load_account_dashboard.php";
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
                    { name: 'Quote_name' ,type: 'string' },
                    { name: 'Quote_number'},
                    { name: 'Quote_date',type: 'string'},
                    { name: 'customer_name'},                   
                    { name: 'PO_approval'},
                    { name: 'Work_status'},
                                     
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
                   { text: 'QUOTATION NAME', datafield: 'Quote_name', width: '25%'},
                   { text: 'QUOTATION#', datafield: 'Quote_number', width: '15%'},
                   { text: 'QUOTATION DATE', datafield: 'Quote_date', width: '15%'},                  
                   { text: 'CLIENT', datafield: 'customer_name', width: '20%'},                                    
                   { text: 'PO_APPROVAL', datafield: 'PO_approval', width: '10%'},
                   { text: 'WORK STATUS', datafield: 'Work_status', width: '10%'}
                   
                            
                ] 
            });
            
            $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Quotationreport');
            });

            $("#csvExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'csv', 'Quotationreport');
            });

            $("#pdfExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'pdf', 'Quotationreport');
            });
            
            
            
            
            
        });
</script>
                  
    
</head>



<div class="row">  
       <div class="col-lg-12 col-xs-12">
                       <form action="" method="POST" id="search_date">
                         <div class="col-lg-4">
        <div class="input-group date ">
                    <input class="form-control"  name="from" placeholder="From Date (dd-mm-yyyy)" type="date" value="" >
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-4">
        <div class="input-group date " >
                    <input class="form-control"  name="to" placeholder="To date (dd-mm-yyyy)" type="date" value="" >
                    
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
<br>



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
        
    <div class="col-lg-12">
        
    <div id="jqxgrid">
            
    </div>
    </div>
      
</div>