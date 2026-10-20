<head>
     <script type="text/javascript">
        $(document).ready(function (e) {
            $("#sub_tpf").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/tpf_process/add_qtn.php",
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







<form  action="" enctype="multipart/form-data" method="post" id="sub_tpf">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Raise Quotation</h4>
    </div>

    <div class="modal-body">
        <div id="kubwa">
        

        </div>       
        <div role="tabpanel">                          
            <div class="tab-content" style="padding:15px 0">
                <div role="tabpanel" class="tab-pane active" id="tab1">

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quotation No:</span></span>
                        <input name="tpf_code" id="product_code" class="form-control" value="<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_GET['qn_codee'];?>"  aria-describedby="sizing-addon1"  type="hidden">
                        <input name="qn_code" id="product_code" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
                        <input name="tpf_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('M d Y'); ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amounts:</span></span>
                        <input name="amount" id="buying_price" class="form-control amount editable" placeholder="Enter Total Amounts" value="<?php echo '';?>" aria-describedby="sizing-addon1" type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quotation Attachment:</span></span>
                        <input name="file" id="product_icon" class="form-control editable" style="width:100%" placeholder="" type="file">
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-default bg-darkBlue shadow fg-white" data-dismiss="modal"><span class="icon-cancel-2" aria-hidden="true"></span> Cancel</button>
            <button type="submit" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                <span class="icon-checkmark " aria-hidden="true"></span> Save </button>
        </div>
    </div>
</form>