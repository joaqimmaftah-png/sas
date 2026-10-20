<head>
     <script type="text/javascript">
        $(document).ready(function (e) {
            $("#sub_tpf").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/tpf_process/add_tpf.php",
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
        <h4 class="modal-title" id="myModalLabel">Raise TPF</h4>
    </div>

    <div class="modal-body">
        <div id="kubwa">
        

        </div>       
        <div role="tabpanel">                          
            <div class="tab-content" style="padding:15px 0">
                <div role="tabpanel" class="tab-pane active" id="tab1">
 <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TPF Name:</span></span>
                        <input name="tpf_name" id="buying_price" class="form-control amount editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TPF No:</span></span>
                        <input name="tpf_code" id="product_code" class="form-control" value="<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_GET['tpf_code']; ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
                        <input name="tpf_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('M d Y'); ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div> 
                    <div class="input-group" style="width:100%; margin:10px 0">
                       <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Country:</span></span>
<select class="form-control" name="region_id" id="category_id">
<option value="1">MTWARA</option>
<option value="2"> MBEYA</option>
<option value="3"> IRINGA</option>
<option value="4"> PWANI</option>
<option value="5"> NJOMBE</option>
<option value="6"> RUVUMA</option>
<option value="7"> LINDI</option>
</select>
                    </div> 
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Number of Site:</span></span>
                        <input name="no_of_tpf" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                    </div> 

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TPF Attachment:</span></span>
                        <input name="file" id="product_icon" class="form-control editable" style="width:100%" placeholder="" type="file">
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