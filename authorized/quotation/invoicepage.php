
<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/quotation/load_invoicepage.php";
            
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'link'},
                    { name: 'link1'},
                    { name: 'SN'},
                    { name: 'Invoice_date'},
                    { name: 'Invoice_number' },
                    { name: 'Invoice_descrip'},
                    { name: 'Vat'},
                    { name: 'invoicename'},                  
                   { name: 'Currency'}
  
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
                  
                   { text: 'EDIT', datafield: 'link', width: '5%'},
                   { text: 'VIEW', datafield: 'link1', width: '10%'},
                   { text: 'SN', datafield: 'SN', width: '5%'},
                   { text: 'INVOICE_NAME', datafield: 'invoicename', width: '15%'},
                   { text: 'INVOICE_DATE', datafield: 'Invoice_date', width: '15%'},
                    { text: 'INVOICE_NUMBER', datafield: 'Invoice_number', width: '10%'},
                   { text: 'INVOICE_DESCRIPTION', datafield: 'Invoice_descrip', width: '30%'},
                   { text: 'VAT', datafield: 'Vat', width: '5%'},
                   { text: 'CURRENCY', datafield: 'Currency', width: '15%'}
                  
                                  
                  
                  
                  
                ]
            });
        });
    </script>
                  
    
</head>
<div class="row">
    
    <div class="col-lg-12">
        
        <a href="?action=newquotation" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Add Quotation</a>  
        
    </div><br><br>
    
    <div class="col-lg-12">
        
     <div id="jqxgrid">
            
     </div>
    </div>
    
    
</div>
