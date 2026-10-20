<head>
<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;  
}
</style>       
</head>     
  
    
 <hr>
    
 <table class="table cart table-bordered">
    <caption style=" text-align: center;">MONTHLY PO SUMMARY REPORTs</caption>

 <tr>  
  <th style="background-color: #469BD7;">Month</th> 
  <th>TOTAL PO PER MONTH</th>
  <th>TOTAL AMOUNT PER MONTH</th>
           
 </tr>

    </thead>
    <tbody>
    <?php
require_once __DIR__ . '/../../mysql_compat.php';

////////////////////////////January//////////////////////////////////////////////////////
    $datejan=201901;
                         
    $jdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE update_month='$datejan' AND approved_po!='Cancelled'") or die(mysql_error());
    $jan_plo= mysql_num_rows($jdata);  
     
    
    while($jdata1=  mysql_fetch_array($jdata)){             
        
        $Quot_id=$jdata1['Quotation_id'];
        
        
    $resulz = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot_id'")or die(mysql_error());
    $erweTz=  mysql_fetch_array($resulz);   
    $grandtotal=$erweTz['SUM(Net_Price)'];
    $grandtotal1+=$grandtotal;
    
    $grandtotal1aa=(($grandtotal1*18)/100);
    $grandtotal1aaa=$grandtotal1aa+$grandtotal1;
    $grandtotal1aaaa=number_format($grandtotal1aaa,2);
    
    }   
    
////////////////////////////January//////////////////////////////////////////////////////
    ?>     
 <!--///////////////////////////////Jnanuary////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr> 
    <td>January <?php echo date(Y);?></td>   
    <td><a href="?action=monthly_lpo&date=<?php echo $datejan;?>&status="><?php  echo $jan_plo;?></a></td>
    <td><a href="?action=monthly_lpo&date=<?php echo $datejan;?>&status="><?php echo $grandtotal1aaaa;?></a></td>
    
