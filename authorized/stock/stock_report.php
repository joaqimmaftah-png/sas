<?php

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

$re=mysql_query("UPDATE `tbl_spare_parts` SET `part_number`='$partnumber',`part_common_name`='$partname',`description`='$descr',`model`='$model',`specification`='$spec',`manufacturer`='$manufacturer',`quantity`='$Quantity' WHERE `part_id`='$partid'") or die(mysql_error());
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
$date=date('Y-m-d H:i:s');
$re=mysql_query("INSERT INTO `tbl_spare_parts`(`part_number`, `part_common_name`, `description`, `model`, `specification`, `manufacturer`,`quantity`, `entry_date`) VALUES ('$partnumber','$partname','$descr','$model','$spec','$manufacturer','$Quantity','$date')") or die(mysql_error());
echo '<div class="alert alert-success alert-dismissable error">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Changes made successfully
</div>'; 
    }
    
    

}
?>




<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/stock/load_report.php";
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                           
                            
                            {name: 'No'},
                            {name: 'part_common_name'},
                            {name: 'part_number'},
                            {name: 'model'},
                            {name: 'specification'},
                            {name: 'quantity'},
                            {name: 'stockout'},
                            {name: 'spare_requested'},
                                                   
                        ],
                        id: 'id',
                        url: url,
                        root: 'data' 
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
                    {
                        width: '100%',
                        height: 551,
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
               
                        columns: [
                            
                            {text: 'No', datafield: 'No', width: '7%'},
                            {text: 'Part Name', datafield: 'part_common_name', width: '20%'},
                            {text: 'Part Number', datafield: 'part_number', width: '10%'},
                            {text: 'Model', datafield: 'model', width: '15%'},
                            {text: 'Specification', datafield: 'specification', width: '25%'},
                            {text: 'StockIn', datafield: 'quantity', width: '6%'},
                            {text: 'StockOut', datafield: 'stockout', width: '6%'},
                            {text: 'Spare Requested', datafield: 'spare_requested', width: '11%'},
                        ],
                        
                    });         
        });
        
        
        
    </script>
</head>
<div class="row" >


    <div class="col-lg-12">
        <div id="jqxgrid" >
        </div>
    </div>
</div>




