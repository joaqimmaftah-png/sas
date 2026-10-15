<head>
    <script>
        function editfunction(str) {
            if (str.length == 0) {
                document.getElementById("showformedit").innerHTML = "";
                document.getElementById("showformedit").style.border = "0px";
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
                    document.getElementById("showformedit").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/page_to_edit_cash_request.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>



<?php
if (isset($_GET['View_cash'])) {
    
    ?>


    <div class="container">
        <div class="grid">               
            <div id="invoice-container" class="invoice-container">

                <div class="row">
                    <div class="col-sm-12">
          <ul class="pagination">
                <li>
                    <a href="?" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
                </li>
                <li >
                                                <button type="button" class="btn btn-primary edit_request" data-cash_id="<?php echo $_GET['View_cash']; ?>" data-toggle="modal" data-target="#myModal">
  Edit Request
</button>
                </li>
            </ul>  

                    </div>



                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                                                <?php
                            $CASH_id =$_GET['View_cash']+1;
    $CASH =$_GET['View_cash'];
    if(isset($_POST['View_cash'])){
   
    $details = $_POST['details'];
    $cash_id = $_POST['cash_id'];
    $pname=$_POST['pname'];
    $pricee=$_POST['price'];
    $quant=$_POST['quant'];
    $unit=$_POST['unit'];
    $bad_symbols = array(",");
    $price = str_replace($bad_symbols, "", $pricee);
    $request_date = date("d-m-Y H:i:s");
    $cname=$_POST['cname'];
    $invnumber=$_POST['invnumber'];
    $list_id=$_POST['list_id'];
    $refence=$_POST['reference'];
    $site_cla=$_POST['site_cla'];
    $v_number=$_POST['v_number'];
    $reqtitle=$_POST['reqtitle'];
                  $update_cash=  mysql_query("UPDATE cash_request SET request_date='$request_date',invoice_number='$invnumber',company_name='$cname',pname='$pname',sitename='$site_cla',vehiclenumber='$v_number',title='$reqtitle' WHERE cash_id='$cash_id'") 
                      or die(mysql_error());
            

     if($price){
                for ($i = 0; $i < sizeof($details); $i++) {
                $subtotal = $quant[$i] * $price[$i];

                $update_list=  mysql_query("UPDATE cash_request_item SET `detail`='$details[$i]', units='$unit[$i]',units_price='$price[$i]',quantity='$quant[$i]',"
                        . " `total`='$subtotal' WHERE list_id='$list_id[$i]' AND `reference`='$refence'") or die(mysql_error());
           
            }
     }
     $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Update successful!</strong>
</div>';
    }
$cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
                                $roww = mysql_fetch_array($cashlist);
                                        
                                        $request_by=$roww['request_by'];
                                        $approved_by=$roww['approved_by'];
                                        $received_by=$roww['received_by'];
                                        $approved_date=$roww['approved_date'];
                                        $received_by_date=$roww['received_by_date'];
                                        $request_date = $roww['request_date'];
                                        $approved_by_status=$roww['approved_by_status'];
                                        $request_status=$roww['request_status'];
                                        $received_by_status=$roww['received_by_status'];
                                        $rejection_reasons=$roww['rejection_reasons'];
                                        $company_name=$roww['company_name'];
                                        $invoice_number=$roww['invoice_number'];
                                        $pname = $roww['pname'];
                                        $ewura_levy=$roww['ewura_levy'];    
                                        $vatt=$roww['VAT'];
                                        $request_title=$roww['title'];
                                        
                                    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname'];
                                    
                                    $opinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approved_by'")or die(mysql_error());
                                    $op = mysql_fetch_array($opinfo);
                                    $fop = $op['first_name'];
                                    $lop = $op['surname'];
                                    
                                    $accinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$received_by'")or die(mysql_error());
                                    $acc = mysql_fetch_array($accinfo);
                                    $facc = $acc['first_name'];
                                    $lacc = $acc['surname'];
                                   
    $jd = 1;
    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    $jumla = $totals['SUM(total)'];
    
    
    $vat1=($jumla * ($vatt/100));  
    
    $JUMLA =$ewura_levy + $jumla +$vat1;
        
       
        
                        ?>
                        
                        
                        <?php
                        echo $message;
                        ?>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="assets/invoice.jpg" alt="logo">

                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><strong>SINCRO SITEWATCH LTD</strong></h2>
                        <p class="text-center small">Plot No. 1337 Msonge Street, Mikocheni A,PO Box 80407,DSM<br>
                            Tel: +255 22 2700971 , Fax: +255 22 2700970,<br>
                            wwww.sincrositewatch.com</p> 
                    </div>
                    <div class="col-sm-3">                       
                        <?php
                        if(!empty($company_name)){                       
                        ?>
                        <strong>PROFORMA ATTACHMENT</strong><br>
                        <strong>Company Name:</strong><?php echo $company_name;?><br>
                        <strong>Invoice Number:</strong><?php echo $invoice_number;?><br>
                      <?php
                      }
                      ?>
                         <?php
                        if(!empty($pname)){                       
                        ?>
                        <strong>PROJECT NUMBER</strong><br>
                        <strong>Company Name:</strong><?php echo $pname;?><br>
                        
<?php }?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">


                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><span><strong><?php echo $request_title;?></strong></span><br><br>
                        <!--<h2 class="text-center" ><span><strong>PAYMENT FORM</strong></span><br>-->
                        <span><?php echo $identificationnumber='SSWRQ'.sprintf("%04d",$CASH);?></span>
                            </h2>

                    </div>
                    <div class="col-sm-3">
                        <p class="text-right small"><strong></strong></p>
                        <p class="text-right"></p>
                    </div>
                </div>
                <p class="small"></p>

                <table class="table cart table-bordered">  
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Details</th>                            
                            <th>Unit Price</th>
                            <th>Quantity</th> 
                            <th>Units</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php
    while ($show_item = mysql_fetch_array($att)) {
        
        $detail=$show_item['detail'];
        $charge_to=$show_item['charge_to'];
        $reference=$show_item['reference'];
        $qq=$show_item['quantity'];
        $units_price=$show_item['units_price'];
        $un=$show_item['units'];
        $total=$show_item['total'];
       
       
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $request_date; ?></td>
                                <td class="price"><?php echo $detail; ?></td>
                                <td class="product"><?php echo $units_price; ?></td> 
                                <td class="product"><?php echo $qq; ?></td> 
                                <td class="product"><?php echo $un; ?></td> 
                                <td class="quantity text-right"><?php echo number_format($total, 2); ?></td>
                            </tr>
    <?php } ?>

                        
                       
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                        
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">VAT</td>
                            <td class="amount text-right"><?php echo number_format($vat1, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">EWURA LEVY</td>
                            <td class="amount text-right"><?php echo number_format($ewura_levy, 2); ?></td>
                        </tr>
                        
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">TOTAL AMOUNT</td>
                            <td class="amount text-right"><?php echo number_format($JUMLA, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
                <p>
                
                  <div class="col-sm-12">
                   
                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <?php echo $fm . ' ' . $lm; ?><br>
                    STATUS: <strong><?php echo $request_status;?></strong><br>
                    DATE: <strong><?php echo $request_date;?></strong>

                </div>
                <div class="col-sm-4">
                   
                    OPERATION DIRECTOR<br>
                    NAME: <?php echo $fop . ' ' . $lop; ?><br>
                    STATUS: <strong><?php echo $approved_by_status;?></strong><br>
                    DATE: <strong><?php echo $approved_date;?></strong>

                

                </div>
                <div class="col-sm-4">
                  
                    ACCOUNTANT<br>
                    NAME: <?php echo $facc . ' ' . $lacc; ?><br>
                    STATUS: <strong><?php echo $received_by_status;?></strong><br>
                    DATE: <strong><?php echo $received_by_date;?></strong>

                
                </div>
                </p>
                <hr>
                <div class="col-sm-12">
                    <?php
                    if(!empty($rejection_reasons)){
                    ?>
                     <strong class="fg-active-cobalt">Rejected Reasons:</strong><?php echo $rejection_reasons;?>
                    <?php
                      }
                    ?>
                   

                </div>
                <hr>
                
            </div>


        </div>
    </div>





    <?php
}

?>







<!-- Modal -->
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Payment Request</h4>
      </div>
      <div class="modal-body" >
          <form action="" method="POST">
          <div id="showformedit">
          <strong>Are you sure you want to edit payment Request with reference number SSWCR<span id="req"></span></strong>
          <div class="row">
              
  <div class="col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" onchange="editfunction(this.value)" value="" id="cash_id" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <input type="text" placeholder="Click check box to show the contents" class="form-control" aria-label="Text input with checkbox">
    </div>
  </div>
  
</div>
          
          </div>
              </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

