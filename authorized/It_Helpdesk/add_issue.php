<?php
require_once __DIR__ . '/../../mysql_compat.php';

$result11 = mysql_query("SELECT * from tbl_employee") or die(mysql_error());
$employee_name = mysql_fetch_array($result11);

$first_name=$employee_name['first_name'];
$last_name=$employee_name['surname'];


if (isset($_POST['submit_issue'])) {       

    $e_name = $_POST['employee_name'];
    $issue_descrip = $_POST['issue_description'];
    $s_date = $_POST['start_date'];
    $e_date = $_POST['end_date'];
    $i_category = $_POST['issue_category'];
    $assigned_to = $_POST['assigned_to'];
    $d_name = $_POST['department_name'];
    $issue_status = $_POST['issue_status'];  
    
    
    $insert_issue = mysql_query("INSERT INTO tbl_it_helpdesk(`issue_description`, `employee_username`, `start_date`, `end_date`, `issue_category`, `assigned_to`, `department`, `status`)"
                . "VALUE('$issue_descrip','$e_name', '$s_date', '$e_date', '$i_category', '$assigned_to', '$d_name', '$issue_status')") or die(mysql_error());
    
    
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


<form  action="home_goods_received_note.php"  method="post">         
    <div class="row" style="margin-top: 3px;">  
        <div class="col-lg-4">
            <div class="input-group" style="width:100%; margin:2px 0"> 
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Employee_name:</span></span>
                <select name="employee_name" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">              
               
                    <option value="">choose name</option>
                    <option value="<?php echo $first_name.' '.$last_name;?>"></option>
                    
                   </select>
                   </div> 
            
            <div class="input-group" style="width:100%; margin:2px 0"> 
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Issue_description:</span></span>
                <input name="issue_description" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">              

               </div>
            
            <div class="input-group" style="width:100%; margin:2px 0"> 
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Start_date:</span></span>
                <input name="start_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('d-m-Y');?>" aria-describedby="sizing-addon1" type="date">

               </div> 
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">End_date:</span></span>
                <input name="end_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo date('d-m-Y');?>" aria-describedby="sizing-addon1" type="date">

               </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Issue Category:</span></span>
                <select name="issue_category" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                    <option value="">choose category</option>
                    <option value="normal">Normal</option>
                    <option value="high_priority">High priority</option>
                    
                </select>
               </div>
            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Assigned to:</span></span>
                <select name="assigned_to" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                    <option value="">choose name</option>
                    <option value="<?php echo $first_name.' '.$last_name;?>"><?php echo $first_name.' '.$last_name;?></option>
                    </select>
               </div>
                       
            <div class="input-group" style="width:100%; margin:2px 0"> 
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">department:</span></span>
                <input name="department_name" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

            </div>
            
            <div class="input-group" style="width:100%; margin:2px 0"> 
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                <select name="issue_status" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                    <option value="">Choose status</option>
                    <option value="Done">Done</option>
                    <option value="On Progress">On Progress</option>
                    </select>
                </div>
               
    </div>
        
    <div class="col-lg-12">
            
            <button type="submit" class="btn btn-success" name="submit_issue" style="color:white"><i class="fa fa-arrow-up"></i>Submit Issue</button>

        </div>                        
    </div>
    
</form>       


