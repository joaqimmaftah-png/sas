<?php
$yusin = mysql_query("SELECT * from tbl_goods_received_order ORDER BY goods_id DESC") or die(mysql_error());
$yusta = mysql_fetch_array($yusin);
$idss = $yusta['goods_id'] + 1;
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


<form  action="home_goods_received_note.php"  method="post"> 
    

    
    <div class="row" style="margin-top: 3px;" >


        <div class="col-lg-4">

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                <input name="supplier" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                <input name="ids" id="product_name" class="form-control editable"  value="<?php echo $idss; ?>" aria-describedby="sizing-addon1" type="hidden">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Number:</span></span>
                <input name="delivery_number" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>          
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Date:</span></span>
                <input name="delivery_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('d-m-Y');?>" aria-describedby="sizing-addon1" type="date">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Number:</span></span>
                <input name="invoice_no" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Date:</span></span>
                <input name="invoice_date" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="date">

            </div>

        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-5">
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Current Date:</span></span>
                <input name="date" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="date">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of Payment:</span></span>
                <input name="mode_of_payment" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Ewura Levy:</span></span>
                <input name="ewura_levy" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VAT(18%):</span></span>
                <input name="vat" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>


        </div>
    </div>
    
    <div class="row" style="margin-top: 3px;">
     <div class="col-lg-12">

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:center"><span class="text-right"> GRN TITLE:</span></span>
                <input name="title" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
             </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-12">

            <table class="table table-striped table-hover bordered" id="invoice-table">
                <thead><tr>

                        <th>Code</th>
                        <th>Item</th>                                            
<!--                        <th>Description</th>                                         -->
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>

                        <th></th>
                    </tr></thead>
                <tbody  style="font-size:9px">
                    <tr>

                        <td style="width:10%">
                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:25%">
                           <div class="form-group">
  <select class="form-control" name="item[]">
      <option value="">Select item</option>
      <?php
      $cv = mysql_query("SELECT * from tbl_spare_parts ORDER BY part_common_name") or die(mysql_error());
      while ($ds = mysql_fetch_array($cv)) {
      ?>
      <option value="<?php echo $ds['part_id'];?>"><?php echo $ds['part_common_name'].' | '.$ds['specification'];?></option>
      <?php
      }
      ?>
  </select>
</div>
                           
                        </td>                                           
<!--                        <td style="width:15%">
                            <input name="desc[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>-->

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

                        </td>
                    </tr>
                    
                    <tr id="add"> 
                        <td style="width:10%">
                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:25%">
                        <select class="form-control" name="item[]">
                                <option value="">Select item</option>
      <?php  
      $cv = mysql_query("SELECT * from tbl_spare_parts ORDER BY part_common_name") or die(mysql_error());
      while ($ds = mysql_fetch_array($cv)) {
      ?>
      <option value="<?php echo $ds['part_id'];?>"><?php echo $ds['part_common_name'].' | '.$ds['specification'];?></option>
      <?php
      }
      ?>
                        </select>   
                        </td>                                           
<!--                        <td style="width:15%">
                            <input name="desc[]" value="" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>-->

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
            <button type="submit" class="btn btn-success" name="add_goods_received" style="color:white"><i class="fa fa-arrow-up"></i>Submit Data</button>

        </div>
    </div>
</form>    


