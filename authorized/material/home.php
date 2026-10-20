<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0" style=" font-size: 13px;">
        <thead>
           <tr>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Items</th>
                                    <th class="text-left">Request Date</th> 
                                    <th class="text-left">Ref #</th>
                                    <th class="text-left">Request by</th>
                                    <th class="text-left">HOD Status</th>
                                    <th class="text-left">Store Status</th>
                                    <th class="text-left">Action</th>

                                </tr>
        </thead>
        <tfoot>
               <tr>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Items</th>
                                    <th class="text-left">Request Date</th> 
                                    <th class="text-left">Ref #</th>
                                    <th class="text-left">Request by</th>
                                    <th class="text-left">HOD Status</th>
                                    <th class="text-left">Store Status</th>
                                    <th class="text-left">Action</th>

                                </tr>
        </tfoot>
                            <tbody>
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$j = 1;
$emp_idd = $_SESSION["emp_file_no"];
$accesstore = $_SESSION['store_access'];

$emp = mysql_query("SELECT * FROM tbl_contact where emp_file_no='$emp_idd'") OR die(mysql_error());
$ror = mysql_fetch_array($emp);
$emails = $ror['email'];
$ss = mysql_query("SELECT * FROM tbl_request_spare where store_email='$emails' OR hod_email='$emails' ") OR die(mysql_error());
$wss = mysql_fetch_array($ss);
$store = $wss['store_email'];
$hod_email = $wss['hod_email'];
if ($store == $emails || $accesstore == "YES") {
    $sst = mysql_query("SELECT * FROM tbl_request_spare WHERE hod_status='Approved' ORDER BY request_id DESC") OR die(mysql_error());
    while ($wst = mysql_fetch_array($sst)) {
        $request_ids = $wst['request_id'];
        $requester = $wst['requester'];
        $Request_title = $wst['Request_title'];
        $store_status = $wst['store_status'];
        $hod_status = $wst['hod_status'];


        $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
        $bt = mysql_fetch_array($at);
        $item = $bt['item'];
        $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
        $yunis = mysql_fetch_array($pinformation);
        $fm = $yunis['first_name'];
        $lm = $yunis['surname'];
        if (!empty($Request_title)) {
            $view = $Request_title;
        } else {
            $view = $bt['item'];
        }
        if ($store_status == "Pending") {
            $color = "";
        } elseif ($hod_status == "Pending") {
            $color = "bg-blue";
        } else {
            $color = "";
        }
        ?>
                                        <tr class="<?php echo $color; ?>">
                                            <td class="right"><?php echo $j++; ?></td>
                                            <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                            <td class="right"><?php echo $wst['request_date']; ?></td>
                                            <td class="right"><?php echo 'SSWMR' . sprintf("%04d", $request_ids); ?></td>
                                            <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                            <td class="right"><?php echo $wst['hod_status']; ?></td>
                                            <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
                                                <ul class="showlist">

                                                    <li><a target="_blank" href="?action=process_request&view=<?php echo $request_ids; ?>">View</a></li>

                                                                                            <!--<li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>-->

                                                </ul>
                                            </td>


        <?php
    }
}

if ($hod_email == $emails) {

    $sst = mysql_query("SELECT * FROM tbl_request_spare where hod_email='$hod_email' ORDER BY request_id DESC") OR die(mysql_error());
    while ($wst = mysql_fetch_array($sst)) {
        $request_ids = $wst['request_id'];
        $requester = $wst['requester'];
        $Request_title = $wst['Request_title'];
        $store_status = $wst['store_status'];
        $hod_status = $wst['hod_status'];

        $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
        $bt = mysql_fetch_array($at);
        $item = $bt['item'];
        $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
        $yunis = mysql_fetch_array($pinformation);
        $fm = $yunis['first_name'];
        $lm = $yunis['surname'];
        if (!empty($Request_title)) {
            $view = $Request_title;
        } else {
            $view = $bt['item'];
        }
        if ($store_status == "Pending") {
            $color = "";
        } elseif ($hod_status == "Pending") {
            $color = "bg-blue";
        } else {
            $color = "";
        }
        ?>
                                        <tr class="<?php echo $color; ?>">
                                            <td class="right"><?php echo $j++; ?></td>
                                            <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                            <td class="right"><?php echo $wst['request_date']; ?></td>
                                            <td class="right"><?php echo 'SSWMR' . sprintf("%04d", $request_ids); ?></td>
                                            <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                            <td class="right"><?php echo $wst['hod_status']; ?></td>
                                            <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
                                                <ul class="showlist">

                                                    <li><a target="_blank" href="?action=hprocess_request&view=<?php echo $request_ids; ?>">View</a></li>

                                                        <!--<li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>-->

                                                </ul>
                                            </td>


        <?php
    }
}
?>
                                </tr> 
                            </tbody>
    </table>

