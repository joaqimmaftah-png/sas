<head>
<script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/quotation/load_quotationreport.php";
            
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Quote_name' ,type: 'string' },
                    { name: 'Quote_number'},
                    { name: 'Quote_date',type: 'string'},
                    { name: 'customer_name'},
                    { name: 'SN'},
                    { name: 'Invoice_date',type: 'string'},
                    { name: 'Invoice_number'},
                    { name: 'PO/Approval'},
                    { name: 'Work_status'},
                    { name: 'Sign off'},
                    { name: 'Invoice_description' ,type: 'string'},
                    { name: 'Category'},
                    { name: 'Currency'},
                    { name: 'Qt_amount',type: 'string'},
                    { name: 'Amount_Vat_exc',type: 'string'},
                    { name: 'Vat'},
                    { name: 'Amount_Vat_inc',type: 'string'},
                    { name: 'Tally'},
                    { name: 'EFD_date'},
                    { name: 'Payment'},
                    { name: 'WHT'},
                    { name: 'Deduction'},
                    { name: 'PYT_date'},
                    { name: 'Lump_sum'}
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
                   { text: 'QUOTATION DATE', datafield: 'Quote_date', width: '15%'},
                   { text: 'QUOTATION#', datafield: 'Quote_number', width: '10%'},
                   { text: 'CLIENT', datafield: 'customer_name', width: '10%'},
                    { text: 'QUOTATION NAME', datafield: 'Quote_name', width: '10%'},
                   { text: 'INV DATE', datafield: 'Invoice_date', width: '10%'},
                   { text: 'INVOICE#', datafield: 'Invoice_number', width: '10%'},
                   { text: 'PO/APRVL', datafield: 'PO/Approval', width: '10%'},
                   { text: 'WORK STATUS', datafield: 'Work_status', width: '10%'},
                   { text: 'SIGN OFF', datafield: 'Sign off', width: '10%'},
                   { text: 'INV DESCRIPTION', datafield: 'Invoice_description', width: '10%'},
                   { text: 'CATEGORY', datafield: 'Category', width: '10%'},
                   { text: 'CURRENCY', datafield: 'Currency', width: '10%'},
                   { text: 'QT AMNT', datafield: 'Qt_amount', width: '10%'},
                   { text: 'AMOUNT VAT Exc', datafield: 'Amount_Vat_exc', width: '10%'},
                   { text: 'VAT', datafield: 'Vat', width: '10%'},
                   { text: 'AMOUNT VAT Inc', datafield: 'Amount_Vat_inc', width: '10%'},
                   { text: 'TALLY', datafield: 'Tally', width: '10%'},
                   { text: 'EFD DATE', datafield: 'EFD_date', width: '10%'},
                   { text: 'PAYMENT', datafield: 'Payment', width: '10%'},
                   { text: 'WHT', datafield: 'WHT', width: '10%'},
                   { text: 'DEDUCTION', datafield: 'Deduction', width: '10%'},
                   { text: 'PYT DATE', datafield: 'PYT_date', width: '10%'},
                   { text: 'LUMP SUM', datafield: 'Lump_sum', width: '10%'}
                  
                  
                  
                  
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