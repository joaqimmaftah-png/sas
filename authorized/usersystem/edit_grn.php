<?php
require_once __DIR__ . '/../../mysql_compat.php';

$goods_id=$_GET['goods_id'];
$yusin = mysql_query("SELECT * from tbl_goods_received_order WHERE goods_id='$goods_id'") or die(mysql_error());
$yusta = mysql_fetch_array($yusin); 

$delivery_number=$yusta['delivery_number'];
$supplier=$yusta['supplier'];
$destination=$yusta['destination'];
$grn_no=$yusta['grn_no'];
$date=$yusta['date'];
$mode_of_payment=$yusta['mode_of_payment'];
$vat=$yusta['VAT'];
$ewura_levy=$yusta['ewura_levy'];
$delivary_note=$yusta['delivary_note'];
$delivary_date=$yusta['delivary_date'];
$invoice_number=$yusta['invoice_number'];
$invoice_date=$yusta['invoice_date'];
$title=$yusta['Title'];


//$idss = $yusta['goods_id'] + 1;


  if(isset($_POST['update_goods_received'])){
      $goods_id=$_GET['goods_id'];
      $supplier=$_POST['supplier'];
      $delivery_number=$_POST['delivery_number'];
      $delivery_date=$_POST['delivery_date'];
      $invoice_no=$_POST['invoice_no'];
      $invoice_date=$_POST['invoice_date'];
      $date=$_POST['date'];
      $mode_of_payment=$_POST['mode_of_payment'];
      $ewura_levy=$_POST['ewura_levy'];
      $vat=$_POST['vat'];
      $title=$_POST['title'];
      $item=$_POST['item'];
      $desc=$_POST['desc'];
      $unit=$_POST['unit'];
      $quantity=$_POST['quantity'];
      $unit_price=$_POST['unit_price'];
      $list_id=$_POST['list_id'];
      
      
      $grnw= mysql_query("SELECT * FROM `tbl_goods_received_order` WHERE `goods_id`='$goods_id'")or die(mysql_error());
      $ren= mysql_num_rows($grnw);
      
      if(empty($ren)){
      
          echo 'error';
          
      } 
      
      else {
          
          $rnm=  mysql_query("UPDATE `tbl_goods_received_order` SET supplier='$supplier', delivery_number='$delivery_number', delivary_date='$delivery_date', invoice_number='$invoice_no', invoice_date='$invoice_date', date='$date', mode_of_payment='$mode_of_payment', ewura_levy='$ewura_levy', VAT='$vat', Title='$title' WHERE `goods_id`='$goods_id'") or die(mysql_error());
          
             if($rnm){
          
          for ($i = 0; $i < sizeof($item); $i++) {
               $tun=  mysql_query("UPDATE `tbl_goods_received_list` SET `item`='$item[$i]', `descr`='$desc[$i]', `units`='$unit[$i]', `quantity`='$quantity[$i]', `units_price`='$unit_price[$i]' WHERE `list_id`='$list_id[$i]'")or die(mysql_error());     
             
                }
          
      }
          
          
      }
       
      
      }
      

  
