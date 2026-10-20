<?php
require_once __DIR__ . '/../../mysql_compat.php';

$opn=$_GET['q'];
if($opn=='Class A'){
?>
<div class="form-group">

    <input name="tt" placeholder="TT Number"  class="form-control amount editable"   aria-describedby="sizing-addon1" required="" type="text">
</div>
<?php
}  else {
?>
<div class="form-group">

    <input name="tt" placeholder="TT Number"  value="Null" class="form-control amount editable"   aria-describedby="sizing-addon1"  type="text">
</div>

<?php } ?>




