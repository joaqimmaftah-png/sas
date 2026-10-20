
<?php
require_once __DIR__ . '/../../mysql_compat.php';

   include '../db.php';
   $n=$_GET['q'];
   
   if($n=='NULL'){
       
   }
 else {
     $ses = mysql_query("SELECT * FROM tbl_preparedquotation where Quotation_number='$n'") or die(mysql_error()); 
     $mn=mysql_fetch_array($ses);
     $id=$mn['Quotation_id'];
     

?>

<div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quotations Item:</span></span>
                                   <select class="form-control" required=""  data-live-search="true" name="quoitem">
                                                <option >Select items</option>
                                               
                                                <?php
                                                $sela = mysql_query("SELECT * FROM tbl_quotationitem where Quotation_id='$id'") or die(mysql_error());
                                                while ($cladd = mysql_fetch_array($sela)) {
                                                    $Description = $cladd['Description'];
                                                    $Item_id = $cladd['Item_id'];
                                                    
                                                    ?>
                                                    <option value="<?php echo $Item_id; ?>"><?php echo $Description?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                </div>
<?php
}
?>