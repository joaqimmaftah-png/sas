
<?php
if(isset($_POST['Submitexcel'])){
    
}else{
    
}
?>
<head>
        <script type="text/javascript">
        $(document).ready(function (e) {
            $("#account_data").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/accounting/add_on_accounts_sheet.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#show_message").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
</head>



<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=accounts_home"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                    <a href="#" data-toggle="modal" data-target="#add_accounts_sheet"><i class="icon-plus-2 fg-orange fg-hover-crimson"></i>&nbsp;Add Data</a>
            </li>
            <li>
                 <a class="" href="#" data-toggle="modal" data-target="#add_excel_sheet" class="fg-hover-crimson fg-cobalt"><i class="icon-stats-up fg-blue"></i>&nbsp;Upload Excel</a>
            </li>
            <li id="action">
                <!--               show data-->
            </li>
           

        </ul>
    </nav>
</div>

<script type="text/javascript">
                   $(document).ready(function () {
            var url = "authorized/accounting/load_accounts_data.php";

            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'check' },
                    { name: 'sn' },
                    { name: 'date' },
                    { name: 'clients' },
                    { name: 'site_name' },
                    { name: 'site_id'},
                    { name: 'spare_rwork'},
                    { name: 'specification'},
                    { name: 'uom'},
                    { name: 'qty'},
                    { name: 'unit_price_vat_ex'},
                    { name: 'total_price_vat_ex'},
                    { name: 'rq_no'},
                    { name: 'qt_no'},
                    { name: 'tpf_no'},
                    { name: 'acc_no'},
                    { name: 'po_no'},
                    { name: 'invoice_no'},
                    { name: 'pyt_status'},
                    { name: 'recon_batch'}
                    
                    
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height:500,
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                    { text: '', datafield: 'check', width:16},
                    { text: 'SN', datafield: 'sn', width:150},
                     { text: 'Date', datafield: 'date', width:120},
                  { text: 'Client', datafield: 'clients', width:150},
                  { text: 'Site Name', datafield: 'site_name', width:150},
                  { text: 'Site ID', datafield: 'site_id', width:150},
                  { text: 'Spare/R.WORK', datafield: 'spare_rwork', width:150},
                  { text: 'Specification', datafield: 'specification', width:150},
                  { text: 'UOM', datafield: 'uom', width:120},
                  { text: 'QTY', datafield: 'qty', width:150},
                  { text: 'Unit Price VAT EX', datafield: 'unit_price_vat_ex', width:180},
                  { text: 'Total Price VAT EX', datafield: 'total_price_vat_ex', width:150},
                  { text: 'RQ #', datafield: 'rq_no', width:150},
                   { text: 'QT #', datafield: 'qt_no',width:150},
                  { text: 'TPF #', datafield: 'tpf_no',width:150},
                  { text: 'ACC #', datafield: 'acc_no',width:150},
                  { text: 'PO #', datafield: 'po_no',width:150},
                  { text: 'INVOICE #', datafield: 'invoice_no',width:150},
                  { text: 'PYT STATUS #', datafield: 'pyt_status',width:150},
                  { text: 'RECON BATCH', datafield: 'recon_batch',width:150}

                  
                ]
            });
//            
//                      $("#print").jqxButton();
//         
//            $("#print").click(function () {
//                var gridContent = $("#jqxgrid").jqxGrid('exportdata', 'html');
//                var newWindow = window.open('', '', 'width=900, height=700'),
//                document = newWindow.document.open(),
//                pageContent =
//                    '<!DOCTYPE html>\n' +
//                    '<html>\n' +
//                    '<head>\n' +
//                    '<meta charset="utf-8" />\n' +
//                    '<title>OUR STOCK</title>\n' +
//                    '</head>\n' +
//                    '<body>\n' + gridContent + '\n</body>\n</html>';
//                document.write(pageContent);
//                document.close();
//                newWindow.print();
//            });
            
            
        });
    </script>
     <script>
        function gotoaction(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/accounting/sheet_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <div id="jqxgrid">
    </div>
    
    
    
    
    <!-- Modal -->
<div id="add_accounts_sheet" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Data</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div id="show_message" class=" margin20" style=" margin-top: 5px;">
                        
                    </div>
                    <div class="margin10">
                        <form action="" method="POST" id="account_data">
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="date">Date</label>
                                <input  type="text"  class="form-control" value=""  name="date">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="client">Client</label>
                                <input  type="text"  class="form-control" value=""  name="client">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="sitename">Site Name</label>
                                <input  type="text"  class="form-control" value=""  name="sitename">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">Site ID</label>
                                <input  type="text"  class="form-control" value=""  name="site_id">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="spare">Spare/R.WORK</label>
                                <input  type="text"  class="form-control" value=""  name="spare">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="specification">Specification</label>
                                <input  type="text"  class="form-control" value=""  name="specification">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="uom">UOM</label>
                                <input  type="text"  class="form-control" value=""  name="uom">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="qty">QTY</label>
                                <input  type="text"  class="form-control" value=""  name="qty">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="unit_price_vat">Unit Price VAT EX</label>
                                <input  type="text"  class="form-control" value=""  name="unit_price_vat">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">RQ#</label>
                                <input  type="text"  class="form-control" value=""  name="rq">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">QT#</label>
                                <input  type="text"  class="form-control" value=""  name="qt">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">TPF#</label>
                                <input  type="text"  class="form-control" value=""  name="tpf">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>

                                                                                 <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="acc">ACC#</label>
                                <input  type="text"  class="form-control" value=""  name="acc">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="po">PO#</label>
                                <input  type="text"  class="form-control" value=""  name="po">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="invoice">INVOICE#</label>
                                <input  type="text"  class="form-control" value=""  name="invoice">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="pyt_status">PYT STATUS</label>
                                <input  type="text"  class="form-control" value=""  name="pyt_status">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                              <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="reconsile_batch">RECON BATCH</label>
                                <input  type="text"  class="form-control" value=""  name="reconsile_batch">         
                                 </div>    
                                        
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" name="Submit" id="account_data" >
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>

    <!-- Modal -->
<div id="add_excel_sheet" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-file-excel fg-green"></span> 
                    <div class="title">Upload Excel Sheet(xls)</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div id="show_message" class=" margin20" style=" margin-top: 5px;">
                        
                    </div>
                    <div class="margin10">
                        <form action="" method="POST" id="account_excel_data">


    <div class="input-control file">
        <input type="file" />
        <button class="btn-file"></button>
    </div>
                            <input type="submit" class="button primary" value="Submit Data" name="Submitexcel" id="account_excel_data" >
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>
