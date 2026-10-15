<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($_GET['q']=='PO approval' || $_GET['q']=='Email approval'){

?>  
<!--echo $_GET['q'];-->  



<span class="input-group-addon" id="sizing-addon1" style="width:15%; text-align:right"><span class="text-right">PO NUMBER</span></span>
<input name="po" placeholder="PO Number"  required="" class="form-control amount editable"   aria-describedby="sizing-addon1" type="text">

 <?php
}

else {  
     echo "";
 }
 ?>   