?>
      
          

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }  

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #4CAF50;
            /*        color: white;*/
        }
    </style>
    <script type="text/javascript">//<![CDATA[ 
        window.onload = function () {

            $(function () {
                $('table').on('click', 'tr a.delete', function (e) {
                    e.preventDefault();
                    $(this).parents('tr').remove();
                });

                $("#add-invoice-row").click(function () {
                    $("#invoice-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });




            });
        };




        //]]>  
    </script>
</head>





<form  action=""  method="post" > 
    

    
    <div class="row" style="margin-top: 3px;" >


        <div class="col-lg-4">

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                <input name="supplier" id="product_name" class="form-control editable" placeholder="" value="<?php echo $supplier;?>" aria-describedby="sizing-addon1" type="text">
                <input name="ids" id="product_name" class="form-control editable"  value="<?php echo $goods_id; ?>" aria-describedby="sizing-addon1" type="hidden">
                

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Number:</span></span>
                <input name="delivery_number" id="product_name" class="form-control editable" placeholder="" value="<?php echo $delivery_number;?>" aria-describedby="sizing-addon1" type="text">

            </div>          
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Date:</span></span>
                <input name="delivery_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $delivary_date;?>" aria-describedby="sizing-addon1" type="date">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Number:</span></span>
                <input name="invoice_no" id="product_name" class="form-control editable" placeholder="" value="<?php echo $invoice_number;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Date:</span></span>
                <input name="invoice_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $invoice_date;?>" aria-describedby="sizing-addon1" type="date">

            </div>

        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-5">
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Current Date:</span></span>
                <input name="date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $date;?>" aria-describedby="sizing-addon1" type="date">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of Payment:</span></span>
                <input name="mode_of_payment" id="product_name" class="form-control editable" placeholder="" value="<?php echo $mode_of_payment;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Ewura Levy:</span></span>
                <input name="ewura_levy" id="product_name" class="form-control editable" placeholder="" value="<?php echo $ewura_levy;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VAT(18%):</span></span>
                <input name="vat" id="product_name" class="form-control editable" placeholder="" value="<?php echo $vat;?>" aria-describedby="sizing-addon1" type="text">

            </div>


        </div>
    </div>
    
    <div class="row" style="margin-top: 3px;" >
     <div class="col-lg-12">

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:center"><span class="text-right"> GRN TITLE:</span></span>
                <input name="title" id="product_name" class="form-control editable" placeholder="" value="<?php echo $title;?>" aria-describedby="sizing-addon1" type="text">
             </div>
        </div>
</div>


    <div class="row" >

        <div class="col-lg-12">

            <table class="table table-striped table-hover bordered" id="invoice-table">
                <thead>
                    <tr>

                        <th>Code</th>
                        <th>Item</th>                                            
                        <th>Description</th>                                         
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody  style="font-size:9px">
                    
                    <?php
                    
                    
                    
                    
                    
                    $j=1;
 $grn=  mysql_query("SELECT * FROM tbl_goods_received_list WHERE reference='$goods_id'")or die(mmysql_error());
 while ($gre=  mysql_fetch_array($grn)){

$item=$gre['item'];
$list_id=$gre['list_id'];
$descr=$gre['descr'];
$units=$gre['units'];
$quantity=$gre['quantity'];
$units_price=$gre['units_price'];
$part_id=$gre['part_id'];


      $cvv = mysql_query("SELECT * from tbl_spare_parts WHERE `part_id`='$part_id'") or die(mysql_error());
      $dss = mysql_fetch_array($cvv);
      $part_name=$dss['part_common_name'];
      $description=$dss['description'];
      $part_id=$dss['part_id'];

                    
                    ?>
                    <tr>
                        

                        <td style="width:10%">
                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text" value="<?php echo $j++;?>">
                        </td>
                        <td style="width:25%">
                            
     <div class="form-group">
     <select class="form-control" name="item[]">
      <option value="<?php echo $part_id;?>"><?php echo $part_name;?></option>
      <?php
      $cv = mysql_query("SELECT * from tbl_spare_parts") or die(mysql_error());
      while ($ds = mysql_fetch_array($cv)) {
          
          
      ?>
      <option value="<?php echo $ds['part_id'];?>"><?php echo $ds['part_common_name'];?></option>
      <?php
      }
      ?>
      </select>
      </div>
                           
                        </td>                                           
                        <td style="width:15%">
                            <input name="desc[]" value="<?php echo $description;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                            <input name="list_id[]" value="<?php echo $list_id;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="hidden">
                        </td>

                        <td style="width:15%">
                            <input name="unit[]" value="<?php echo $units;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="quantity[]" value="<?php echo $quantity;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="unit_price[]" value="<?php echo $units_price;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:5%">

                        </td>
                    </tr>
                    
                    <?php
                    
                     }
 
                    ?>
                    
                    
                    <tr id="add"> 
                        <td style="width:10%">
                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:25%">
                        <select class="form-control" name="item[]">
                            <option value="">select item</option> 
      <?php
      $cvt = mysql_query("SELECT * from tbl_spare_parts") or die(mysql_error());
      while ($dsm = mysql_fetch_array($cvt)) {
      ?>
      <option value="<?php echo $dsm['part_id'];?>"><?php echo $dsm['part_common_name'];?></option>
      <?php
      }
      ?>
                        </select>
                        </td>                                           
                        <td style="width:15%">
                            <input name="desc[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>

                        <td style="width:15%">
                            <input name="unit[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="quantity[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="unit_price[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>

                        <td style="width:5%">

                            <a href="#" class="cross-delete btn btn-success fg-white delete" >x</a> 
                        </td>

                    </tr>


                </tbody>
            </table>



            <button type="button" id="add-invoice-row"  class="btn btn-success">
                <span  aria-hidden="true"></span> + add new row&nbsp;
            </button>
            <button type="submit" class="btn btn-success" name="update_goods_received" style="color:white"><i class="fa fa-arrow-up"></i>Submit Data</button>
        </div>
    </div>
</form>


