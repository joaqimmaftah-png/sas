

<?php
require_once __DIR__ . '/../../../mysql_compat.php';

include_once 'authorized/db.php';
$messages='';
if(isset($_GET['delete'])){
    $vocher_id=$_GET['voucher_id'];
    $remove=  mysql_query("DELETE FROM `payment_voucher` WHERE voucher_no='$vocher_id'") or die(mysql_error());
    $remove=  mysql_query("DELETE FROM `tbl_vocher_items` WHERE voucher_no='$vocher_id'") or die(mysql_error());
}
else{}
?>

<head>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
    }
</style>
<script type="text/javascript">//<![CDATA[ 
    window.onload = function () {

        $(function () {
            $('table').on('click', 'tr a.cross-delete', function (e) {
                e.preventDefault();
                $(this).parents('tr').remove();
            });

            $("#add-invoice-row").click(function () {
                $("#invoice-table").each(function () {
                    var tds = '<tr>';
                    jQuery.each($('tr:last td', this), function () {
                        tds += '<td>' + $(this).html() + '</td>';
                    });
                    tds += '</tr>';
                    if ($('tbody', this).length > 0) {
                        $('tbody', this).append(tds);
                    } else {
                        $(this).append(tds);
                    }
                });
            });

           


        });
    };
    
    
    

    //]]>  
</script>
</head>

<div class="row" >
    <div class="col-lg-12">
        <?php
        if(isset($_GET['message'])){
    echo $messages='<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>
</div>'; 
}
        ?>
    </div>
    <div class="col-lg-12">
    <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Add Vocher</a>
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Description</th>
                <th>Pay To</th>
                <th>Voucher Number</th>
                <th>Total Amount</th>
                <th>Currency</th>
                <th>Date</th>
                 <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $purchase = mysql_query("SELECT * FROM payment_voucher ORDER BY pay_id DESC") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($purchase)) {
                $voucher_no = $row['voucher_no'];
                $paid_to = $row['paid_to'];
                $bank_acc_no=$row['bank_acc_no'];
                $chq_number=$row['chq_number'];
                $created_date = $row['created_date'];
                $pay_id = $row['pay_id'];
                
                
                $tbl_items = mysql_query("SELECT * FROM tbl_vocher_items where voucher_no='$voucher_no' ORDER BY item_id LIMIT 1") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_items);
                

                $sumitem = mysql_query("SELECT SUM(amount) FROM  tbl_vocher_items where voucher_no='$voucher_no'") or die(mysql_error());
                $total = mysql_fetch_array($sumitem);
                $subtotal = $total['SUM(amount)'];
//                $paddedNum = sprintf("%04d", $subtotal);

                ///////////////////////////////////////////
               $currency=$rows['currency'];
                $description = $rows['description'];
                 $item_id=$rows['item_id'];
                
                ?>
                <tr>
                    <td>
                        <a href=""><?php echo $j++; ?></a>
                    </td>                  
                    <td>
                        <a href=""><?php echo $description; ?></a>
                    </td>
                     <td>
                         <a href=""><?php echo $paid_to; ?></a>
                     </td>
                    <td> <a href=""><?php echo 'SSWL PV '.$voucher_no; ?></a></td> 
                    <td><a href=""><?php echo number_format(lpo_num($subtotal), 2); ?></a></td>
                    <td><a href=""><?php echo $currency; ?></a></td>
                    <td><?php echo $created_date;?></td>
                    <td> <a href="?action=view_voucher&voucher_id=<?php echo $voucher_no;?>">View</a> | 
                        <a href="?action=voucher&delete&voucher_id=<?php echo $voucher_no;?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <th>S/NO</th>
                <th>Description</th>
                <th>Pay To</th>
                <th>Voucher Number</th>
                <th>Total Amount</th>
                <th>Currency</th>
                <th>Date</th>
                 <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
    </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generate Payment Voucher</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <form action="?action=submitvocha" method="POST">
              <div class="col-lg-6">
                  <?php
                  $generatepv=  mysql_query("SELECT * FROM payment_voucher ORDER BY pay_id DESC");
                  $vnum= mysql_fetch_array($generatepv);
                  $num=$vnum['voucher_no']+1;
                  $vnumber=$num;
                  ?>
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Voucher Number:</span></span>
                                                        <input name="vnumber" id="product_name" class="form-control editable" placeholder="" value="<?php echo 'SSWL PV '.$vnumber;?>" aria-describedby="sizing-addon1" disabled="" type="text">
                                                        <input name="vnumber" id="product_name" class="form-control editable" placeholder="" value="<?php echo $vnumber;?>" aria-describedby="sizing-addon1" type="hidden">
                                                    </div>
              </div>
              <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Payment Date:</span></span>
                                                       

                                                        <input name="pdate" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                    </div>
              </div>
              <div class="col-lg-12">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Please pay to:</span></span>
                                                         <input name="payto" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                        <!--<span class="input-group-addon"><a href="#"><i class="glyphicon glyphicon-plus"></i></a></span>-->

                                                    </div>
              </div>
              <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">SSW Bank Account No:</span></span>
                                                        <input name="bcountssw" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Bank Name:</span></span>
                                                        <input name="bname" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Bank Branch:</span></span>
                                                        <input name="bbranch" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Bank Account No:</span></span>
                                                        <input name="bcount" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Swift Code:</span></span>
                                                        <input name="swift" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">IBAN:</span></span>
                                                        <input name="aban" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
                  <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                                        <input name="address" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                       

                                                    </div>
              </div>
              <div class="col-lg-6">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">CHQ NO.:</span></span>
                                                        <input name="chqno" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                                        

                                                    </div>
              </div>
                                <div class="col-lg-12">
                  <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date Created:</span></span>
                                                       
<input name="vdate" id="product_name" class="form-control editable" placeholder="" value="<?php echo date("d-m-Y");?>" aria-describedby="sizing-addon1" disabled="" type="text">
                                                        <input name="vdate" id="product_name" class="form-control editable" placeholder="" value="<?php echo date("d-m-Y");?>" aria-describedby="sizing-addon1" type="hidden">
                                                    </div>
              </div>
                 <div class="col-lg-12">
       
                                            <table class="table table-striped table-hover bordered" id="invoice-table">
                                    <thead><tr>

                                            <th>No</th>
                                            <th>Description</th>                                            
                                            <th>Amount</th>                                         
                                           <th>Currency</th> 

                                            <th></th>
                                        </tr></thead>
                                    <tbody  style="font-size:9px">
                                        <tr>

                                             <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:50%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:20%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="currency[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            
                                           
                                            <td style="width:5%">
 
                                            </td>
                                        </tr>
                                        <tr id="add">
                                               <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:50%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:20%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="currency[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            
                                            <td style="width:5%">

                                                <a href="#" id="add_rows" class="cross-delete btn btn-success fg-white" >x</a> 
                                            </td>

                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>

            
            
             <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                    <span  aria-hidden="true"></span> + add new row&nbsp;
                                </button>
            <button type="submit" class="btn btn-success" name="voucher" style="color:white"><i class="glyphicon glyphicon-plus"></i>Generate Voucher</button>
       
    </div>
              </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>