  <?php
  include '../db.php';
  $nn=$_GET['qq'];
                                      $toa=  explode("@",$nn);
                                      $partid=mysql_real_escape_string($toa[0]);
                                      $er=$toa[1];
$sparenam = mysql_query("SELECT * from tbl_spare_parts where part_id='$partid' ") or die(mysql_error());
$rowing = mysql_fetch_array($sparenam);
    $sparename = $rowing['part_common_name'];
    $specification = mysql_real_escape_string($rowing['specification']);
    $model = $rowing['model'];
    $part_number = $rowing['part_number'];
    $manufacturer=$rowing['manufacturer'];
    $part_idd=$rowing['part_id'];
    
    $insert=  mysql_query("INSERT INTO `tbl_request_spare_temporary`(`sparename`, `specification`, `model`, `partnumber`, `manufacture`, `requester_id`,ref_no)"
            . " VALUES ('$sparename','$specification','$model','$part_number','$manufacturer','$er','$part_idd')") or die(mysql_error());
    
    if($insert){
        $sparenams = mysql_query("SELECT * from tbl_request_spare_temporary where requester_id='$er' ") or die(mysql_error());
$jk=1;
        while($wes = mysql_fetch_array($sparenams)){
    $itemname = $wes['sparename'];
    $spec= $wes['specification'];
    $modell = $wes['model'];
    $part_numberr = $wes['partnumber'];
    $manufacture=$wes['manufacture'];
    $ref_no=$wes['ref_no'];
    if(empty($spec)){
       $spec="NULL"; 
    }
    if(empty($modell)){
       $modell="NULL"; 
    }  
    if(empty($manufacture)){
       $manufacture="NULL"; 
    }
     if(empty($part_numberr)){
       $part_numberr="NULL"; 
    }
    
    
 
    
    
  ?>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text" value="<?php echo $jk++;?>" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:25%">
                                            <input name="itemm[]" value="<?php echo $itemname;?>" id="buying_price" class="form-control amount editable"   aria-describedby="sizing-addon1" type="text">
                                             <input type="hidden" name="partid[]"  value="<?php echo $ref_no;?>">
                                             
                                             <input type="hidden" name="model[]"  value="<?php echo $modell;?>">
                                             <input type="hidden" name="P[]"  value="<?php echo $part_numberr;?>">
                                             <input type="hidden" name="man[]"  value="<?php echo $manufacture;?>">
                                          
                                            
                                        </td>                                           
                                        <td style="width:20%">
                                            <input name="spec[]"  value="<?php echo $spec;?>" id="buying_price" class="form-control amount editable"  placeholder=""  aria-describedby="sizing-addon1" type="text" readonly="">
                                            <!--<input type="hidden" name="spec[]"  value="<?php echo $spec;?>">-->
                                        </td>

                                        <td style="width:22%">

                                            <input name="desc[]" id="buying_price" value="N/A" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" required=""  type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="quant[]" id="buying_price" value="" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" required="" type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="units[]" id="buying_price" value="" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" required="" type="text">
                                        </td>
                                        <td style="width:16%">
                                            <select class="form-control"  id="kind_id" required="" name="department">
                                                <option value="NULL">----Select---</option>
<?php
$sp = mysql_query("SELECT * from tbl_department") or die(mysql_error());
while ($ro = mysql_fetch_array($sp)) {
    $departmentname = $ro['department_name'];
    $department_id = $ro['department_id'];
    ?>
                                                    <option value="<?php echo $department_id; ?>"><?php echo $departmentname; ?></option>

    <?php
}
?>
                                            </select>
                                            <!--<input name="department[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>
                                    <?php
    }
    }
                                    ?>