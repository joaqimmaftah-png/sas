<!DOCTYPE html>
<html>
    <head>
        <style>
            table.payslip {
                border-collapse: collapse;
                width:100%;
                border: 1px solid black;
            }

            table.payslip, tr, th {
                border: 1px solid black;
                text-align: left;
            }
            tablepayslip, tr, td.juu {
                border: 1px solid transparent;
            }
            tablepayslip, tr, td.kati {
                border: 1px solid transparent;
            }
        </style>
       
    </head>
    <body>
        <div class="" >
            <div class="" style="width: 800px;" style="border:2px solid black">
                <div style="width:200px;float: left;height: 80px;">

                </div>
                <div style="width:470px; height: 82px;float: left;">
                    <img src="images/logojuu.png" style="width:300px;">  
                    <div class="">
                        <h4 style="margin-left:20px;">Pay Slip for the Period of March 2009</h4>
                    </div>
                </div>
                <div style="width:100px;height: 90px;float: left;">
                    <img src="images/logoo.png" style="width:100px; height:90px;">
                </div>
                <div style="clear: both;">               
                </div>

            </div>
            <div class="" style="width: 774px;margin-top: 8px;">
                <div style="float:left; width: 386px;">
                    <table class="payslip">
                        <tr>
                            <td class="juu">Employee id</td>
                            <td class="juu">:02</td>
                        </tr>
                        <tr>
                            <td class="juu">Departments</td>
                            <td class="juu">:Information Technology</td>
                        </tr>
                        <tr>
                            <td class="juu">Date of Birth</td>
                            <td class="juu">:05/05/1889</td>
                        </tr>
                        <tr>
                            <td class="juu">Date of Joining</td>
                            <td class="juu">:05/05/2015</td>
                        </tr>
                        <tr>
                            <td class="juu">Date of Worked</td>
                            <td class="juu">:25.5</td>
                        </tr>
                    </table>
                </div>
                <div style="float:left; width: 388px;">
                    <table class="payslip">
                        <tr>
                            <td class="juu">Name</td>
                            <td class="juu">:JOAQIM MAFTAH</td>
                        </tr>
                        <tr>
                            <td class="juu">Designation</td>
                            <td class="juu">:Information Technology</td>
                        </tr>
                        <tr>
                            <td class="juu">Pay Date</td>
                            <td class="juu">:05/05/1889</td>
                        </tr>
                        <tr>
                            <td class="juu">Bank Acount Name</td>
                            <td class="juu">:NMB</td>
                        </tr>
                        <tr>
                            <td class="juu">PF Account Number</td>
                            <td class="juu">:098678899865</td>
                        </tr>
                    </table>
                </div>
                <div class="clear: both;"></div>
            </div>

            <div class="" style="width: 774px;margin-top: 8px;">
                <div style="float:left; width: 384px;border-left: 1px solid black;border-right: 1px solid black;margin-right: 1px; ">
                    <table class="payslip" style="">
                        <tr>
                            <th>Earnings</th>
                            <th style=" text-align: right">Amounts</th>
                        </tr>
                        <tr>
                            <td>Basic Pay</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <td>Dearness Allowance</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                       <tr>
                            <td>Conveyance</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <td>House Rent Allowance</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <td>Medical Allowance</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <th>Total Earnings</th>
                            <th style=" text-align: right">34906667.34</th>
                        </tr>
                       
                    </table>
                </div>
                <div style="float:left; width: 384px;border-right: 1px solid black;">
                    <table class="payslip">
                        <tr>
                            <th>Deductions</th>
                            <th style=" text-align: right">Amount</th>
                        </tr>
                        <tr>
                            <td>Professional Tax</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <td>Provident Fund</td>
                            <td style=" text-align: right">$100</td>
                        </tr>
                        <tr>
                            <td style="height: 43px;vertical-align: bottom;"></td>                          
                        </tr>
                       
                        <tr>
                            <th>Total Deductions</th>
                            <th style=" text-align: right">34545.97</th>
                        </tr>
                        <tr>
                            <th>Net Pay(Rounded)</th>
                            <th style=" text-align: right">34545.97</th>
                        </tr>
                    </table>
                </div>
                <div class="clear: both;"></div>
            </div>

        </div>

    </body>
</html>

<?php
require_once __DIR__ . '/mysql_compat.php';

$date=date("M,Y", strtotime("-1 month"));
echo $date;
?>