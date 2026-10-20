<head>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#sub_workorder").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/tpf_process/submit_workorder.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#kubwa").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
</head>   

<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
$QTN = $_GET['qn_coding'];
$bb = mysql_query("SELECT * FROM  tbl_tpf_qt WHERE Quotation_No='$QTN'")or die(mysql_error());
$cc = mysql_fetch_array($bb);
$num = $cc['tpf_no'];
$tpf_name = $cc['tpf_name'];
$tpf_qt_id=$cc['tpf_qt_id'];
?>





<form  action="" enctype="multipart/form-data" method="post" id="sub_workorder">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Work Order</h4>
    </div>

    <div class="modal-body">
        <div id="kubwa">


        </div>      
        <div role="tabpanel">                          
            <div class="tab-content" style="padding:15px 0">
                <div role="tabpanel" class="tab-pane active" id="tab1">

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TPF No:</span></span>                         
                        <input name="tpf_code" id="product_code" class="form-control" value="<?php echo $num; ?>"   aria-describedby="sizing-addon1" readonly="">

                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quotation No:</span></span>
                        <input name="qt_code" id="product_code" class="form-control" value="<?php echo $_GET['qn_coding']; ?>"  aria-describedby="sizing-addon1" readonly="">

                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Job:</span></span>
                        <input name="job" id="buying_price" class="form-control amount editable" placeholder="" value="<?php echo $tpf_name; ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Work Order:</span></span>
                        <input name="workorder" id="buying_price" class="form-control amount editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1"  type="text">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Site ID:</span></span>
                        <input name="siteid" id="buying_price" class="form-control amount editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1"  type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
                        <input name="workorder_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('M d Y'); ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-default bg-darkBlue shadow fg-white" href="?action=workorder"><span class="icon-cancel-2" aria-hidden="true"></span>&nbsp;Closed</a>
<!--            <a href="?action=workorder"><button type="button" class="btn btn-default bg-darkBlue shadow fg-white" data-dismiss="modal"><span class="icon-cancel-2" aria-hidden="true"></span> Close</button></a>-->
            <button type="submit" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                <span class="icon-checkmark " aria-hidden="true"></span> Save </button>
        </div>
    </div>
</form>