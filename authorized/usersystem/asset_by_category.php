 <?php
 include 'db.php';
 $asset_ids=$_GET['asset_ids'];
 ?>
<head>

        <script>
        $(document).ready(function() {
    $('#asset').DataTable();
} );
        </script>
</head>


<div class="row">
                    <div class="col-lg-12">
                                   <div class="col-lg-12">
                                       <a class="btn btn-default" href="#" role="button"><i class="fa fa-home"></i>&nbsp;Home</a>                                    
                      <button  class="btn btn-success" style="color:white"><i class="fa fa-plus"></i>&nbsp;Add New</button>
        <button class="btn btn-default" ><i class="fa fa-check"></i>&nbsp;Edit</button>
         <button class="btn btn-default" ><i class="fa fa-remove"></i>&nbsp;Delete</button>
        <br />
      
        <hr>
                  </div>
                        
                        <table id="asset" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Asset Name</th>
                                    <th class="text-left">Description</th>
<!--                                    <th class="text-left">Vendor</th> -->
                                    <th class="text-left">Model</th>
                                    <th class="text-left">Serial</th>
                                    
                                      <th class="text-left">Employee Name</th>
                                     
                                    

                                </tr>
                            </thead>

                            <tbody id="retedataa">
<?php
$j = 1;
$selectasset=  mysql_query("SELECT * FROM tbl_employee_asset") or die(mysql_error());
while ($assetsincro= mysql_fetch_array($selectasset)) {
    $empo=$assetsincro['employe_no'];
       $aaid=$assetsincro['asset_id'];
    $persona = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$empo'")or die(mysql_error());
$us = mysql_fetch_array($persona);
$fv = $us['first_name'];
$lv = $us['surname'];
$tbl_fixed_asset=mysql_query("SELECT * FROM tbl_fixed_asset WHERE asset_id='$aaid' ") or die(mysql_error());
$tr=  mysql_fetch_array($tbl_fixed_asset);
    ?>
                                    <tr>
                                         <td class=" text-center">
                                             <input type="checkbox" value="">
                                        </td>
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $tr['asset_name']; ?></a></td>                                       
                                        <td class="right"><?php echo $tr['description']; ?></td>
                                        <td class="right"><?php echo $tr['model']; ?></td>
                                        <td class="right"><?php echo $tr['serial_number']; ?></td>
                                        <td class="right"><?php echo $fv.' '.$lv; ?></td>
                                       
                                        
                                       
                                    </tr> 
    <?php
}
?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>