<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['updatedata']))
{
 $Po_approval=$_POST['PO/Aprvl'];   
 $Work_status=$_POST['workstatus']; 
 $signoff=$_POST['Signoff'];  
 $category=$_POST['Category'];
 $tally=$_POST['Tally'];
 $efd_date=$_POST['EFD_DATE'];
 $payment=$_POST['Payment'];
 $wht=$_POST['Wht'];
 $deduction=$_POST['Deduction'];  
 $pyt_date=$_POST['Pytdate'];
 $lumpsum=$_POST['Lump_sum'];
 $quotat_id=$_POST['Quotation_id']; 
 $update_date= date('Ymd');
 $update_month=  date('Ym');      
$po_number=$_POST['po'];       
 
 $update=  mysql_query("UPDATE `tbl_preparedquotation` SET `PO/Approval`='$Po_approval', `approved_po`='$Po_approval', `Work_status`='$Work_status',`Sign_off`='$signoff',`Category`='$category',`Tally`='$tally',`Efd_date`='$efd_date',`Payment`='$payment',`WHT`='$wht',`Deduction`='$deduction',`PYT_date`='$pyt_date',`Lump_sum`='$lumpsum', `update_date`='$update_date', `update_month`='$update_month', `po_number`='$po_number' WHERE `Quotation_id`='$quotat_id'")or die(mysql_error());
 if($update){     
     echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have successfully updated your data  
</div>';  
 }    
 
}             
 
?>


<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/quotation/load_addquotation.php";
            
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'link'},
                    { name: 'link1'},
                    { name: 'Quote_name' },
                    { name: 'Quote_number'},
                    { name: 'Quote_date'},
                    { name: 'customer_name'},
                    { name: 'SN'},
                    { name: 'Invoice_date'},
                    { name: 'Invoice_number'},
                    { name: 'PO/Approval'},
                    { name: 'Work_status'},
                    { name: 'Sign off'},
                    { name: 'Invoice_description'},
                    { name: 'Category'},
                    { name: 'Currency'},
                    { name: 'Qt_amount'},
                    { name: 'Amount_Vat_exc'},
                    { name: 'Vat'},
                    { name: 'Amount_Vat_inc'},
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
                  
                   { text: 'EDIT', datafield: 'link', width: '5%'},
                   { text: 'ADD INVOICE', datafield: 'link1', width: '8%'},
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



<!--///////////////////////////////modal edit Quotation and Invoice/////////////////////////////-->
<div id="Modaledit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Quotation</h4>
      </div>
   <div class="modal-body">
   <div class="row">
<div class="col-lg-10">
<form action="" method="POST"> 
  <div class="input-group" style="width:100%; margin:2px 0"> 
      <input name="Quotation_id"  id="l" class="form-control editable"  value="" aria-describedby="sizing-addon1" type=hidden>
  <span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">PO/APRVL</span></span>
<!--  <input name="PO/Aprvl"  id="a" class="form-control editable"  value="" aria-describedby="sizing-addon1" type="text">
  -->
   <select name="PO/Aprvl"  id="a"  onchange="showtt(this.value)" class="form-control editable" aria-describedby="sizing-addon1" type="text">
      
      <option value="">Choose approval status</option>     
      <option value="Waiting approval">Waiting approval</option>
      <option value="Email approval">Email approval</option>
      <option value="PO approval">PO approval</option>
      <option value="Cancelled">Cancelled</option>  
      
        
    </select>  
  </div>
    <div class="input-group" style="width:100%; margin:2px 0" id="po">
  
</div> 
                            
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">WORK STATUS</span></span>
<select name="workstatus"  id="b" class="form-control">
    <option value="">choose status</option>
    <option value="On progress">On progress</option>
    <option value="Done">Done</option>
    <option value="Not done">Not done</option>
    <option value="Cancelled">Cancelled</option>  
    
    

</select>
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">SIGN OFF</span></span>
<input name="Signoff"  id="c" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

</div>
                            
 <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">CATEGORY</span></span>
<input name="Category"  id="d" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">TALLY</span></span>
<input name="Tally"  id="e" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                           
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">EFD DATE</span></span>
<input name="EFD_DATE"  id="f" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">PAYMENT</span></span>
<input name="Payment"  id="g" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
 <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">WHT</span></span>
<input name="Wht"  id="h" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">DEDUCTION</span></span>
<input name="Deduction"  id="i" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
                            </div>
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">PYT DATE</span></span>
<input name="Pytdate"  id="j" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">LUMP SUM</span></span>
<input name="Lump_sum"  id="k" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
                            </div>
<br>
<div class="col-lg-12">
 <button type="submit" class="btn btn-success" name="updatedata" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save Changes</button>
 
</div>
                        </form>
                    </div>   

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
        function showtt(str) {
            if (str.length == 0) {
                document.getElementById("po").innerHTML = "";
                document.getElementById("po").style.border = "0px";
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
                    document.getElementById("po").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/quotation/po_form.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
        <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

