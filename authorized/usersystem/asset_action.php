<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
 $asset_iddd=$_GET['q'];
 $explore=  explode('@',$asset_iddd);
 $asset_ids=$explore[0];
$assigners=$explore[1];
$explore2=  explode(' ',$assigners);
$id1=$explore2[0];
$id2=$explore2[1];
$employeeprofile=$id2;
$assetid=$asset_ids.'_'.$employeeprofile;

$result = mysql_query("SELECT * FROM tbl_user_accounts WHERE emp_file_no='$assigners'");
$show=mysql_fetch_array($result); 
$asset_trackers=$show['asset_tracker'];

$mn=  mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$assigners'") or die(mysql_error());
$showw=mysql_fetch_array($mn); 
$position_id=$showw['position_id'];
?>
<ul class="pagination" >
<?php
if($asset_trackers=='YES'){   
?>
 <li>
                                <a  href="#" role="button"><i class="fa fa-file-excel-o"></i>&nbsp;Download Excel</a>        
                            </li>
                           
                            <li >
                                <a href="#" onclick="viewasset('authorized/usersystem/view_assets.php?asset_id=<?php echo $assetid; ?>')"  data-toggle="modal" data-target="#viewasset" ><i class="fa fa-check"></i>&nbsp;Edit</a>
                            </li>
                            <li >
                                <a href="#" onclick="viewasset('authorized/usersystem/view_edit_assets.php?asset_id=<?php echo $assetid; ?>')" data-toggle="modal" data-target="#viewasset"><i class="fa fa-recycle"></i>&nbsp;Allocate</a>
                            </li>
                            <li >
                                <a href="http://daimainfotech.com/sas/asset_information.php?asset_id=<?php echo $assetid; ?>"   ><i class="fa fa-arrow-down"></i>&nbsp;Report</a>
                            </li>
<?php
}elseif($position_id==1){
?>

                            <li >
                                <a href="#"  ><i class="fa fa-remove"></i>&nbsp;Allocate</a>
                            </li>
                            <li >
                                <a href="http://daimainfotech.com/sas/asset_information.php?asset_id=<?php echo $assetid; ?>"   ><i class="fa fa-arrow-down"></i>&nbsp;Report</a>
                            </li>                        
<?php
}else {
?> 
   
                            <li >
                                <a href="#"  ><i class="fa fa-remove"></i>&nbsp;View</a>
                            </li>
                         
<?php
}
?>                            
   </ul>                         