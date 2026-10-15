<?php
if(isset($_POST['submitquotation'])){
   $qdate=$_POST['Quotationdate'];
   $qref=$_POST['quotationreference'];
   $sname=$_POST['Sitename'];
   $desc=$_POST['Description'];
   $amt=$_POST['Amount'];
   $curr=$_POST['Currency'];
   $apprv='Await Approval';
   $worksta='Not done';
   $invo='Not done';
   $custname=$_POST['customername'];
  
   
   $result=  mysql_query("INSERT INTO `quotation`(Quotation_Date,Quote_ref,Sitename,Description,Amount,Currency,Approval_status,Work_status,Invoice_status,Customer_name)VALUES('$qdate','$qref','$sname','$desc','$amt','$curr','$apprv','$worksta','$invo','$custname')")or die(mysql_error());
   echo '<div class="alert alert-success">
  <strong>Success!</strong> Your Quotation has been inserted successfully.
</div>';
}

if(isset($_POST['Savechanges'])){
   $Quotation_id=$_POST['Quotation_id'];
   $qdate=$_POST['Quotationdate'];
   $qref=$_POST['quotationreference'];
   $sname=$_POST['Sitename'];
   $desc=$_POST['Description'];
   $amt=$_POST['Amount'];
   $curr=$_POST['Currency'];
   $custname=$_POST['customername'];
   $astatus=$_POST['approval_status'];
   $Wstatus=$_POST['Work_status'];
   $Istatus=$_POST['Invoice_status'];
   $Idate=$_POST['Invoice_date'];
   $Iref=$_POST['Invoice_reference'];
   $Iamount=$_POST['Invoice_amount'];
   $Pstatus=$_POST['Payment_status'];
   $Comm=$_POST['Comments'];
   
   
   
   
   $upd=  mysql_query("UPDATE `quotation` SET `Quotation_Date`='$qdate',`Quote_ref`='$qref',`Sitename`='$sname',`Description`='$desc',`Amount`='$amt',`Currency`='$curr',`Approval_status`='$astatus',`Customer_name`='$custname',`Work_status`='$Wstatus',"
          . "`Invoice_status`='$Istatus',`Invoice_date`='$Idate',`Invoice_ref`='$Iref',`Invoice_amount`='$Iamount',`Payment_status`='$Pstatus',`Comments`='$Comm' WHERE `Quotation_id`=$Quotation_id") or die(mysql_error());
   
echo '<div class="alert alert-success">
  <strong>Success!</strong> Your Changes has been done successfully.
</div>';
   
}
?>

<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/quotation/load_quotation.php";

            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'link'},
                            {name: 'id'},
                            {name: 'Quotation_Date'},
                            {name: 'Quote_ref'},
                            {name: 'Sitename'},
                            {name: 'Description'},
                            {name: 'Amount'},
                            {name: 'Currency'},
                            {name: 'Approval_status'},
                            {name: 'Customer_name'},
                            {name: 'Work_status'},
                            {name: 'Invoice_status'},
                            {name: 'Invoice_date'},
                            {name: 'Invoice_ref'},
                            {name: 'Invoice_amount'},
                            {name: 'Payment_status'},
                            {name: 'Comments'}

                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
                    {
                        width: '100%',
                        Height: 550,
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        columns: [
                            {text: 'Action', datafield: 'link', width: '5%'},
                            {text: 'Qn_ID', datafield: 'id', width: '5%'},
                            {text: 'Quotation_Date', datafield: 'Quotation_Date', width: '10%'},
                            {text: 'Quote_ref', datafield: 'Quote_ref', width: '10%'},
                            {text: 'Sitename', datafield: 'Sitename', width: '10%'},
                            {text: 'Description', datafield: 'Description', width: '20%'},
                            {text: 'Amount', datafield: 'Amount', width: '10%'},
                            {text: 'Currency', datafield: 'Currency', width: '8%'},
                            {text: 'Approval_status', datafield: 'Approval_status', width: '10%'},
                            {text: 'Customer_name', datafield: 'Customer_name', width: '10%'},
                            {text: 'Work_status', datafield: 'Work_status', width: '10%'},
                            {text: 'Invoice_status', datafield: 'Invoice_status', width: '10%'},
                            {text: 'Invoice_date', datafield: 'Invoice_date', width: '10%'},
                            {text: 'Invoice_ref', datafield: 'Invoice_ref', width: '10%'},
                            {text: 'Invoice_amount', datafield: 'Invoice_amount', width: '10%'},
                            {text: 'Payment_status', datafield: 'Payment_status', width: '10%'},
                            {text: 'Comments', datafield: 'Comments', width: '10%'}

                        ]
                    });
        });
    </script>

