<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once 'authorized/db.php';  
$quot_id=$_GET['ids'];

?>

<div class="row">    
    <div class="col-lg-12">  
   
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Unit price</th>
                            
            </tr>
        </thead>
        <tbody>
            <?php
            
            $i=1;
                               
           
            $gtt= mysql_query("SELECT * FROM tbl_quotationitem WHERE Quotation_id='$quot_id'") or die(mysql_error());
            while ($htt = mysql_fetch_array($gtt)) {
                                
             
                ?>
                <tr>
                    
                    <td><?php echo $i++;?></td>                 
                    <td><?php echo $htt['Description'];?></td>
                    <td><?php echo $htt['Unit'];?></td>
                    <td><?php echo $htt['Quantity'];?></td>
                    <td><?php echo $htt['Unit_Price'];?></td>
                                                            
                </tr> 
                <?php   
            
            }
            
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Unit price</th>
                            
            </tr>        
        </tfoot>
    </table>
</div>
</div>








