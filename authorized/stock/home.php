<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['submitmaterial'])){
$partid=$_POST['part_id'];
    
    if(!empty($partid)){
       $partid=$_POST['part_id'];
$partname=$_POST['partname'];
$partnumber=$_POST['partnumber'];
$descr=$_POST['description'];
$model=$_POST['model'];
$spec=$_POST['spec'];
$manufacturer=$_POST['Manufacturer']; 
$Quantity=$_POST['Quantity'];
$date1=date('Y-m-d');
$report_date1=date('Ymd'); 
$user= $_SESSION["emp_file_no"];   

$re=mysql_query("UPDATE `tbl_spare_parts` SET `part_number`='$partnumber',`part_common_name`='$partname',`description`='$descr',`model`='$model',`specification`='$spec',`manufacturer`='$manufacturer',`quantity`='$Quantity', `report_date`='$report_date1', `id_user`='$user', `entry_date`='$date1' WHERE `part_id`='$partid'") or die(mysql_error());
echo '<div class="alert alert-success alert-dismissable error">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Changes made successfully
</div>';  
    }
 else {
      $partid=$_POST['part_id'];
$partname=$_POST['partname'];
$partnumber=$_POST['partnumber'];
$descr=$_POST['description'];
$model=$_POST['model'];
$spec=$_POST['spec'];
$manufacturer=$_POST['Manufacturer'];
$Quantity=$_POST['Quantity'];
$date=date('Y-m-d');
$report_date=date('Ymd');
$user_id= $_SESSION["emp_file_no"];

$re=mysql_query("INSERT INTO `tbl_spare_parts`(`part_number`, `part_common_name`, `description`, `model`, `specification`, `manufacturer`,`quantity`, `entry_date`,`report_date`, `id_user`) VALUES ('$partnumber','$partname','$descr','$model','$spec','$manufacturer','$Quantity','$date', '$report_date', '$user_id')") or die(mysql_error());
echo '<div class="alert alert-success alert-dismissable error">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Changes made successfully
</div>'; 
    }
    
    

}
?>


<?php
if(isset($_POST['m'])){
$from=$_POST['from'];
$to=$_POST['to'];
    $url='authorized/stock/load_material.php?from='.$from.'&to='.$to;
}
 else {
    $url="authorized/stock/load_material.php";
}
?>


<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "<?php echo $url;?>";
           
            // prepare the data
            var source =
                    {
                        datatype: "json",
          datafields: [
                           
                            {name: 'Action'},
                            {name: 'No'},
                            {name: 'part_common_name'},
                            {name: 'part_number'},
                            {name: 'model'},
                            {name: 'specification'},
                            {name: 'quantity'},
                            {name: 'min_quanty'},
                            {name: 'entry_date'},
                            {name: 'status'}
                                                   
                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#mj").jqxGrid(
                    {
                        width: '100%',
                        height: '1200',
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
                  columns: [
                            {text: 'Action', datafield: 'Action', width: '5%'},
                            {text: 'No', datafield: 'No', width: '5%'},
                            {text: 'Part Name', datafield: 'part_common_name', width: '20%'},
                            {text: 'Part Number', datafield: 'part_number', width: '10%'},
                            {text: 'Model', datafield: 'model', width: '10%'},
                            {text: 'Specification', datafield: 'specification', width: '20%'},
                            {text: 'Quantity', datafield: 'quantity', width: '6%'},
                            {text: 'Min Qty', datafield: 'min_quanty', width: '6%'},
                            {text: 'Last Update', datafield: 'entry_date', width: '8%'},
                            {text: 'Status', datafield: 'status', width: '10%'}
                        ],
                    });

            $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'xls', 'SSW_INVENTORY');
            });

            $("#csvExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'csv', 'SSW_INVENTORY');
            });

            $("#pdfExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'pdf', 'SSW_INVENTORY');
            });



        });
    </script>


</head>

<div class="row">
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style=" margin: 5px 0px 5px 0px;" >

            <nav class="horizontal-menu compact">
                <ul>
                    
                    <li >
                        <a class="" style="" href="?" >Home</a>
                    </li>
                     <li >
                        <a class="" style="" href="#" data-toggle="modal" data-target="#myModal">Add New Material</a>
                    </li>
                     <li >
                        <a class="" style="" href="?action=stock_report" >Stock Report</a>
                    </li>


                </ul>
            </nav>
        </div>

    </div>
   </div>
<br>


<div class="row">  
       <div class="col-lg-12 col-xs-12">
                       <form action="" method="POST" id="search_date">
                         <div class="col-lg-4">
        <div class="input-group date ">
                    <input class="form-control"  name="from" placeholder="From Date (dd-mm-yyyy)" type="date" value="" >
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-4">
        <div class="input-group date " >
                    <input class="form-control"  name="to" placeholder="To date (dd-mm-yyyy)" type="date" value="" >
                    
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-1">
        
        <button class="btn btn-default" type="submit" name="m" ><i class="glyphicon glyphicon-search"></i> Search</button>
        </div> 
            <div class="col-lg-3">

                </div> 
                    </form>
                    </div>
    
                <br/>
                </div>




<div class="row" style=" margin-top: 2%;">
         
   <div class="col-lg-12">
<!--                     <button type="button" class="btn btn-default" id='excelExport' ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>-->
        
            <div style='float: left;'>
                <button type="button" class="btn btn-success" value="Export to Excel" id='excelExport'>Export to excel</button>
                
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" class="btn btn-success" value="Export to CSV" id='csvExport' />
                
            </div>
           
        
                </div>
    <hr>

</div>
<div class="row" >

<br>
    <div class="row">
    <div class="col-lg-12" id="mud">
                   <div id="mj" >
        </div>
        
                </div>
</div>
      
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="POST">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Part Name</span></span>
                                <input name="part_id"  id="id" class="form-control editable"   value="" aria-describedby="sizing-addon1" type="hidden">
                                <input name="partname"  id="a" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Part Number</span></span>
                                <input name="partnumber"  id="b" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description</span></span>
                                <input name="description"  id="c" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model</span></span>
                                <input name="model"  id="d" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Specification</span></span>
                                <input name="spec"  id="e" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Manufacturer</span></span>
                                <input name="Manufacturer"  id="f" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Quantity</span></span>
                                <input name="Quantity"  id="g" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                            </div>
                            <br>
                            <div class="col-lg-12">
                        <button type="submit" class="btn btn-success" name="submitmaterial" style="color:white"><i class="glyphicon glyphicon-plus"></i>Submit</button>
                       </div>
                        </form>
                    </div>   

                </div>
            </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
     
    </div>

  </div>




