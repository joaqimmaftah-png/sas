
    <head>
        <style>
            table {
                border-collapse: collapse;
                width:100%;
                border: 1px solid black;
            }

            table, tr, th {
                border: 1px solid black;
                text-align: left;
            }
            table, tr, td.juu {
                border: 1px solid transparent;
            }
            table, tr, td.kati {
                border: 1px solid transparent;
            }
        </style>
                 
         
    </head>
   
    <div class="" style="">

        <div class="container">
            <div style="width:68%">
             <div class="form-group">
  <label for="sel1">Select Pay slip:</label>
  <select class="form-control" id="sel1">
<!--    <option>Jan</option>
    <option>Feb</option>
    <option>Mar</option>
    <option>Apr</option>
    <option>May</option>
    <option>Apr</option>-->
<?php
require_once __DIR__ . '/../../mysql_compat.php';

for ($i = -11; $i <=0; $i++) {
    echo '<option>'.date("M,Y", strtotime("$i month")).'</option>';
}
?>

    
  </select>
</div>
            </div>
        </div>
                <?php
       $emp_file_no=$_GET['emp_file_no'];
        $a=  mysql_query("SELECT * FROM tbl_our_payroll WHERE emp_file_no='$emp_file_no' ") or die(mysql_error());
        $b=  mysql_fetch_array($a);
        $emp_file_no1=$b['emp_file_no'];
                    $salary=$b['salary'];
                    $allowance=$b['allowance'];
                    $travel_allowance=$b['travel_allowance'];
                    $Conveyance_allowance=$b['Conveyance_allowance'];
                    $House_rent_allowance=$b['House_rent_allowance'];
                    $Medical_allowance=$b['Medical_allowance'];
                    $deduction=$b['deduction']; 
                    $paid_month=$b['paid_month'];
                    $paid_datee=$b['paid_datee'];
                    $c=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                    $d=mysql_fetch_array($c);
                    $first_name=$d['first_name'];
                    $surname=$d['surname'];
                    $date_of_birth=$d['date_of_birth'];
                    $name=$first_name.' '.$surname;
                    $e=mysql_query("SELECT SUM(tax_amount),tax_cat_id,tax_amount FROM tbl_tax WHERE employee_id='$emp_file_no'") or die(mysql_error());
                    $f=mysql_fetch_array($e);
                    $tax=$f['SUM(tax_amount)'];
                    $tax_cat_id=$f['tax_cat_id'];
                    $tax_amount=$f['tax_amount'];
                    $r=mysql_query("SELECT * FROM tbl_contract_to_work WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                    $y=mysql_fetch_array($r);
                    $start_date=$y['start_date'];
                    $title_code=$y['title_code'];
                    $o=mysql_query("SELECT * FROM tbl_title where title_code='$title_code'") or die(mysql_error());
                    $p=  mysql_fetch_array($o);
                    $title_name=$p['title_name'];
                    $j=mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                    $g=  mysql_fetch_array($j);
                    $department_id=$g['department_id'];
                    $x=  mysql_query("SELECT * FROM tbl_department WHERE department_id='$department_id'") or die(mysql_error());
                    $z=  mysql_fetch_array($x);
                    $department_name=$z['department_name'];
                    
                    
                    $total_deduction=$deduction+$tax;
                    $total_earm=$salary+$allowance+$travel_allowance+$Conveyance_allowance+$House_rent_allowance+$Medical_allowance;
                    $netpay=$total_earm-$total_deduction;
        
        
        
        
        $date=date("M,Y", strtotime("-1 month"));

                
        ?>
        <div class="container" id="show">
            <div class="" style="width: 800px;" style="border:2px solid black">
                <div style="width:200px;float: left;height: 80px;">

                </div>
                <div style="width:470px; height: 82px;float: left;">
                    <img src="images/logojuu.png" style="width:300px;">  
                    <div class="">
                        <h4 style="margin-left:20px;">Pay Slip for the Period of <?php echo $paid_month;?></h4>
                    </div>
                </div>
                <div style="width:100px;height: 90px;float: left;">
                    <img src="images/logoo.png" style="width:100px; height:90px;">
                </div>
                <div style="clear: both;">               
                </div>

            </div>
            <div class="" style="width: 774px;margin-top: 8px;">
                <div style="float:left; width: 386px;">
                    <table>
                        <tr>
                            <td class="juu">Employee id</td>
                            <td class="juu">:<?php echo $emp_file_no1;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Departments</td>
                            <td class="juu">:<?php echo $department_name;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Date of Birth</td>
                            <td class="juu">:<?php echo $date_of_birth;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Date of Joining</td>
                            <td class="juu">:<?php echo $start_date;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Dates Worked</td>
                            <td class="juu">:25.5</td>
                        </tr>
                    </table>
                </div>
                <div style="float:left; width: 388px;">
                    <table>
                        <tr>
                            <td class="juu">Name</td>
                            <td class="juu">:<?php echo $name;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Designation</td>
                            <td class="juu">:<?php echo $title_name;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Pay Date</td>
                            <td class="juu">:<?php echo $paid_datee;?></td>
                        </tr>
                        <tr>
                            <td class="juu">Bank Name</td>
                            <td class="juu">:<?php echo '';?></td>
                        </tr>
                        <tr>
                            <td class="juu">Bank Account Number</td>
                            <td class="juu">:<?php echo '';?></td>
                        </tr>
                    </table>
                </div>
                <div class="clear: both;"></div>
            </div>

            <div class="" style="width: 780px;margin-top: 8px;background-color: #ffffff;">
                <div style="float:left; width: 384px;border: 1px solid black;border-right: 1px solid black; ">
                    <table>
                        <tr>
                            <th>Earnings</th>
                            <th style=" text-align: right">Amounts</th>
                        </tr>
                        <tr>
                            <td>Basic Pay</td>
                            <td style=" text-align: right"><?php echo number_format($salary);?></td>
                        </tr>
                        <tr>
                            <td>Dearness Allowance</td>
                            <td style=" text-align: right"><?php echo number_format($allowance);?></td>
                        </tr>
                       <tr>
                            <td>Conveyance</td>
                            <td style=" text-align: right"><?php echo number_format($travel_allowance);?></td>
                        </tr>
                        <tr>
                            <td>House Rent Allowance</td>
                            <td style=" text-align: right"><?php echo number_format($House_rent_allowance);?></td>
                        </tr>
                        <tr>
                            <td>Medical Allowance</td>
                            <td style=" text-align: right"><?php echo number_format($Medical_allowance);?></td>
                        </tr>
                        <tr>
                            <th>Total Earnings</th>
                            <th style=" text-align: right"><?php echo 'Tsh&nbsp;'.number_format($total_earm).'/=';?></th>
                        </tr>
                       
                    </table>
                </div>
                <div style="float:left; width: 389px;border: 1px solid black;">
                    <table>
                        <tr>
                            <th style="">Deductions</th>
                            <th style=" text-align: right;">Amount</th>
                             
                        </tr>
                       
                        <tr>
                            <td>Professional Tax</td>
                            <td style=" text-align: right"><?php echo 'Tsh&nbsp;'.number_format($tax_amount).'/=';?></td>
                        </tr>
                        <tr>
                            <td>Provident Fund</td>
                            <td style=" text-align: right"><?php echo '';?></td>
                        </tr>
                         <tr>
                            <td>Other Deduction</td>
                            <td style=" text-align: right"><?php echo '';?></td>
                        </tr>
                        <tr>
                            <td style="height: 48px;vertical-align: bottom;"></td>                          
                        </tr>
                       
                        <tr>
                            <th>Total Deductions</th>
                            <th style=" text-align: right"><?php echo 'Tsh&nbsp;'.number_format($total_deduction).'/=';?></th>
                        </tr>
                        <tr>
                            <th>Net Pay(Rounded)</th>
                            <th style=" text-align: right"><?php echo 'Tsh&nbsp;'.number_format($netpay).'/=';?></th>
                        </tr>
                    </table>
                </div>
                <div class="clear: both;"></div>
            </div>

        </div>

</div>
<div class="container">
    <button id="print"><i class="icon-file-pdf fg-red"></i>&nbsp;Print</button>
    </div>