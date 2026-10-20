<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once __DIR__ . '/../db.php';
                $a= mysql_query("select * from tbl_accounts")or die(mysql_error());
                
                
                       $paid_month1=date("M,Y");             
                    $w=  mysql_query("SELECT * FROM tbl_our_payroll WHERE paid_month='$paid_month1'") or die(mysql_error());
                    $f= mysql_num_rows($w);
                    if($f>0){
                      echo '<div class="alert alert-danger success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Alredy Created Payroll for '.$paid_month1.'! if You Made Change Please <a href="deletep&date='.$paid_month1.'">Delete</a> it and Update Payroll Again...!</strong>
</div>'; 
                    }
 else {
 while ($b = mysql_fetch_array($a, MYSQLI_ASSOC)) {                          
                    $emp_file_no=$b['emp_file_no'];
                    $salary=$b['salary'];
                    $allowance=$b['allowance'];
                    $travel_allowance=$b['travel_allowance'];
                    $Conveyance_allowance=$b['Conveyance_allowance'];
                    $House_rent_allowance=$b['House_rent_allowance'];
                    $Medical_allowance=$b['Medical_allowance'];
                    $remark=$b['remark'];
                    $deduction=$b['deduction'];       
                    $c=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                    $d=mysql_fetch_array($c);
                    $first_name=$d['first_name'];
                    $surname=$d['surname'];
                    $paiddate=date("d,M,Y");
                    $paid_month=date("M,Y");
                    $name=$first_name.' '.$surname;
                    $e=mysql_query("SELECT SUM(tax_amount) FROM tbl_tax WHERE employee_id='$emp_file_no'") or die(mysql_error());
                    $f=mysql_fetch_array($e);
                    $tax=$f['SUM(tax_amount)'];
                    $total_deduction=$deduction+$tax;
                    $total_earm=$salary+$allowance+$travel_allowance+$Conveyance_allowance+$House_rent_allowance+$Medical_allowance;
                    $netpay=$total_earm-$total_deduction; 
                        $g=mysql_query("INSERT INTO tbl_our_payroll(emp_file_no,salary,allowance,travel_allowance,Conveyance_allowance,House_rent_allowance,Medical_allowance,deduction,netgross,paid_datee,paid_month,remark)"
                            . "VALUES('$emp_file_no' , '$salary' , '$allowance','$travel_allowance','$Conveyance_allowance','$House_rent_allowance','$Medical_allowance','$deduction','$netpay','$paiddate','$paid_month','$remark') ") or die(mysql_error());
                  
                }
                
                 echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfull Creating Payroll  for '.$paid_month1.'</strong>
</div>';   

    
}
?>

