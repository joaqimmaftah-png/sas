<?php
include '../db.php';
$paymentid=$_GET['paymentid'];
$select_user = mysql_query("SELECT * FROM tbl_solar_clients WHERE client_id='$paymentid'") or die(mysql_error());
$mns = mysql_fetch_array($select_user);
    $client_id= $mns['client_id'];
    $fname=$mns['fname'];
    $last_name=$mns['last_name'];
    $ms=  mysql_query("SELECT * FROM tbl_solar_contract WHERE client_id='$client_id'") or die(mysql_error());
    $mt = mysql_fetch_array($ms);
    $Ref=$mt['Ref'];
 


?>

<script type="text/javascript">
        $(document).ready(function (e) {
            $("#updatepayment").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/add_solar_payment.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#leteujumbe").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>


                     
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            
                            <li class="active"><a data-toggle="tab" href="#add_payment"><i class="fa fa-plus"></i>&nbsp;Payment</a></li>
                            <li class=""><a data-toggle="tab" href="#payment_history"><i class="fa fa-plus"></i>&nbsp;Payment History</a></li>

                        </ul>

                        <div class="tab-content">
                            
                            
                                   <div class="col-lg-12" id="leteujumbe">
                                
                            </div>     

                            <div id="add_payment" class="tab-pane fade in active">
                                <form action="authorized/usersystem/add_solar_payment.php" id="updatepayment" method="post">
                  
                                <div class="row">
                                                  <div class="col-lg-12">
                   <br />
                                    <button type="submit" name="submitasset" class="btn btn-success" style="color:white"><i class="fa fa-arrow-down"></i>&nbsp;Update Data</button>
                                    <button class="btn btn-default" ><i class="fa fa-remove"></i> Cancel</button>
                                    <br />
                                    <br />
                                </div>
                                    <div class="col-lg-6">
                                        <div class="input-group" style="width:100%; margin:2px 0">
                                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Name:</span></span>
                                            <input name="fnamee"  id="product_name" class="form-control editable" placeholder=""  value="<?php echo $fname.' '.$last_name;?>" aria-describedby="sizing-addon1" type="text">
                                           
                                            <input name="client_id"  id="product_name" class="form-control editable" placeholder=""  value="<?php echo $client_id;?>" aria-describedby="sizing-addon1" type="hidden">
                                        </div>
                                        <div class="input-group" style="width:100%; margin:2px 0">
                                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Ref Number:</span></span>
                                            <input name="Ref"  id="product_name" class="form-control editable" placeholder=""  value="<?php echo $Ref;?>" aria-describedby="sizing-addon1" type="text">

                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group" style="width:100%; margin:2px 0">
                                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
                                            <input name="Date" value="<?php echo $dts=date("d/m/Y");?>"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                        </div>
                                        <div class="input-group" style="width:100%; margin:2px 0">
                                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amount Paid:</span></span>
                                            <input name="amount"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div id="payment_history" class="tab-pane fade">
                                <br>
                                
                                <div class="row"> 
                                                  <div class="col-lg-12" >
                  <!--tables-->
                                                  <table id="table_solar" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            
                                            <th class="text-left">Ref#</th>
                                            <th class="text-left">First Name</th>                                                                                     
                                            <th class="text-left">Surname</th>
                                            <th class="text-left">Phone No.</th>
                                            <th class="text-left">Date Paid</th>
                                            <th class="text-left">Amount Paid</th>
                                            

                                        </tr>
                                    </thead>

                                    <tbody id="retedataa">
<?php

$select_payments = mysql_query("SELECT * FROM tbl_solar_payment WHERE client_id='$paymentid' ORDER BY payments_id DESC ") or die(mysql_error());
while ($md = mysql_fetch_array($select_payments)) {
    $client_id=$md['client_id'];
    $select_user = mysql_query("SELECT * FROM tbl_solar_clients WHERE client_id='$client_id'") or die(mysql_error());
$mnss = mysql_fetch_array($select_user);
$mse=  mysql_query("SELECT * FROM tbl_solar_contract WHERE client_id='$client_id'") or die(mysql_error());
    $mts = mysql_fetch_array($mse);
    ?>
                                            <tr>
                                                                                                
                                                <td class="right"><a href="#"><?php echo $mts['Ref']; ?></a></td>                                       
                                                <td class="right"><?php echo $mnss['fname']; ?></td>
                                                <td class="right"><?php echo $mnss['last_name']; ?></td>
                                                <td class="right"><?php echo $mnss['phone_no']; ?></td>
                                                <td class="right"><?php echo $md['paid_date']; ?></td>
                                                <td class="right"><?php echo $md['amount']; ?></td>
                                                
                                                

                                            </tr> 
    <?php
}
?>
                                    </tbody>

                                    <tfoot></tfoot>
                                </table>
              </div>
                                </div>
                            </div>
                                
                        </div>
                        <!--mmmmm-->

                    </div>

