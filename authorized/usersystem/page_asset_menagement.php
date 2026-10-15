<?php

include '../db.php';
//$employeename=$_POST['employeename'];
//$department_id= $_POST['department_id'];
//$registerid= $_POST['registerid'];
//$submitasset=$_POST['submitasset'];

$assetnamee= $_POST['assetname'];
$explore=  explode('@', $assetnamee);
$cat=$explore[0];
$assetname=$explore[1];
$asssign=$explore[2];
$descriptional= $_POST['descriptional'];
$modeli= $_POST['modeli'];
$vendor=$_POST['vendor'];
$barcode= $_POST['barcode'];
$serialno= $_POST['serialno'];
$status= $_POST['status'];
$purchase_price= $_POST['purchase_price'];
$mode_of_payment=$_POST['mode_of_payment'];
$purchase=$_POST['purchase'];
$warranty=$_POST['warranty'];
$notes=$_POST['notes'];
//$locations= $_POST['locations'];
$selekt=  mysql_query("SELECT * FROM tbl_fixed_asset WHERE asset_name='$assetname' AND model='$modeli' AND serial_number='$serialno'") or die(mysql_error());
$qt=mysql_fetch_row($selekt);

if($qt==0){
  //////////////////////////////////////////////////////////////////////////////////
                if (!empty($modeli) && !empty($assetname)) {
                    $insert = mysql_query("INSERT INTO `tbl_fixed_asset`(`asset_name`,`description`,`model`,`serial_number`, `barcode`,vendor,note,purchase,warranty,cat,model_of_payment,status,purchase_price) "
                            . "VALUES ('$assetname','$descriptional','$modeli','$serialno','$barcode','$vendor','$notes','$purchase','$warranty','$cat','$mode_of_payment','$status','$purchase_price')") or die(mysql_error());
                    
                    if(empty($insert)){
                        echo  '<tr>
    <td colspan="8">
 <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:90%">
    Please Wait..!
  </div>
</div>
        </td>
</tr>';
 }
                    
                    else{
     echo '<tr class="error">
                                        <td colspan="9">
                                           <div class="alert alert-success">
  <strong>Success!</strong> '.$assetname.' was successful added to the database <strong>Thanks!</strong>
</div>
                                        </td>
                                    </tr>';
              $j = 1;
$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset ORDER BY asset_id DESC") or die(mysql_error());
while ($assetsincro = mysql_fetch_array($selectasset)) {                     
?>

                                    <tr>
                                                <td class=" text-center">

                                                    <input type="checkbox" onchange="showactions(this.value)" value="<?php echo $assetsincro['asset_id'].'@'.$asssign;?>">

                                                </td>
                                                <td class="right"><?php echo $j++; ?></td>
                                                <td class="right"><a href="#"><?php echo $assetsincro['asset_name']; ?></a></td>                                       
                                                <td class="right"><?php echo $assetsincro['description']; ?></td>
                                                <td class="right"><?php echo $assetsincro['model']; ?></td>
                                                <td class="right"><?php echo $assetsincro['serial_number']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase_price']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase']; ?></td>
                                                <td class="right"><?php echo $assetsincro['status']; ?></td>

                                            </tr> 
<?php
                    }
                    }                 
 
            }
            else {  
                echo ' <tr class="error">
                                        <td colspan="9">
                                           <div class="alert alert-danger">
  <strong>Error!</strong> Asset Name and Model Fields are Mandatory
</div>
                                        </td>
                                    </tr>';
                              $j = 1;
$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset ORDER BY asset_id DESC") or die(mysql_error());
while ($assetsincro = mysql_fetch_array($selectasset)) {
             ?>
                                    
                                       <tr>
                                                <td class=" text-center">

                                                     <input type="checkbox" onchange="showactions(this.value)" value="<?php echo $assetsincro['asset_id'].'@'.$asssign;?>">

                                                </td>
                                                <td class="right"><?php echo $j++; ?></td>
                                                <td class="right"><a href="#"><?php echo $assetsincro['asset_name']; ?></a></td>                                       
                                                <td class="right"><?php echo $assetsincro['description']; ?></td>
                                                <td class="right"><?php echo $assetsincro['model']; ?></td>
                                                <td class="right"><?php echo $assetsincro['serial_number']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase_price']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase']; ?></td>
                                                <td class="right"><?php echo $assetsincro['status']; ?></td>

                                            </tr>        
                                    
            <?php
            } 
            }
    
  ////////////////////////////////////////////////////////////////////  
}


else {
    ////////////////////////////////////////////////////////////////////////////////////
    echo '<tr class="error">
                                        <td colspan="9">
                                           <div class="alert alert-danger">
  <strong>Error!</strong> '.$assetname.' already exist on the database.
</div>
                                        </td>
                                    </tr>';
     $j = 1;
$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset ORDER BY asset_id DESC") or die(mysql_error());
while ($assetsincro = mysql_fetch_array($selectasset)) {
             ?>
                                   
                   
                                       <tr>
                                                <td class=" text-center">

                                                     <input type="checkbox" onchange="showactions(this.value)" value="<?php echo $assetsincro['asset_id'].'@'.$asssign;?>">

                                                </td>
                                                <td class="right"><?php echo $j++; ?></td>
                                                <td class="right"><a href="#"><?php echo $assetsincro['asset_name']; ?></a></td>                                       
                                                <td class="right"><?php echo $assetsincro['description']; ?></td>
                                                <td class="right"><?php echo $assetsincro['model']; ?></td>
                                                <td class="right"><?php echo $assetsincro['serial_number']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase_price']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase']; ?></td>
                                                <td class="right"><?php echo $assetsincro['status']; ?></td>

                                            </tr>          
                                    
            <?php
            }
    ///////////////////////////////////////////////////////////////////////////////////
}

            ?>

    <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
