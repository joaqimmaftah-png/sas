<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0" style=" font-size: 13px;">
        <thead>
             <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Request ID</th> 
                                        <th class="text-left">Request for(Details)</th>
                                        <th class="text-left">Project</th>
                                        <th class="text-left">Requested by</th> 
                                        <th class="text-left">Amounts(Tshs)</th>
                                        <th class="text-left">Request Date</th>
                                        <th class="text-left">Manager Status</th>
                                        <th class="text-left">Account Status</th>
                                    </tr>
        </thead>
        <tfoot>
             <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Request ID</th> 
                                        <th class="text-left">Request for(Details)</th>
                                        <th class="text-left">Project</th>
                                        <th class="text-left">Requested by</th> 
                                        <th class="text-left">Amounts(Tshs)</th>
                                        <th class="text-left">Request Date</th>
                                        <th class="text-left">Manager Status</th>
                                        <th class="text-left">Account Status</th>
                                    </tr>
        </tfoot>
                                       <tbody>
<?php
$cashlist = mysql_query("SELECT * FROM cash_request ORDER BY requestdatereport DESC") or die(mysql_error());
$m = 1;
while ($roww = mysql_fetch_array($cashlist)) {
    $request_date = $roww['request_date'];
    $request_by = $roww['request_by'];
    $approved_by_status = $roww['approved_by_status'];
    $received_by_status = $roww['received_by_status'];
    $title = $roww['title'];
    $cash_id = $roww['cash_id'];
    $cash_idd = $cash_id + 1;
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    $jumla = $totals['SUM(total)'];
    $vats=$roww['vat'];
    $jumlavat=$jumla+($jumla*($vats/100));
    $output[0] = substr($detail, 0, 50);
    
     $quotid=$rs['quoitem'];
                $tbl_preparedquotation=mysql_query("SELECT * FROM tbl_quotationitem where Item_id='$quotid'") or die(mysql_error());
                $quota=mysql_fetch_array($tbl_preparedquotation);
                $Quotation_name=$quota['Description'];
                $Quot_id=$quota['Quotation_id'];
                
                 $ttr2=mysql_query("SELECT * FROM tbl_preparedquotation where Quotation_id='$Quot_id'") or die(mysql_error());
                $qa=mysql_fetch_array($ttr2);
                
                $Quotation_number=$qa['Quotation_number'];
    
    ?>
                                        <tr>
                                            <td>
                                        <?php echo $m++; ?>
                                            </td>
                                            <td class="right">

                                        <?php
                                        if ($_SESSION["emp_file_no"] == 'SSW 147' || $_SESSION["emp_file_no"] == 'SSW 050' || $_SESSION["emp_file_no"] == 'SSW 211') {
                                            ?>
                                                <a href="user_accounts.php?action=cash_account&View_cash=<?php echo $cash_id; ?>" target="_blank"><?php echo $identificationnumber; ?></a>
        <?php
    }
    ?>
 
    <?php
    if ($_SESSION["emp_file_no"] == 'SSW 122' || $_SESSION["emp_file_no"] == 'SSW 202') {
        ?>
                                                    <a href="user_accounts.php?action=cash_request&View_cash=<?php echo $cash_id; ?>" target="_blank"><?php echo $identificationnumber; ?></a>
                                                    <?php
                                                }
                                                ?>


                                            </td>

                                            <td class="right"><?php echo strtoupper($title); ?></td>
                                             <td class="right"><?php echo $Quotation_number.' '.$Quotation_name; ?></td>
                                            <td class="right"><?php echo $jstt['first_name'] . ' (' . $jstt['surname'].')'; ?></td>
                                            
                                            <td class="right"><?php echo number_format($jumlavat,2); ?></td>
                                            <td class="right"><?php echo $request_date; ?></td>
                                            <td class="right"><?php echo $approved_by_status; ?></td>
                                            <td class="right"><?php echo $received_by_status; ?></td>
                                        </tr> 
    <?php
}
?>
                                </tbody>
    </table>
