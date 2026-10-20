<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
$CASH_id =$_GET['q']+1;
$CASH =$_GET['q'];
$cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
                                $roww = mysql_fetch_array($cashlist);
                                 $rejection_reasons=$roww['rejection_reasons'];
                                        $company_name=$roww['company_name'];
                                        $invoice_number=$roww['invoice_number'];
                                        $pname=$roww['pname'];
                                        $cash_id=$roww['cash_id'];
                                        $jd = 1;
                                        $sitename=$roww['sitename'];
                                        $pname=$roww['pname'];
                                        $vehiclenumber=$roww['vehiclenumber'];
                                        $title=$roww['title'];
                                        
    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
    $selT=  mysql_query("SELECT * FROM `tbl_class_a_site` WHERE s_id='$sitename'")or die(mysql_error());
    $sel=  mysql_fetch_array($selT);
    $jinalasite=$sel['sitename'];
    
    $gari=  mysql_query("SELECT * FROM `tbl_car_monitoring` WHERE car_id='$vehiclenumber'")or die(mysql_error());
    $garl=  mysql_fetch_array($gari);
    
    $magari=$garl['vehicle_reg_num'];
    
?>
<div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:50%">
                                            <select class="form-control" required="" data-live-search="true" id="af" name="site_cla">
                                                <option value="<?php echo $sitename;?>"><?php echo $jinalasite;?></option>
                                                <?php
                                                $selectsd = mysql_query("SELECT * FROM tbl_class_a_site") or die(mysql_error());
                                                while ($cla = mysql_fetch_array($selectsd)) {
                                                    $names = $cla['sitename'];
                                                    $s_id = $cla['s_id'];
                                                    ?>
                                                    <option value="<?php echo $s_id; ?>"><?php echo $names ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="invnumber" required="" value="<?php echo $invoice_number;?>" placeholder="Invoice Number(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:50%">

                                            <input name="cname"  value="<?php echo $company_name;?>" required="" placeholder="Company Name(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:50%">
 <select class="form-control" required="" onchange="showproject(this.value)" data-live-search="true" name="pname" required="">
     <option value="<?php echo $pname;?>"><?php echo $pname;?></option>
                                                <option value="NULL">NOT PROJECT</option>
                                               
                                                <?php
                                                $selecd = mysql_query("SELECT * FROM tbl_preparedquotation") or die(mysql_error());
                                                while ($clad = mysql_fetch_array($selecd)) {
                                                    $qcode = $clad['Quotation_number'];
                                                     
                                                    
                                                    ?>
                                                    <option value="<?php echo $qcode; ?>"><?php echo $qcode?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <!--<input name="pname" required="" placeholder="Project Number(*This field used only for Project Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">
                                            <select class="form-control" required="" data-live-search="true" id="af" name="v_number">
                                                <option value="<?php echo $vehiclenumber;?>"><?php echo $magari;?></option>
                                                <option value="">--Empty--</option>
                                                <?php
                                                $selectsdv = mysql_query("SELECT * FROM tbl_car_monitoring") or die(mysql_error());
                                                while ($clav = mysql_fetch_array($selectsdv)) {
                                                    $vehicle_reg_num = $clav['vehicle_reg_num'];
                                                    $car_id = $clav['car_id'];
                                                    ?>
                                                    <option value="<?php echo $car_id; ?>"><?php echo $vehicle_reg_num ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="reqtitle"  value="<?php echo $title;?>" required="" placeholder="Request Title"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">
                           
                           

                            <table class="table table-striped table-hover bordered" id="cash-table">
                                <thead><tr>

                                        <th>No</th>
                                        <th>DETAILS</th>
                                        <th>UNITS</th>
                                        <th>QUANTITY</th>
                                        <th>UNIT PRICE</th>
<!--                                        <th>TOTAL (TSHS)</th>-->
                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px">
                                    
                                    <input   name="cash_id"   value="<?php echo $cash_id; ?>"  type="text" hidden="">
   <?php
 
    while ($show_item = mysql_fetch_array($att)) {
        
        $detail=$show_item['detail'];
        $charge_to=$show_item['charge_to'];
        $reference=$show_item['reference'];
         $qq=$show_item['quantity'];
          $units_price=$show_item['units_price'];
           $un=$show_item['units'];
        $total=$show_item['total'];
        $list_id=$show_item['list_id'];
      
        
       
       
        ?>
                                    <tr id="add">
                                        <input   name="list_id[]"   value="<?php echo $list_id; ?>"  type="text" hidden="">
                                    <input   name="reference"   value="<?php echo $reference; ?>"  type="text" hidden="">
                                       <td style="width:5%">
                                            <input name="text" value="<?php echo  $jd++;?>"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:39%">
                                            <input name="details[]" value="<?php echo $detail;?>" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 
                                         <td style="width:10%">
                                            <input name="unit[]" value="<?php echo $un;?>"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                         <td style="width:10%">
                                            <input name="quant[]" value="<?php echo $qq;?>" id="quantit"   class="form-control amount editable" value="1" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                         <td style="width:15%">
                                             <input name="price[]" value="<?php echo $units_price;?>" id="pric"   class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>
 <?php } ?>

                                </tbody>
                            </table>

<button type="submit" name="View_cash" value="<?php echo $_GET['q'];?>" class="btn btn-success" style="color:white"><i class="fa fa-check"></i>Save changes</button>

                        </div>
         </div>          