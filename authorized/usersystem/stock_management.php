<?php
$message = "";
if (isset($_POST['addspare'])) {
    $Description = $_POST['Description'];
    $psparename = $_POST['psparename'];
    $partnamba = $_POST['partnamba'];
    $model = $_POST['model'];
    $specification = $_POST['manufacture'];
    $quantity = 0;
    $unit_price = 0;
    $minquantity = 0;
    $date = date("F j, Y, g:i a");
    if (!empty($psparename) && !empty($partnamba) && !empty($model)) {
        $prove = mysql_query("SELECT * FROM tbl_spare_parts WHERE part_common_name='$psparename' AND part_number='$partnamba'") or die(mysql_error());
        $row = mysql_num_rows($prove);
        if ($row < 1) {
            $sparepart = "INSERT INTO tbl_spare_parts(`part_number`, `part_common_name`, `description`, `model`,`entry_date`)"
                    . " VALUES('$partnamba','$psparename','$Description','$model','$date')";
            mysql_query($sparepart) or die(mysql_error());
 $tbl_list_sparetools=  mysql_query("INSERT INTO tbl_list_sparetools(sparename,specification)"
            . "VALUES('$psparename','$specification')") or die(mysql_error());
            $prove = mysql_query("INSERT INTO "
                    . "tbl_store(`store_id`,`part_number`,part_common_name,model,specification,`quantity`, `unit_price`, `min_qty`, `last_date_update`)"
                    . "VALUES('','$partnamba','$psparename','$model','$specification','$quantity','$unit_price','$minquantity','$date')") or die(mysql_error());
            $message = '<div class="alert alert-success success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> Success!</strong>....
  </div>';           
            
            
            
        } else {
            $message = ' <div class="success"><button name="addspare"  class="shadow button smaller danger">Spare is alredy exist on database</button></div>';
        }
    } else {
        $message = ' <div class="success"><button name="addspare"  class="shadow button smaller danger">Error on submit..!All field must be filled</button></div>';
    }
}
?> 
<!--//////////////images///////////////-->
<?php
if(isset($_POST['upload_pic'])){
 $store_id=$_POST['store_id'];
 $random = rand(1, 1000000000);
 $code=$random;
 $my_path_img = "authorized/stock/partimages/";
 $file_img = "$random.jpg";
 $path_img = $my_path_img . $file_img;
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $path_img)) {
 $update=  mysql_query("UPDATE tbl_store SET part_image='$file_img' WHERE store_id='$store_id'") or die(mysql_error());
  $message = '<div class="alert alert-success success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Upload Successful!</strong>....
  </div>';
}
}
 ?>
<!--///////////////////////////-->

<?php
if(isset($_POST['updates'])){
    $store_id=$_POST['store_id'];
    $pnamba=$_POST['pnamba'];
    $pname=$_POST['pname'];
    $model=$_POST['model'];
    $specfc=$_POST['specfc'];
    $desc=$_POST['desc'];
    $mingty=$_POST['mingty'];
    $qty=$_POST['qty'];
    $unit_price=$_POST['unit_price'];
    $date=date("F j, Y, g:i a");
    $UPDATES=  mysql_query("UPDATE tbl_store SET `part_number`='$pnamba',"
            . "`part_common_name`='$pname',`model`='$model',`specification`='$specfc',`manufacturer`='$desc',"
            . "`quantity`='$qty',`unit_price`='$unit_price',`min_qty`='$mingty',`last_date_update`='$date' WHERE store_id='$store_id'") 
            or die(mysql_error());
                $message = '<div class="alert alert-success success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successful Update!</strong>....
  </div>';
                
                $updatereport=  mysql_query("INSERT INTO tbl_store_report(`part_number`,`part_common_name`,`model`,`manufacturer`,specification,`new_quantity`,`last_date_update`)"
            . "VALUES('$pnamba','$pname','$model','$desc','$specfc','$qty','$date')") or die(mysql_error());
                
    
}

?>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete images') {
        $store_id=$_GET['store_id'];
        $delete=  mysql_query("Delete from tbl_store WHERE store_id='$store_id'") or die(mysql_error());
    $message = '<div class="alert alert-success success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successful Deleted!</strong>....
  </div>';
    }
}

?>



