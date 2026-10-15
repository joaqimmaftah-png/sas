      <?php
      include '../db.php';
      $nn=$_GET['issued'];
      $purt=mysql_query("SELECT * FROM tbl_action_list where sn='$nn'") or die(mysql_error());
      $row=  mysql_fetch_array($purt);
      $Action = $row['Action'];
      $Requirements = $row['Requirements'];
      $End_Date= $row['End_Date'];
      $Start_Date= $row['Start_Date'];      
      $Responsible= $row['Responsible'];
      $opm_id= $row['opm_id'];
      $Updatee=$row['Updatee'];
      $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $f = $rows['first_name'];
                $l = $rows['surname'];
      $purchase = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_id'") or die(mysql_error());          
      $roww=  mysql_fetch_array($purchase);
      
      
      $Description_of_Finding = $roww['Description_of_Finding'];
      $key_owner = $roww['key_owner'];
        
      $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customer);
                $ff = $rowss['first_name'];
                $ll = $rowss['surname'];
      
      ?>       


<div class="col-lg-12">
     <form action="" method="post" >
                  <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description of Finding:</span></span>
                <textarea name="DSCF" id="product_name"   class="form-control editable" placeholder=""  aria-describedby="sizing-addon1" ><?php echo $Description_of_Finding;?></textarea>
                <input name="sn"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $nn;?>"  aria-describedby="sizing-addon1" type="hidden">
                <input name="opd"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $opm_id;?>"  aria-describedby="sizing-addon1" type="hidden">
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Actions:</span></span>
                <textarea name="action" id="product_name"   class="form-control editable" placeholder=""  aria-describedby="sizing-addon1" ><?php echo $Action;?></textarea>

            </div>
                  <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Requirements:</span></span>
                <input name="requirement"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $Requirements;?>"  aria-describedby="sizing-addon1" type="text">

            </div>
                  <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Owner:</span></span>
                 <select class="form-control" name="keyowner" id="fs">
                     <option value="<?php echo $key_owner; ?>"><?php echo $ff . '&nbsp;' . $ll;?></option>
<?php
$a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
while ($b = mysql_fetch_array($a)) {
    $first_name = $b['first_name'];
    $surname = $b['surname'];
    $emp_file_noo = $b['emp_file_no'];
    ?>
                                        <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                    <?php } ?>
                                </select>

            </div>
         
               <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Responsible:</span></span>
                <select class="form-control" name="respons" id="fs">
                                    <option value="<?php echo $Responsible; ?>"><?php echo $f . '&nbsp;' . $l;?></option>
<?php
$a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
while ($b = mysql_fetch_array($a)) {
    $first_name = $b['first_name'];
    $surname = $b['surname'];
    $emp_file_noo = $b['emp_file_no'];
    ?>
                <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                    <?php 
                                    
                                }

                                    ?>
                                </select>
            </div>
         
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Start Date:</span></span>
                <input name="startdate"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $Start_Date;?>"  aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">End Date:</span></span>
                <input name="enddate"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $End_Date;?>"  aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                <input name="status"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $Updatee;?>"  aria-describedby="sizing-addon1" type="text">

            </div>
         
         
        <div class="input-group" style="width:100%; margin:2px 0">
               <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">All actions:</span></span>
               <select class="form-control" name="dependence" id="fs">
                <option value="">choose_dependence</option>
        <?php
        
        $opm_id= $row['opm_id'];
        $b = mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id'") or die(mysql_error());
        while ($c = mysql_fetch_array($b)) {
        $actions = $c['Action'];
        $requir=$c['Requirements'];
        $act_id=$c['sn'];
       
        
        ?>
            <option  value="<?php echo $act_id; ?>"><?php echo  $requir; ?></option>

                                <?php 
                                    
                                }

                                ?>
                </select>       
                </div>
         
         
         
         
         <hr>
         <button type="submit" name="submit_editdata" class="btn btn-success" style="color:white"><i class="fa fa-save"></i>&nbsp;Save Changes</button>
              </form>   
              </div>