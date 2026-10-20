


<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/quotation/load_quotationpage.php";
            
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'link'},
                    { name: 'link1'},
                    { name: 'SN'},
                    { name: 'Quote_number'},
                    { name: 'Quote_name' },
                    { name: 'Quote_date'},
                    { name: 'customer_name'}
                   
  
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
                   { text: 'QUOTATION#', datafield: 'Quote_number', width: '15%'},
                    { text: 'QUOTATION NAME', datafield: 'Quote_name', width: '40%'},
                   { text: 'QUOTATION DATE', datafield: 'Quote_date', width: '15%'},
                   { text: 'CLIENT', datafield: 'customer_name', width: '10%'}
                   
                  
                                  
                  
                  
                  
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