<script>
    $(function () {
        $("#approve_replacement").on('click', function () {
            $.Dialog({
                overlay: false,
                shadow: true,
                flat: false,
                icon: '<span class="icon-wrench"></span>',
                title: 'APPROVE SPARE PARTS REPLACEMENT!',
                content: '',
                onShow: function (_dialog) {
                    var html = [
                        '<iframe width="1000" height="400" src="authorized/stores/replaced_part.php" frameborder="0" allowfullscreen></iframe>'
                    ].join("");

                    $.Dialog.content(html);
                }
            });
        });
    })
</script>

<head>
    <style>
        tr td input{
            width: 40px;
        }
    </style>
             <script>
        function inventory(str) {
            if (str.length == 0) {
                document.getElementById("actioninventory").innerHTML = "";
                document.getElementById("actioninventory").style.border = "0px";
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
                    document.getElementById("actioninventory").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/stock/managestockaction.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

</head>
<div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?full=inventory"><i class="icon-home fg-blue"></i>&nbsp;Stock Holding</a>
            </li>
                       
            <li>
                <a class="" href="#"><i class="icon-file-excel fg-green"></i>&nbsp;Download</a>                 
            </li>
            <li>
                <a class="" href="#" data-toggle="modal" data-target="#myModalspare"><i class="icon-plus fg-blue"></i>&nbsp;Add Spare Part</a>
            </li>
             <li id="actioninventory">
<!--               show data-->
            </li>
                         <li>
                <a class="" href="?"><i class="icon-reply-2 fg-green"></i>&nbsp;Home</a>                 
            </li>
        </ul>
    </nav>
</div> 
<div class="">
    <?php
echo $message;
    ?>
</div>
<div id="full" class="">
    <table id="table" class="table table-striped table-hover bordered" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>

            <tr class="info">
                <th class="text-left"></th>
                <th class="text-left">Part Name</th>
                <th class="text-left">Part Number</th>                                                 
                <th class="text-left">Model</th>
                <th class="text-left">Specification</th>
                <th class="text-left">Quantity</th>
                <th class="text-left">Min Qty</th>
                <th class="text-left">Last Update</th>                           
                <th class="text-left">Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $tbl_spare_delivery = mysql_query("SELECT * FROM tbl_store")or die(mysql_error());
            while ($row = mysql_fetch_array($tbl_spare_delivery)) {
                $part_number = $row['part_number'];
                $part_common_name = $row['part_common_name'];
                $model = $row['model'];
                $manufacturer = $row['manufacturer'];
                $quantity = $row['quantity'];
                $unit_price = $row['unit_price'];
                $min_qty = $row['min_qty'];
                $specification = $row['specification'];
                $store_id=$row['store_id'];
                $last_date_update=$row['last_date_update'];
                if ($quantity > $min_qty) {
                    $tatus = "Good";
                    $notification = "";
                } else {
                    $tatus = "Not Good";
                    $notification = "bg-red";
                }
                ?>

                <tr class="<?php echo $notification; ?>">
                    <td><input type="checkbox" name="" onchange="inventory(this.value)" value="<?php echo $store_id;?>"></td>
                    <td><?php echo $part_common_name; ?></td>
                    <td class="right"><?php echo $part_number; ?></td>
                    <td class="right"><?php echo $model; ?></td>
                    <td class="right"><?php echo $specification; ?></td>
                    <td class="right"><?php echo $quantity; ?></td>                   
                    <td class="right"><?php echo $min_qty; ?></td>
                    <td class="right"><?php echo $last_date_update; ?></td>                   
                    <td class="right"><?php echo $tatus; ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div id="myModalspare" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Spare Part</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="psparename">Spare Part Name:</label>
                        <input type="text" class="form-control" name="psparename" id="psparename">
                    </div>

                    <div class="form-group">
                        <label for="partnamba">Part Number:</label>
                        <input type="" class="form-control" id="partnamba" name="partnamba">
                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="" class="form-control" id="cnote" name="model">
                    </div>
                    <div class="form-group">
                        <label for="manufacture">Specification:</label>
                        <input type="" class="form-control" id="manufacture" name="manufacture">
                    </div>
                    <div class="form-group">
                        <label for="Description">Description:</label>
                        <textarea class="form-control" rows="5" id="Description" name="Description"></textarea>
                    </div>
                    <input type="submit" name="addspare" value="Add Spare">    
                </form>
            </div>
            <!--      <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>-->
        </div>

    </div>
</div>
<!--model linces-->