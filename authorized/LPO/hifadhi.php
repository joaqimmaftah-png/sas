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
        color: white;
    }
</style>
<script type="text/javascript">//<![CDATA[ 
    window.onload = function () {

        $(function () {
            $('table').on('click', 'tr a', function (e) {
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
 <form  action="?action=add_order_action"  method="post" id="faults_submit">
<div class="row" style="margin-top: 3px;" >
<div class="col-lg-3">
    <button type="submit" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Process PO</button>
        <button class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Home</button>
        <br />
</div>
<div class="col-lg-4">
<!--   details -->
</div>
<div class="col-lg-5">
<!--    <form class="form-inline" role="form"  action=""   method="post" id="rental_form">-->
        
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Customer:</span></span>
                                    <input name="customer" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                    <input name="address" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">city:</span></span>
                                    <input name="city" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="phone" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Contact Name:</span></span>
                                    <input name="contactname" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Email:</span></span>
                                    <input name="email" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
<!--    </form>-->
</div>
</div>


<div class="row" >
   
    <div class="col-lg-12">
       
                                            <table class="table table-striped table-hover bordered" id="invoice-table">
                                    <thead><tr>

                                            <th>No</th>
                                            <th>Description of Goods</th>                                            
                                            <th>Quantity</th>                                         
                                            <th>Amount</th>
                                            <th>Units</th>

                                            <th></th>
                                        </tr></thead>
                                    <tbody  style="font-size:9px">
                                        <tr>

                                             <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:40%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:15%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            
                                             <td style="width:15%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             <td style="width:15%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:5%">
 
                                            </td>
                                        </tr>
                                        <tr id="add">
                                              <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:40%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:15%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             
                                             <td style="width:15%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                           
                                            <td style="width:5%">

                                                <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                            </td>

                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>

            
            
             <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                    <span  aria-hidden="true"></span> + add new row&nbsp;
                                </button>
            <button type="submit" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Process PO</button>
       
    </div>
</div>
 </form>