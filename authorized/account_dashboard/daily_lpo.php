<div class="row">    
    <div class="col-lg-12">  
   
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>QUOTATION NAME</th>               
                <th>QUOTATION #</th>
                <th>QUOTATION DATE</th>
                <th>CLIENT</th>
                <th>WORK STATUS</th> 
                <th>AMOUNT INCL VAT</th>
                <th>QUOT_ITEMS</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php
require_once __DIR__ . '/../../mysql_compat.php';

            
            $i=1;
           include_once 'authorized/db.php';  
           $status_po=$_GET['status'];
           $treport=$_GET['date'];
           
           
           
            $gt= mysql_query("SELECT * FROM tbl_preparedquotation WHERE update_month='$treport' AND Work_status!='cancelled'") or die(mysql_error());
            while ($rrow = mysql_fetch_array($gt)) {
                                
                
    $rdi=$rrow['customer_id'];
    $vta1=$rrow['Vat'];
    $project_id=$rrow['project_id'];
           $customer=mysql_query("SELECT * FROM quotation_customer WHERE customer_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($customer);
           
           $quot=$rrow['Quotation_id'];
          
           
           
  $resul = mysql_query("SELECT * FROM `tbl_quotationitem` WHERE Quotation_id='$quot'")or die(mysql_error());
  $resulz = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quot'")or die(mysql_error());
  $erweTz=  mysql_fetch_array($resulz);
  $tnumber= mysql_numrows($resul);
   if($tnumber>0){
                   $vat=$erweTz['SUM(Net_Price)']*($vta1/100);
                   $gradtotal=$erweTz['SUM(Net_Price)']+$vat;
                   $totalvatexcl=$erweTz['SUM(Net_Price)'];
   }
   
 else { 
        
  $gradtotal=$rrow['Amount_vat_inc'];
  $totalvatexcl=$rrow['Amount_vat_exc'];
  $vat=$gradtotal-$totalvatexcl;
   }

                
                ?>
                <tr>
                    
                    <td><?php echo $i++;?></td>                 
                    <td><?php echo $rrow['Quotation_name'];?></td>                   
                    <td><?php echo $rrow['Quotation_number'];?></td>
                    <td><?php echo $rrow['Quotation_date'];?></td>
                    <td><?php echo $ng['customer_name'];?></td>
                    <td><?php echo $quot;?></td>
                    <td><?php echo number_format($gradtotal,2);?></td>
                    <td><a href="?action=quot_item&ids=<?php echo $quot;?>">View items</a></td> 
                                                             
                </tr> 
            <?php   
            
            }  
            
            ?>
        </tbody>  

        <tfoot>
            <tr>
                <th>No</th>
                <th>QUOTATION NAME</th>                
                <th>QUOTATION #</th>
                <th>QUOTATION DATE</th>
                <th>CLIENT</th>
                <th>WORK STATUS</th> 
                <th>AMOUNT INCL VAT</th>
                <th>QUOT_ITEMS</th>
               
            </tr>        
        </tfoot>
    </table>
</div>
</div>  


