<table   id="table" class="table table-striped table-bordered table-responsive" style=" font-size: 13px;" cellspacing="0" width="100%">
                    <thead>
                        <tr>

                            <th class="text-left">Refno</th>
                            <th class="text-left">Request Title</th>                                                                             
                            <th class="text-left">Requested by</th> 
                            <th class="text-left">Quantity</th>
                            <th class="text-left">Unit</th>
                            <th class="text-left">Date</th>                                        
                            <th class="text-left">Status</th>
                            <th class="text-left">Received by</th>


                        </tr>
                    </thead>

                    
<tbody>
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$naa = $_SESSION["emp_file_no"];
$fuel = mysql_query("SELECT * FROM fuel_request WHERE requester='$naa' ORDER BY refno DESC") or die(mysql_error());
while ($refrow = mysql_fetch_array($fuel)) {
    $request_date = $refrow['req_date'];
    $requester = $refrow['requester'];
    $request_title = $refrow['request_title'];
    $details = $refrow['details'];
    $refno = $refrow['refno'];

    $quantity = $refrow['quantity'];
    $unit = $refrow['unit'];
    $reg_no = $refrow['reg_no'];
    $req_date = $refrow['req_date'];
    $status = $refrow['status'];
    $receipt = $refrow['receipt'];
    $approve_by = $refrow['approve_by'];
    $amount = $refrow['amount'];


    $refnu = 'SSWFRQ' . sprintf("%04d", $refno);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss1 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'") or die(mysql_error());
    $jna = mysql_fetch_array($tss1);
    $fullname1 = $jna['first_name'] . ' ' . $jna['surname'];
    $tss2 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approve_by'") or die(mysql_error());
    $jna2 = mysql_fetch_array($tss2);
    $fullname2 = $jna2['first_name'] . ' ' . $jna2['surname'];
    ?>
                            <tr>                            
                                <td class="right"><?php echo $refnu; ?></td>
                                <td class="right"><?php echo $request_title; ?></td>
                                <td class="right"><?php echo $fullname1; ?></td>
                                <td class="right"><?php echo number_format($quantity, 2); ?></td>
                                <td class="right"><?php echo $unit; ?></td>
                                <td class="right"><?php echo $req_date; ?></td>                                                                                  
                                <td class="right"><?php echo $status; ?></td>
                                <td class="right"><?php echo $received_by_status; ?></td>


                            </tr> 
                        <?php
                        
                        
                          }
                        
                        ?>
                    </tbody>

                    <tfoot>
                        
                    </tfoot>
                </table>