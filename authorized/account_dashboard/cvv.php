<?php
require_once __DIR__ . '/../../mysql_compat.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     echo $month.' '.date('Ym',strtotime($month)).'<br>';
     
     }