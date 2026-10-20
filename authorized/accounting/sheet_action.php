
<a href="#" data-toggle="modal" data-target="#update"><span class="icon-pencil"></span>&nbsp;View</a>
<a href="?action=edit car info&car_info_id=<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_GET['q'];?>" class=""><span class="icon-cancel-2"></span>&nbsp;Delete</a>
 <!-- Modal -->
<div id="update" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Update Data</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                   
                    <div class="margin10">
                         <div id="show_message" class=" margin20" style=" margin-top: 5px;">
                        
                    </div>
                        <form action="" method="POST" id="account_data">
                            <?php
                            include '../db.php';
                            $id=$_GET['q'];
                            $select_data=  mysql_query("SELECT * FROM tbl_accounts_sheets WHERE sheet_id='$id'") or die(mysql_error());
                           $row=  mysql_fetch_array($select_data);
                            $date=$row['date'];
                            $clients=$row['clients'];
                            $site_name=$row['site_name'];
                            $site_id=$row['site_id'];
                            $spare_rwork=$row['spare_rwork'];
                            $specification=$row['specification'];
                            $uom=$row['uom'];
                            $qty=$row['qty'];
                            $unit_price_vat_ex=$row['unit_price_vat_ex'];                         
                            $rq_no=$row['rq_no'];
                            $qt_no=$row['qt_no'];
                            $tpf_no=$row['tpf_no'];
                            $acc_no=$row['acc_no'];
                            $po_no=$row['po_no'];
                            $invoice_no=$row['invoice_no'];
                            $pyt_status=$row['pyt_status'];
                            $recon_batch=$row['recon_batch'];
                            ?>
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="date">Date</label>
                                           <input  type="text"  class="form-control" value="<?php echo $date;?>"  name="date">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="client">Client</label>
                                <input  type="text"  class="form-control" value="<?php echo $clients;?>"  name="client">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="sitename">Site Name</label>
                                <input  type="text"  class="form-control" value="<?php echo $site_name;?>"  name="sitename">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">Site ID</label>
                                <input  type="text"  class="form-control" value="<?php echo $site_id;?>"  name="site_id">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="spare">Spare/R.WORK</label>
                                <input  type="text"  class="form-control" value="<?php echo $spare_rwork;?>"  name="spare">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="specification">Specification</label>
                                <input  type="text"  class="form-control" value="<?php echo $specification;?>"  name="specification">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="uom">UOM</label>
                                <input  type="text"  class="form-control" value="<?php echo $uom;?>"  name="uom">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="qty">QTY</label>
                                <input  type="text"  class="form-control" value="<?php echo $qty;?>"  name="qty">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="unit_price_vat">Unit Price VAT EX</label>
                                <input  type="text"  class="form-control" value="<?php echo $unit_price_vat_ex;?>"  name="unit_price_vat">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">RQ#</label>
                                <input  type="text"  class="form-control" value="<?php echo $rq_no;?>"  name="rq">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">QT#</label>
                                <input  type="text"  class="form-control" value="<?php echo $qt_no;?>"  name="qt">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="oldpass">TPF#</label>
                                <input  type="text"  class="form-control" value="<?php echo $tpf_no;?>"  name="tpf">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>

                                                                                 <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="acc">ACC#</label>
                                <input  type="text"  class="form-control" value="<?php echo $acc_no;?>"  name="acc">         
                                 </div>    
                                        
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="po">PO#</label>
                                <input  type="text"  class="form-control" value="<?php echo $po_no;?>"  name="po">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="invoice">INVOICE#</label>
                                <input  type="text"  class="form-control" value="<?php echo $invoice_no;?>"  name="invoice">         
                                 </div>                                          
                                    </td>
                                    <td>
                                         <div class="form-group">
                                             <label for="pyt_status">PYT STATUS</label>
                                <input  type="text"  class="form-control" value="<?php echo $pyt_status;?>"  name="pyt_status">         
                                 </div>                                          
                                    </td>
                                </tr>
                            </table>
                              <table>
                                <tr>
                                   
                                    <td>
                                       <div class="form-group">  
                                           <label for="reconsile_batch">RECON BATCH</label>
                                <input  type="text"  class="form-control" value="<?php echo $recon_batch;?>"  name="reconsile_batch">         
                                 </div>    
                                        
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" name="Submit" value="Update" id="account_data" >
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>



