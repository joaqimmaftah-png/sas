<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script>
        <script type="text/javascript">
            $("#btnPrint").live("click", function () {
                var divContents = $("#dvContainer").html();
                var printWindow = window.open('', '', 'height=800,width=988');
                printWindow.document.write('<html><head><title>DIV Contents</title>');
                 printWindow.document.write('');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        </script>

        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
        <link href="js/prettify/prettify.css" rel="stylesheet">
        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       
        <!-- Metro UI CSS JavaScript plugins -->
        <script src="js/load-metro.js"></script>
        <script src="js/script.js"></script>
    <title>Accounts Managements</title>
                    <style>
                        .heding{
                            width: 920px;
                            height: 150px;
/*                            border: 1px solid green*/
                        } 
                        .logoo{
                            
                            width: 150px;
                            height: 150px;
/*                            border: 1px solid blue;*/
                           
                        }
                        .disc{
                           margin-left: 50%;
                            width:400px;
                            height: 130px;
                         
                        }
                        .othors{
                            width: 920px;
                            height: 100px;
                            border: 1px solid #FFFFFF;
                        }
                        .clients{
                             width: 400px;
                            height: 100px;
/*                            border: 1px solid;*/
                            float: left;
                        }
                        .reference{
                             width: 250px;
                            height: 100px;
/*                            border: 1px solid;*/
                            float: right;
                        }
                        table tr td{
                            border:1px solid black;
                            
                           
                        }
                    </style>
</head>
<?php
include_once 'authorized/db.php';
$quotations=  mysql_query("SELECT * from tbl_accounts_quotation where quotation_id='SSW72371'") or die(mysql_error());
$row1 = mysql_fetch_array($quotations);
    $clients_card=$row1['clients_card'];
    $quotation_date=$row1['quotation_date'];
    $message=$row1['message'];
    $quotation_id=$row1['quotation_id'];
    $select_clients_card=  mysql_query("SELECT * FROM tbl_accounts_clients_card WHERE card_number_id='$clients_card'") or die(mysql_error());
    $CARD=  mysql_fetch_array($select_clients_card);
    $company_name=$CARD['company_name'];
    $address=$CARD['address'];
    $town=$CARD['town'];
   $country=$CARD['country'];



?>
<body class="metro" style="">
<!--    <button id="btnPrint"  class="button">prints</button>-->
      <div id="dvContainer" style="">
                <div class="heding">
  
                    <table style="">
                        <tr style="border:0px">
                            <td style="border: 0px;">
                                                <div class="logoo">
                        <img src=" images/logoo.png" style="width:150px; height:140px;">

                    </div>  
                                
                            </td>
                            <td style="border: 0px;">
                                <div class="disc">
                        <ul>
                            <li>Generator Manufacturers</li>
                            <li>After Sales Support/Maintenance Contracts</li>
                            <li>Security and Monitoring Systems</li>
                            <li>SSWL Monitoring Software</li>
                            <li>Call Center Support</li>
                        </ul>
                    </div>
                            </td>
                        </tr>
                    </table>

                   
                </div>
                <div style="width: 920px;height: 55px;">
                    <h4 style="text-align: center">QUOTATION</h4>
                    <span style="text-emphasis: #000;font-size: 20px;  float: left;">TIN:106-703-221</span>
                    <span style="text-emphasis: #000;font-size: 20px;  float: right;">VRN:40-001712-E</span>

                    <div style="clear: both;"></div>
                </div>
                <div class="othors">
                    <div class="clients">
                        <span style=" float: left;"><?php echo $company_name;?></span><br>
                        <span style=" float: left;"><?php echo $address;?></span><br>
                        <span style=" float: left;"><?php echo $town;?></span><br>
                        <span style=" float: left;"><?php echo $country;?></span>
                        <span style=" clear: both;"></span>
                    </div>
                    <div class="reference">
                        <P>
                            <span style="float: left;"></span>
                            <span style="float: right;"></span>
                            <span style=" clear: both;"></span>
                        </p>
                        <P> <span style="float: left;">Date:</span>
                            <span style="float: right;">21-Apr-2015</span>
                        <div style=" clear: both;"></div>
                        </p>
                        <P>
                        <span style="float: left;">Ref:</span>
                            <span style="float: right;">SSWL P22/907</span>
                            <span style=" clear: both;"></span>
                        </p>
                        

                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="" style="width: 970px;">
                <h3 style=" text-align: center; font-size: 20px;">
<!--                    REF:SUPPLY AND INSTALLATION OF GENERATOR 66kva-->
                </h3>

                    <table style="width:920px;border: 1px solid black;">
                        <tr style="background-color: #93a1a1;border: 1px solid black;">
                            <td style="">S/N</td>
                            <td style="border: 1px solid black;">DESCRIPTION</td>
                            <td style="border: 1px solid black;">UNIT</td>
                            <td style="border: 1px solid black;">QTY</td>
                            <td style="border: 1px solid black;">UNIT PRICE</td>
                            <td  style="border: 1px solid black;">NET PRICE</td>
                        </tr>
                        <?php
                         $quotation_id=$row1['quotation_id'];
                        $quotation_info=  mysql_query("SELECT * FROM tbl_accounts_quotations_info where quotetation_id='$quotation_id'") or die(mysql_error());
                        $i=0;
                       while ($row2 = mysql_fetch_array($quotation_info)) {
                       $description=$row2['description'];
                      $unit=$row2['unit'];
                     $quantity=$row2['quantity'];
                     $unit_price=$row2['unit_price'];
                     $net=$quantity*$unit_price;
                     $i++;

                        ?>
                         <tr>
                             <td><?php echo $i;?></td>
                            <td>
                                 <?php
                                 echo $description;
                                 ?>      
                            </td>
                            <td><?php echo $unit;?></td>
                            <td><?php echo $quantity;?></td>
                            <td><?php echo $unit_price;?></td>
                            <td style=" "><?php echo $net;?></td>
                        </tr>
                        <?php                        
                       }
                       ?>

                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;">        
                            </td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td>Sub-Total</td>
                            <td>22,400.00</td>
                        </tr>
                         <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;">        
                            </td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td>Add Vat 18%</td>
                            <td>22,400.00</td>
                        </tr>
                         <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;">        
                            </td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="font-weight: bold;">Grand Total</td>
                            <td>22,400.00</td>
                        </tr>
                    </table>
                    
                </div>
          <div class="" style="width: 920px;">
              
          </div>

                  <div class="footer" style="width: 980px;">
                    <p style="font-weight: 800; text-align: center">
                        Sincro Site Watch Limited<br>
                         P.O.Box 80407, Dar es Salaam.Head office:Plot No. 1337 Msonge Street,Mikocheni 'A'.<br>
                         Tel:+255 222 700971;Fax:+255 222 700970 Sales:+255 714 500900;Operations:+255 719 041604;Technical:<br>
                         Emails:sales@sincrositewatch.com;operations@sincrositewatch.com;Website:www.sincrositewatch.com
                    </p>
                </div>
                    
                    </div>


    </body>   
    </html>