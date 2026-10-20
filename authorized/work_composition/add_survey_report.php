


<?php
require_once __DIR__ . '/../../mysql_compat.php';

$id=$_SESSION["emp_file_no"];

?>

<head>
 <script type="text/javascript">

    $(document).ready(function (e) {
        $("#create_survey").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({url: "authorized/work_composition/submit_survey.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#successv").html(data);
//                        $("#notice_div").html('');
                },
                error: function () {
                }
            });
        }));
    });
</script>
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

<div class="row">
    <div class="col-lg-12" id="successv">
        
    </div>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">SITE COMPLETION REPORT</a></li>
  <li><a data-toggle="tab" href="#menu1">DESCRIPTION OF WORK DONE</a></li>
  <li><a data-toggle="tab" href="#menu2">ADDITIONAL WORK REQUIRED</a></li>
  <li><a data-toggle="tab" href="#menu3">REMARKS(RECOMMENDATIONS)</a></li>
   <li><a data-toggle="tab" href="#menu4">INVOICE INSTRUCTIONS</a></li>
</ul>
<form  action="" method="POST" id="create_survey">
<div class="tab-content">
    <!--mwanzo-->
  <div id="home" class="tab-pane fade in active">
      <div class="row" style="margin-top:1%">
    <div class="col-lg-12">
        <div class="alert alert-success">
  <strong>Work Completion Report</strong>
</div>
    </div>
    
        <!--////////////////////////////////////////////////////////////////////////////////////////-->
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Site Address:</span></span>        
                <input name="siteaddress" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                <input name="emplo"  class="form-control editable"  value="<?php echo $id;?>" aria-describedby="sizing-addon1"  type="hidden">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Customer Name:</span></span>
                <input name="customer" id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Work Area:</span></span>
                <input name="workarea" id="d" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Call Received Time:</span></span>
                <input name="call_received_time" id="e" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Date:</span></span>
                <input name="Date" id="f" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Project?:</span></span>
<span class="input-group-addon">
        <input type="checkbox" name="project" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="project" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
           
            </div>
        </div> 
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">JOB No:</span></span>
                <input name="jobnumber" id="j" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div> 
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Equip Running Time:</span></span>
                <input name="eqp_remain_time" id="k" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div> 
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Repair?</span></span>
<!--                <input name="repaire" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">-->
<span class="input-group-addon">
        <input type="checkbox" name="repaire" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="repaire" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
           
            </div>
        </div>
<div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Control Contact In:</span></span>
                <input name="coun_in" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Control Contact Out:</span></span>
                <input name="coun_outt" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Service/Routine:</span></span>
                <!--<input name="service" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">-->
<span class="input-group-addon">
        <input type="checkbox" name="service" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="service" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
          
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Time In:</span></span>
                <input name="timein" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Time Out:</span></span>
                <input name="timeout" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">refuel?</span></span>
                <!--<input name="fuel" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">-->
<span class="input-group-addon">
        <input type="checkbox" name="fuel" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="fuel" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
          
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Equipment Ref No.:</span></span>
                <input name="Eqpment_refno" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Serial Number:</span></span>
                <input name="serialno" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Inspection?</span></span>
                <!--<input name="inspection" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">-->
<span class="input-group-addon">
        <input type="checkbox" name="inspection" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="inspection" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
          
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Model:</span></span>
                <input name="model" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:38%; text-align:right"><span class="text-right">Make/Type:</span></span>
                <input name="make_type" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Site Cleaning?</span></span>
                <!--<input name="site_clean" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">-->
<span class="input-group-addon">
        <input type="checkbox" name="site_clean" value="YES" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">YES</span>
      <span class="input-group-addon">
        <input type="checkbox" name="site_clean" value="NO" id="rquest" aria-label="Checkbox for following text input">
      </span>
      <span class="input-group-addon">NO</span>
      <input type="text" placeholder="Choose One" class="form-control" aria-label="Text input with checkbox">
          
            </div>
        </div>
         <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Closing Ref No.</span></span>
                <input name="closeref" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

            </div>
        </div>
      
      
    </div>  
  </div>
<!--EndHome-->

  <div id="menu1" class="tab-pane fade">
      <div class="row" style="margin-top:1%">
                  <div class="col-lg-12">
        <div class="alert alert-success">
  <strong>DESCRIPTION OF WORK DONE</strong>
</div>
    </div>
        <div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <!--<span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Resolution:</span></span>-->
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="description[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
      </div>
  </div>
  <div id="menu2" class="tab-pane fade">
      <div class="row" style="margin-top:1%">
          
                 <div class="col-lg-12">
        <div class="alert alert-success">
  <strong>ADDITIONAL WORK REQUIRED</strong>
</div>
    </div>
        <div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <!--<span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Resolution:</span></span>-->
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
        <input name="additional[]" id="ab" class="form-control editable border-bottom" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
      </div>
  </div>
    <div id="menu3" class="tab-pane fade">
   <div class="row" style="margin-top:1%">
             <div class="col-lg-12">
        <div class="alert alert-success">
  <strong>REMARKS (RECOMMENDATION)</strong>
</div>
    </div>
        <div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <!--<span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Resolution:</span></span>-->
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
         <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
        <input name="remarks[]" id="ab" class="form-control editable border-bottom" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">
       
    </div>
</div>
      </div>
  </div>
     <div id="menu4" class="tab-pane fade">
         <div class="row" style="margin-top:1%">
    <div class="col-lg-12">
<!--        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">M:</span></span>
                                    <input name="titles" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>-->
    </div>
    <div class="col-lg-12">
       
                                            <table class="table table-striped table-hover bordered" id="invoice-table">
                                    <thead><tr>

                                            <th>No</th>
                                            <th>Description</th>  
                                            <th>Part Number</th> 
                                            <th>Units</th>
                                            <th>Quantity</th>                                         
                                            <th>Amount</th>
                                            

                                            <th></th>
                                        </tr></thead>
                                    <tbody  style="font-size:9px">
                                        <tr>

                                             <td style="width:7%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:30%">
                                                <input name="descri[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>  
                                            <td style="width:15%">
                                                <input name="partnumber[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>  
                                             <td style="width:15%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                             <td style="width:13%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:5%">
 
                                            </td>
                                        </tr>
                                        <tr id="add">
                                             <td style="width:7%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:30%">
                                                <input name="descri[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>  
                                            <td style="width:15%">
                                                <input name="partnumber[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>  
                                             <td style="width:15%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                             <td style="width:13%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
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
           
       
    </div>
</div>
  </div>
</div>
<hr>
<div class="col-lg-12">
            <button type="submit" class="btn btn-success" name="site_survey" style="color:white"><i class="glyphicon glyphicon-plus"></i> SITE SURVEY</button>
        </div>
</form>



 
           
        
        
        
        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
<!--    </form>
</div>-->
