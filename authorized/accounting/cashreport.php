<?php
if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/accounting/load_cashrequest.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/accounting/load_cashrequest.php";
}
?>

<head>
    <script type="text/javascript">
        $(document).ready(function () {   
            var url = "<?php echo $url;?>"
      
            // prepare the data
            var source =
            {    
                        datatype: "json",
                        datafields: [
                            {name: 'Request_ID',type: 'string'},
                            {name: 'Requested_by',type:'string'},
                            {name: 'Request',type:'string'},
                            {name: 'Request_Date',type:'string'},
                            {name: 'Invoice_Number',type: 'string'},
                            {name: 'Company_Name',type: 'string'},
                             {name: 'Quoatation_item',type: 'string'}, 
                            {name: 'Project_Name',type: 'string'},
                            {name: 'Manager_Status',type: 'string'},
                            {name: 'Account_Status',type: 'string'},
                            {name: 'vehicle'},
                            {name: 'sitename'},
                            {name: 'Total',type: 'string'}
                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height:'611',
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                     { text: 'Request ID', datafield: 'Request_ID', width: '9%' },
                     { text: 'Request for(Details)', datafield: 'Request', width: '30%' },
                  { text: 'Requested by', datafield: 'Requested_by', width: '10%' },
                  { text: 'Request Date', datafield: 'Request_Date',width: '10%' },
                  { text: 'Invoice Number', datafield: 'Invoice_Number', width: '10%' },
                  { text: 'Quotation Item', datafield: 'Quoatation_item',width: '10%' },
                  { text: 'Project Name', datafield: 'Project_Name',width: '10%' },
                  { text: 'Site Name', datafield: 'sitename',width: '10%' },
                  { text: 'Vehicle Reg#', datafield: 'vehicle',width: '10%' },
                  { text: 'Manager Status', datafield: 'Manager_Status', width: '8%' },
                  { text: 'Account Status', datafield: 'Account_Status', width: '8%' },
                  { text: 'Amounts(Tsh)', datafield: 'Total', width: '10%' }
                ]
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
<div class="row" style=" margin-top: 10px;">
    <div class="col-lg-12">
        <div id="jqxgrid">
            
          
            
        </div>
    </div>
</div>