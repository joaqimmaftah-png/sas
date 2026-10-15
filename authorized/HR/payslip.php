
<?php
if(isset($_GET['action'])){   
    if($_GET['action']=='deletep'){
        $date=$_GET['date'];
        $delete1=  mysql_query("DELETE from tbl_our_payroll WHERE paid_month='$date'") or die(mysql_error());
        echo '<div class="alert alert-danger success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successful Deleted '.$date.' Payroll! Click Update Payroll Above To Create Again..</strong>
</div>'; 
    }
}
$message="";
?>

<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="#"><i class="icon-stats-up fg-blue"></i>&nbsp;Home Payroll</a>
            </li>
            <li>
                <!--<a class="" href="#" onclick="getPages('view/payroll_update.php')"><i class="icon-medal-2 fg-blue"></i>&nbsp;Update Payroll</a>-->
            </li>

          

        </ul>
    </nav>
</div>
<div class="" id="updatepayroll">
    
</div>
<div class="container">
    <?php
    echo $message;
    ?>
</div>
<div class="margin5">    
    <table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
<!--                <th class="text-left">Reg#</th>-->
                <th class="text-left">Employee Name</th>
                <th class="text-left">Pay Date</th>
                <th class="text-left">Basic Salary</th>
                <th class="text-left">Dearness Allowance</th>
                <th class="text-left">Travel Allowance</th>
                <th class="text-left">Conveyance Allowance</th>
                <th class="text-left">House Rent Allowance</th>
                <th class="text-left">Medical Allowance</th>
                <th class="text-left">Paye</th>
                <th class="text-left">NSSF</th>
                <th class="text-left">Deduction</th>
                <th class="text-left">Payable Tax</th>
                <th class="text-left">Net Pay</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $emp_file_no=$_GET['emp_file_no'];
                $a= mysql_query("select * from tbl_our_payroll WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
                while ($b = mysql_fetch_array($a)) {                          
                    $emp_file_no=$b['emp_file_no'];
                    $salary=$b['salary'];
                    $paid_datee=$b['paid_datee'];
                    $allowance=$b['allowance'];
                    $travel_allowance=$b['travel_allowance'];
                    $Conveyance_allowance=$b['Conveyance_allowance'];
                    $House_rent_allowance=$b['House_rent_allowance'];
                    $Medical_allowance=$b['Medical_allowance'];
                    $deduction=$b['deduction'];       
                    $c=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                    $d=mysql_fetch_array($c);
                    $first_name=$d['first_name'];
                    $surname=$d['surname'];
                    $name=$first_name.' '.$surname;
                    $e=mysql_query("SELECT SUM(tax_amount) FROM tbl_tax WHERE employee_id='$emp_file_no'") or die(mysql_error());
                    $f=mysql_fetch_array($e);
                    $tax=$f['SUM(tax_amount)'];
                    $total_deduction=$deduction+$tax;
                    $total_earm=$salary+$allowance+$travel_allowance+$Conveyance_allowance+$House_rent_allowance+$Medical_allowance;
                    $netpay=$total_earm-$total_deduction;
                    $Gross=$salary+$allowance+$travel_allowance+$Conveyance_allowance+$House_rent_allowance+$Medical_allowance;
                    $nssf=$Gross/10;
                    $Gross2=$Gross-$nssf;
                    $remarks=$b['remark'];                  
                    if($Gross2>720000){
                       $payee= ((($Gross2-720000)*30/100)+107600);                       
                    }
                    elseif ($Gross2>540000) {
                    $payee=((($Gross2-540000)*25/100)+62600);
                }elseif ($Gross2>360000) {
                    $payee=((($Gross2-360000)*20/100)+26600);
                }elseif ($Gross2>170000) {
                    $payee=(($Gross2-170000)*14/100);
                }
                
                
                
                    if($deduction<=0){
                        $bg="";
                        $links=number_format($deduction);
                    }  else {
                        $bg="";
                        $links='<a href="#"
        data-hint="Deduction Reason|'.$remarks.'"
        data-hint-position="bottom">
            '.number_format($deduction).'
    </a>';
                    }
                    
                ?>
            <tr class="<?php echo $bg;?>">
                    <td class="text-center">
                        <!--<input type="checkbox" name="" value="<?php echo $emp_file_no; ?>" onchange="showoption(this.value)">-->
                         <nav class="vertical-menu compact">
        <ul>
            <li>
                <a class="dropdown-toggle" href="#"></a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="show_payslip&emp_file_no=<?php echo $emp_file_no;?>&paydate=<?php echo $paid_datee;?>"><i class="icon-copy"></i>&nbsp;Payslip</a></li>
                    <li><a href="#"><i class="icon-file-pdf fg-red"></i>&nbsp;Export</a></li>
                     <li><a href="#"><i class="icon-file-excel fg-green"></i>&nbsp;Export</a></li>
                </ul>
            </li>          
        </ul>
    </nav>
                        
                        
                    </td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $paid_datee; ?></td>
                    <td><?php echo number_format($salary); ?></td>
                    <td><?php echo number_format($allowance); ?></td>
                    <td><?php echo number_format($travel_allowance); ?></td>
                    <td><?php echo number_format($Conveyance_allowance); ?></td>
                    <td><?php echo number_format($House_rent_allowance); ?></td>
                    <td><?php echo number_format($Medical_allowance); ?></td>
                    <td><?php echo number_format($payee); ?></td>
                    <td><?php echo number_format($nssf); ?></td>
                    <td><?php echo $links ?></td>
                    <td><?php echo number_format($payee+$nssf); ?></td>
                    <td><?php echo number_format($Gross-($payee+$nssf)-($deduction)); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

