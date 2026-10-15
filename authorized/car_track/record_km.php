
<script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementById("show_data").innerHTML = "";
                document.getElementById("show_data").style.border = "0px";
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
                    document.getElementById("show_data").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/search_car.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    
    <script>
        function shoform(str) {
            if (str.length == 0) {
                document.getElementById("show_form").innerHTML = "";
                document.getElementById("show_form").style.border = "0px";
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
                    document.getElementById("show_form").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/show_search_reg_no.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

<script type="text/javascript">
                   $(document).ready(function () {
            var url = "authorized/car_track/load_km_record.php";

            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'check' },
                    { name: 'vehicle_reg_num' },
                    { name: 'make' },
                    { name: 'model' },
                    { name: 'Drivername' },
                    { name: 'location' },
                    { name: 'current_km'},
                    { name: 'Drivercontact'},
                    { name: 'last_km'},
                    { name: 'last_served_date'}                  
                      
                     
                 
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height:530,
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                    { text: 'Action', datafield: 'check', width:'7%'},
                    { text: 'Vehicle Registration #', datafield: 'vehicle_reg_num', width:'11%'},
                     { text: 'Make', datafield: 'make', width:'10%'},
                  { text: 'Model', datafield: 'model', width:'10%'},  
                  { text: 'Driver Name', datafield: 'Drivername', width:'11%'}, 
                  { text: 'Centre', datafield: 'location', width:'10%'},
                   { text: 'Phone Number', datafield: 'Drivercontact', width:'10%'},
                  { text: 'Current Km', datafield: 'current_km',width:'10%'},
                  { text: 'Last Km', datafield: 'last_km', width:'10%'},
                  { text: 'Last Record Date', datafield: 'last_served_date', width:'11%'}                
                  
                ]
            });
            
                      
            
            
        });
    </script>
    <div class="col-lg-12" style="margin-bottom: 3px;margin-top: 2px;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_km" style="color:white"><i class="glyphicon glyphicon-plus"></i>Add New Record</button>
       <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i>&nbsp;Reload</button>
        
    </div>   
        <div class="col-lg-12">
        <div id="jqxgrid">
    </div>
   
    </div>
    
    
    <div id="add_km" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="">
            <form  action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Record New Kilometer</h4>
                </div>

                <div class="modal-body ">
                    <div id="kubwa">
                    </div> 
                    
                    <div role="tabpanel">
                         <div class="row">
                        <div class="col-lg-12">
                             <div class="">
                    <div class="input-control text">
                        <input type="text" name="" placeholder="Search By Vehicle Registration Number" onkeyup="showResult(this.value)" />
                        <button class="btn-search"></button>
                    </div>
                </div>

                <div class="" id="show_data">
                    <!--                  show data-->
                </div>
                            <div class="" id="show_form">
                    <!--                  show data-->
                     <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Registration Number:</span></span>
                            <input name="" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly="" type="text">
                            
                        </div>
                </div>
                        </div>
                    </div>  
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Date:</span></span>
                            <input name="current_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date("d-m-Y")?>" readonly="" aria-describedby="sizing-addon1"  type="text">
                            
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Reading Kilometer:</span></span>
                            <input name="current_km" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                           
                        </div>                      
                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_km" class="btn btn-primary">Submit</button>
                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>
<!--model linces-->
        