</tr>         
       
 <!----------------------------end----------------->
  <!--///////////////////////////////Feb////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
   $datefeb=201902;
                         
    $jjdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE update_month='$datefeb' AND approved_po!='Cancelled'") or die(mysql_error());
    $feb_plo= mysql_num_rows($jjdata); 
    
    
   
  while($jdata2=  mysql_fetch_array($jjdata)){  
      
      
    $Quot2=$jdata2['Quotation_id'];
     
    $resul2 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot2'")or die(mysql_error());
    $erweT2=  mysql_fetch_array($resul2);
    
    $grandtotal2=$erweT2['SUM(Net_Price)'];
    
    $grandtotal22+=$grandtotal2;
    
    $grandtotal22bbb=(($grandtotal22bb*18)/100);
    $grandtotal22bbbb=$grandtotal22bbb+$grandtotal22;
    $grandtotal22bb=number_format($grandtotal22bbbb,2);
  }
    ?>
  
   
  <tr>
    <td>February  <?php echo date(Y);?></td>   
    <td><a href="?action=monthly_lpo&date=<?php echo $datefeb;?>&status="><?php  echo $feb_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datefeb;?>&status="><?php echo $grandtotal22bb;?></a></td>
     
  </tr>  
  
  <?php
   $datemar=201903;
                         
    $kdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datemar' AND approved_po!='Cancelled'") or die(mysql_error());
    $mar_plo= mysql_num_rows($kdata);
    
   
    
    while($jdata3=  mysql_fetch_array($kdata)){ 
        
    $Quot3=$jdata3['Quotation_id'];
     
    $resul3 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot3'")or die(mysql_error());
    $erweT3=  mysql_fetch_array($resul3);
    
    $grandtotal3=$erweT3['SUM(Net_Price)'];
    $grandtotal33+=$grandtotal3;     
    $grandtotal33ccc=(($grandtotal33cc*18)/100);
    $grandtotal33cccc=$grandtotal33+$grandtotal33ccc;
    $grandtotal33cc=number_format($grandtotal33cccc,2);
    
    
  }
  ?>
   
  <tr>
    <td>March <?php echo date(Y);?></td>    
    <td><a href="?action=monthly_lpo&date=<?php echo $datemar;?>&status="><?php  echo $mar_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datemar;?>&status="><?php echo $grandtotal33cc;?></a></td>
     
  </tr>
   
  
  
   <?php
   $dateapr=201904;
                         
    $adata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$dateapr' AND approved_po!='Cancelled'") or die(mysql_error());
    $apr_plo= mysql_num_rows($adata);
    
   
    while($jdata4=  mysql_fetch_array($adata)){
        
    $Quot4=$jdata4['Quotation_id'];
    $resul4 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot4'")or die(mysql_error());
    $erweT4=  mysql_fetch_array($resul4);
    
    $grandtotal4=$erweT4['SUM(Net_Price)'];
    $grandtotal44+=$grandtotal4;   
    $grandtotal44ddd=(($grandtotal44*18)/100); 
    $grandtotal44dddd=$grandtotal44+$grandtotal44ddd;
    $grandtotal44dd=number_format($grandtotal44dddd,2);
    
  }
  ?>
  <tr>
    <td>April  <?php echo date(Y);?></td>    
    <td><a href="?action=monthly_lpo&date=<?php echo $dateapr;?>&status="><?php  echo $apr_plo;?></a></td>      
    <td><a href="?action=monthly_lpo&date=<?php echo $dateapr;?>&status="><?php echo $grandtotal44dd;?></a></td>
    
  </tr> 
  
  <?php
   $datemay=201905;
                         
    $bdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datemay' AND approved_po!='Cancelled'") or die(mysql_error());
    $may_plo= mysql_num_rows($bdata);
    
  
    while($jdata5=  mysql_fetch_array($bdata)){ 
        
    $Quot5=$jdata5['Quotation_id'];
    $resul5 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot5'")or die(mysql_error());
    $erweT5=  mysql_fetch_array($resul5);
    
    $grandtotal5=$erweT5['SUM(Net_Price)'];
   
    $grandtotal55+=$grandtotal5;
    
    $grandtotal55e=(($grandtotal55*18)/100);
    $grandtotal55eee=$grandtotal55e+$grandtotal55;
    
    $grandtotal55ee=number_format($grandtotal55eee,2);
    
    
    
    
    }
  ?>
  
  <tr>  
    <td>May <?php echo date(Y);?></td>   
    <td><a href="?action=monthly_lpo&date=<?php echo $datemay;?>&status="><?php  echo $may_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datemay;?>&status="><?php echo $grandtotal55ee;?></a></td>
     
  </tr>
  
  
  
  
  <?php
   $datejune=201906;
                         
    $edata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datejune' AND approved_po!='Cancelled'") or die(mysql_error());
    $june_plo= mysql_num_rows($edata);
   
    
    while($jdata6=  mysql_fetch_array($edata)){
        
   
    $Quot6=$jdata6['Quotation_id'];
    $resul6 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot6'")or die(mysql_error());
    $erweT6=  mysql_fetch_array($resul6);
    
    $grandtotal6=$erweT6['SUM(Net_Price)'];   
    $grandtotal66+=$grandtotal6;
    
    $grandtotal66f=(($grandtotal66*18)/100);
    $grandtotal66fff=$grandtotal66f+$grandtotal66;
    
    $grandtotal66ff=number_format($grandtotal66fff,2);
    
    }   
  ?>   
  
  <tr>
    <td>June <?php echo date(Y);?></td>  
    <td><a href="?action=monthly_lpo&date=<?php echo $datejune;?>&status="><?php  echo $june_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datejune;?>&status="><?php echo $grandtotal66ff;?></a></td>
     
  </tr>   
  
  
   <?php
   
    $datejuly=201907;
                         
    $fdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datejuly' AND approved_po!='Cancelled'") or die(mysql_error());
    $july_plo= mysql_num_rows($fdata);
    
    
    while($jdata7=  mysql_fetch_array($fdata)){
        
    $Quot7=$jdata7['Quotation_id'];
    $resul7 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot7'")or die(mysql_error());
    $erweT7=  mysql_fetch_array($resul7);
    
    $grandtotal7=$erweT7['SUM(Net_Price)'];
    
    $grandtotal77+=$grandtotal7;
    $grandtotal77g=(($grandtotal77*18)/100);
    $grandtotal77ggg=$grandtotal77g+$grandtotal77;
    
    $grandtotal77gg=number_format($grandtotal77ggg,2);
    
    }
   ?>
  
  <tr>
    <td>July <?php echo date(Y);?></td>
    <td><a href="?action=monthly_lpo&date=<?php echo $datejuly;?>&status="><?php  echo $july_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datejuly;?>&status="><?php echo $grandtotal77gg;?></a></td>
     
  </tr>
  
   <?php
   
    $dateaug=201908;
                         
    $gdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$dateaug' AND approved_po!='Cancelled'") or die(mysql_error());
    $aug_plo= mysql_num_rows($gdata);
    
   
    while($jdata8=  mysql_fetch_array($gdata)){
        
    $Quot8=$jdata8['Quotation_id'];
    $resul8 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot8'")or die(mysql_error());
    $erweT8=  mysql_fetch_array($resul8);
    
    $grandtotal8=$erweT8['SUM(Net_Price)'];
    $grandtotal88+=$grandtotal8;
    
    $grandtotal88hhh=(($grandtotal88*18)/100);
    $grandtotal88h=$grandtotal88hhh+$grandtotal88;
    $grandtotal88hh=number_format($grandtotal88h,2);
    
    }
  ?>
  
  
  
  <tr>
    <td>August <?php echo date(Y);?></td>
    <td><a href="?action=monthly_lpo&date=<?php echo $dateaug;?>&status="><?php  echo $aug_plo;?></a></td>    
    <td><a href="?action=monthly_lpo&date=<?php echo $dateaug;?>&status="><?php echo $grandtotal88hh;?></a></td>
     
  </tr> 
    
  
   <?php
   
    $datesept=201909;
                         
    $hdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datesept' AND approved_po!='Cancelled'") or die(mysql_error());
    $sept_plo= mysql_num_rows($hdata);
    
        
    while($jdata9=  mysql_fetch_array($hdata)){
        
    $Quot9=$jdata9['Quotation_id'];
    $resul9 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot9'")or die(mysql_error());
    $erweT9=  mysql_fetch_array($resul9);
    
    $grandtotal9=$erweT9['SUM(Net_Price)'];
     
    $grandtotal99+=$grandtotal9;
    
    $grandtotal99i=(($grandtotal99*18)/100);
    $grandtotal99iii=$grandtotal99i+$grandtotal99;
    $grandtotal99ii=number_format($grandtotal99iii,2);
    
    } 
  ?>
  
  <tr>
    <td>September  <?php echo date(Y);?></td>
    <td><a href="?action=monthly_lpo&date=<?php echo $datesept;?>&status="><?php  echo $sept_plo;?></a></td>     
    <td><a href="?action=monthly_lpo&date=<?php echo $datesept;?>&status="><?php echo $grandtotal99ii;?></a></td>
     
  </tr>
  
  
  
  
   <?php     
   
    $dateoct=201910;
                         
    $pdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$dateoct' AND approved_po!='Cancelled'") or die(mysql_error());
    $oct_plo= mysql_num_rows($pdata);
    
    while($jdata10=  mysql_fetch_array($pdata)){
        
    $Quot10=$jdata10['Quotation_id'];
    $resul10 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot10'")or die(mysql_error()); 
    $erweT10=  mysql_fetch_array($resul10);
    
    $grandtotal10=$erweT10['SUM(Net_Price)'];    
    $grandtotal100+=$grandtotal10;
    
    $grandtotal100j=(($grandtotal100*18)/100);
    $grandtotal100jjj=$grandtotal100j+$grandtotal100;
    $grandtotal100jj=number_format($grandtotal100jjj,2);
    
    }   
  ?>    
  <tr>
    <td>October  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201910'?></td>-->
    <td><a href="?action=monthly_lpo&date=<?php echo $dateoct;?>&status="><?php  echo $oct_plo;?></a></td>      
    <td><a href="?action=monthly_lpo&date=<?php echo $dateoct;?>&status="><?php echo $grandtotal100jj;?></a></td>
    
  </tr>
  
   <?php
   
    $datenov=201911;
                         
    $qdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datenov' AND approved_po!='Cancelled'") or die(mysql_error());
    $nov_plo= mysql_num_rows($qdata);
    
       
    while($jdata11=  mysql_fetch_array($qdata)){

    $Quot11=$jdata11['Quotation_id'];
    $resul11 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_items` WHERE item='$item11'")or die(mysql_error()); 
    $erweT11=  mysql_fetch_array($resul11);
  
    $grandtotal11=$erweT11['SUM(Net_Price)'];
    $grandtotal111+=$grandtotal11;
    
    $grandtotal111k=(($grandtotal111*18)/100);
    $grandtotal111kkk=$grandtotal111k+$grandtotal111;
    $grandtotal111kk=number_format($grandtotal111kkk,2);
    
    
    }
    
    ?>
  
  <tr>
    <td>November  <?php echo date(Y);?></td>
    <td><a href="?action=monthly_lpo&date=<?php echo $datenov;?>&status="><?php  echo $nov_plo;?></a></td>      
    <td><a href="?action=monthly_lpo&date=<?php echo $datenov;?>&status="><?php  echo $grandtotal111kk;?></a></td>
        
  </tr>  
  
 
   <?php  
   
    $datedec=201912;
                         
    $zdata= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE update_month='$datedec' AND approved_po!='Cancelled'") or die(mysql_error());
    $dec_plo= mysql_num_rows($zdata);
   
    while($jdata12= mysql_fetch_array($zdata)){     
       
    $Quot12=$jdata12['Quotation_id'];
    $resul12 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$Quot12'")or die(mysql_error()); 
    $erweT12=  mysql_fetch_array($resul12);
   
    $grandtotal12=$erweT12['SUM(Net_Price)'];
    $grandtotal122+=$grandtotal12;
    
    $grandtotal122l=(($grandtotal122*18)/100);
    $grandtotal122lll=$grandtotal122l+$grandtotal122;
    $grandtotal122ll=number_format($grandtotal122lll,2);
    
    
   }       
           
  ?>       
  
  <tr>
    <td>December <?php echo date(Y);?></td>
    <!--<td><?php // echo '201912'?></td>-->
    <td><a href="?action=monthly_lpo&date=<?php echo $datedec;?>&status="><?php  echo $dec_plo;?></a></td>      
    <td><a href="?action=monthly_lpo&date=<?php echo $datedec;?>&status="><?php  echo $grandtotal122ll;?></a></td>
    
  </tr> 
    
  
 <!----------------------------end----------------->     
 </tbody>
 
 </table>
    
 
<?php
$monthArray = range(1, 12);
?>
<select name="month"> 
    <!--<option value="">Select Month</option>-->
    <?php
    foreach ($monthArray as $month) {  
        // padding the month with extra zero
        $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
        $fdate = date("F", strtotime("2015-$monthPadding-01"));
//        echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
    }   
    
    ?>
</select>  