</head>



<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary active"  data-toggle="modal" data-target="#addquotation" ><span class="glyphicon-plus"></span>Add new quotation</button>
        <br><br>
    </div>

    <div class="col-lg-12" >
        <div id="jqxgrid">

        </div>
    </div>
</div>



<!-- Modal -->
<div id="addquotation" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Quotation</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="POST">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Customer name</span></span>
                               <select class="form-control" id="af" name="customername">
                                                            <option value="">--select customer--</option>
                                                            
                                                            <?php
                                                            $sel=  mysql_query("SELECT * FROM `quotation_customer` ")or die(mysql_error());
                                                            
                                                            while ($row = mysql_fetch_array($sel)) {                                                                
                                                            
                                                            ?>
                                                            <option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name'];?></option>
                                                           <?php
                                                           }
                                                           ?>

                                                        </select>
                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quotation Date</span></span>
                                <input name="Quotationdate"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quote Ref</span></span>
                                <input name="quotationreference"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Sitename</span></span>
                                <input name="Sitename"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description</span></span>
                                <input name="Description"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amount</span></span>
                                <input name="Amount"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Currency</span></span>
                                <input name="Currency"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <br>
                            <div class="col-lg-12">
    <button type="submit" class="btn btn-success" name="submitquotation" style="color:white"><i class="glyphicon glyphicon-plus"></i>Submit Quotation</button>
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


<!--///////////////////////////////modal edit/////////////////////////////-->
<!-- Modal -->
<div id="Modaledit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
   <div class="modal-body">
   <div class="row">
   <div class="col-lg-10">
   <form action="" method="POST">
   <div class="input-group" style="width:100%; margin:2px 0">
       <input type="hidden" name="Quotation_id" id="p">
   <span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Customer name</span></span>
   <select class="form-control" id="a"  name="customername">
   <option value=""><span id="Cname"></span></option>
                                                            
                                                            <?php
                                                            $sel=  mysql_query("SELECT * FROM `quotation_customer` ")or die(mysql_error());
                                                            
                                                            while ($row = mysql_fetch_array($sel)) {                                                                
                                                            
                                                            ?>
                                                            <option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name'];?></option>
                                                           <?php
                                                           }
                                                           ?>

                                                        </select>
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Quotation Date</span></span>
<input name="Quotationdate"  id="b" class="form-control editable"  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Quote Ref</span></span>
<input name="quotationreference"  id="c" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Sitename</span></span>
                                <input name="Sitename"  id="d" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            
                            <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Description</span></span>
<input name="Description"  id="e" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Amount</span></span>
<input name="Amount"  id="f" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                           
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Currency</span></span>
<input name="Currency"  id="g" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Approval_status</span></span>
<input name="approval_status"  id="h" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
 <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Work_status</span></span>
<input name="Work_status"  id="i" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Invoice_status</span></span>
<input name="Invoice_status"  id="j" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
                            </div>
  <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Invoice_date</span></span>
                                <input name="Invoice_date"  id="k" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Invoice_reference</span></span>
                                <input name="Invoice_reference"  id="l" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
                            </div>
                            
 <div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Invoice_amount</span></span>
                                <input name="Invoice_amount"  id="m" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Payment_status</span></span>
                                <input name="Payment_status"  id="n" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
                            </div>
                            
<div class="input-group" style="width:100%; margin:2px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">Comments</span></span>
<input name="Comments"  id="o" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
</div>
<br>
<div class="col-lg-12">
 <button type="submit" class="btn btn-success" name="Savechanges" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save Changes</button>
 <button type="submit" class="btn btn-danger" name="deletequotation" style="color:white"><i class="glyphicon glyphicon-remove"></i>&nbsp;Delete</button>
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