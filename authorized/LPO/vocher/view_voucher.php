<style type="text/css">

            @media print
            {    
                .ignore, .navigation-bar,.horizontal-menu *
                {
                    display: none !important;
                }
                
                .bottom-align-text {
    position: absolute;
    bottom: 0;
    right: 0;
  }
                
            }

  
        </style>
                    <?php
                    
                    
                    include_once 'authorized/db.php';
///////////////////////////////////////////Approve form/////////////////////////////////////////////////////////                    
                    
                    $message = '';
if (isset($_POST['approve'])) {
}
                    ?>
<div class="container">
    <div class="grid">
         <div class="row ignore">
        <form action="" method="POST">
            <button type="submit" name="approve" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-check"></i>Approve</button>
            <a href="?action=store_lpo" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>
            <a href="javascript:window.print()" class="btn btn-default" ><i class="glyphicon glyphicon-print"></i> Print Previews</a>
        </form>
        <?php
        echo $message;
        ?>
    </div>
        <div class="row">
             <div class="col-lg-2">
                 <br>
             <img src="assets/invoice.jpg" alt="logo" class="pull-left img-responsive">
        </div>
            <div class="col-lg-10">               
            <h1 class="text-center" ><strong>SINCRO SITEWATCH LTD</strong></h1>
            <p class="text-center" >
                Plot No.1337 Msonge street,Mikocheni A,P.O.BOX  80407,DSM,<br>
                Tel  +255 22 2700971,Fax :+255 22 2700970,Mob:+255 784 660 000<br>
                +255 714 500900, www.sincrositewatch.com
            
            </p>
            <h3 class="text-center" ><strong>PAYMENT VOUCHER</strong></h3>
        </div>
       
            </div>
         <div class="row">
<!--            <div class="col-lg-6">mmmm</div>
            <div class="col-lg-6">mmmm</div>-->
            <br>
        </div>
        
        <div class="row">
            <?php
            $voucher_id=$_GET['voucher_id'];
            $DSS= mysql_query("SELECT * FROM payment_voucher WHERE voucher_no='$voucher_id'") or die(mysql_error());
            $gf=  mysql_fetch_array($DSS);
               $paid_to=$gf['paid_to'];
            $voucher_no=$gf['voucher_no'];
            $bank_acc_no=$gf['bank_acc_no'];
            $created_date=$gf['created_date'];
            $chq_number=$gf['chq_number'];
            $bank_name=$gf['bank_name'];
            $bank_branch=$gf['bank_branch'];
            $swift_code=$gf['swift_code'];
            $iban=$gf['iban'];
            $payment_date=$gf['payment_date'];
            $address=$gf['address'];
            ?>
            <div class="col-lg-6" >
                <p><strong>PLEASE PAY TO:&nbsp;<span><?php echo $paid_to;?></span></strong></p>
                <p><strong>BANK NAME:&nbsp;<span><?php echo $bank_name;?></span></strong></p>
                <p><strong>BANK BRANCH:&nbsp;<span><?php echo $bank_branch;?></span></strong></p>
              <p><strong>SWIFT CODE:&nbsp;<span><?php echo $swift_code;?></span></strong></p>
              <p><strong>IBAN:&nbsp;<span><?php echo $iban;?></span></strong></p>
            </div>
            <div class="col-lg-6">
                <p><strong>SSWL PV&nbsp;<span> <?php echo $voucher_no;?></span></strong></p>
                  <p><strong>DATE CREATED:&nbsp;<span> <?php echo $created_date;?></span></strong></p> 
                   <p><strong>PAYMENT DATE:&nbsp;<span> <?php echo $payment_date;?></span></strong></p> 
            </div>
        </div>
          <div class="row"></div>
          
          <div class="row">
              <br>
              <div class="col-lg-12">
                                   <table class="table cart table-bordered">

        <thead>
            <tr>
                <th class="">S/NO</th>
                <th>DESCRIPTION</th>
                 <th class="text-right">AMOUNT USD /TSHS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jj=1;
            $DS= mysql_query("SELECT * FROM tbl_vocher_items WHERE voucher_no='$voucher_id'") or die(mysql_error());
            $rs= mysql_query("SELECT SUM(amount) FROM tbl_vocher_items WHERE voucher_no='$voucher_id'") or die(mysql_error());
            $sun=  mysql_fetch_array($rs);
            $totalsum=$sun['SUM(amount)'];
            while ($row = mysql_fetch_array($DS)) {
  
                ///////////////////////////////////////////////////
                ?>
                <tr>
                     <td class="product"><?php echo $jj++; ?></td>
                     <td class="quantity"><?php echo $row['description']; ?></td> 
                    <td class="price text-right"><?php echo number_format($row['amount'], 2); ?></td>                                      
                
                </tr>
<?php  } ?>
            <tr>
<!--                <td class="total-quantity" ></td>-->
                <td class="price text-right" colspan="2">Total Amount</td>
                <td class="amount text-right"><?php echo number_format($totalsum, 2); ?></td>
            </tr>

        </tbody>
    </table>
                  <br>
              </div>
          </div>
                   <div class="row">
                                     <div class="col-lg-12">
                  <?php
                  function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousands',
        1000000             => 'millions',
        1000000000          => 'billions',
        1000000000000       => 'trillions',
        1000000000000000    => 'quadrillions',
        1000000000000000000 => 'quintillions'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
                  ?>
                  <p><strong>AMOUNT IN WORDS :&nbsp;</strong> <u><?php echo ucfirst(strtolower(convert_number_to_words($totalsum)));?></u></p> 
              </div>
             <table style="width:100%">
                 <tr>
                     <td style="width:50%" class="col-lg-6">              
                         <p><strong>BANK ACCOUNT NO :&nbsp;</strong><span><u><?php echo $bank_acc_no;?></u></span></p>
                         </td>
                     <td style="width:50%" class="col-lg-6">          
                         <p><strong>CHQ NO:&nbsp;</strong><span><u><?php echo $chq_number;?></u></span></p>
                     </td>
                 </tr>
             </table>                      
            <br><br>
            
             <table style="width:100%;" class="table cart table-bordered">
                 <tr>
                     <th style="width:33.4%"  class="col-lg-4">              
                         <p><strong>PREPARED BY :&nbsp;</strong></p>
                         </th>
                     <th style="width:33.1%"  class="col-lg-4">          
                         <p><strong>APPROVED BY:&nbsp;</strong></p>
                     </th>
                      <th style="width:33.1%"  class="col-lg-4">          
                         <p><strong>RECEIVED BY:&nbsp;</strong></p>
                     </th>
                 </tr>
                 
             </table>
        </div>
         
          
         
          
          
        
    </div>
    </div>