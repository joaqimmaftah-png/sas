<html>
    <head>
         <!--<meta http-equiv="refresh" content="50">-->
    </head>
<body>
<?php
require_once __DIR__ . '/mysql_compat.php';

function SendSMS ($host, $port, $username, $password, $phoneNoRecip, $msgText) {
// Parameters:
$host ="127.0.0.1";//IP address or host name of the NowSMS server
$port = "8800"; //"Port number for the web interface" of the NowSMS Server

/*$username - "SMS Users" account on the NowSMS server
$password - Password defined for the "SMS Users" account on the NowSMS Server
$phoneNoRecip - One or more phone numbers (comma delimited) to receive the text message
$msgText - Text of the message
*/
$fp = fsockopen($host, $port, $errno, $errstr);
if (!$fp) {

return $result;
}
fwrite($fp, "GET /?Phone=" . rawurlencode($phoneNoRecip) . "&Text=" .

 rawurlencode($msgText) . " HTTP/1.0\n");
if ($username != "") {
$auth = $username . ":" . $password;
$auth = base64_encode($auth);
fwrite($fp, "Authorization: Basic " . $auth . "\n");
}
fwrite($fp, "\n");
$res = "";
while(!feof($fp)) {
$res .= fread($fp,1);
}
fclose($fp);
return $res;
}


$phone='0715787801';

$msg='mamboo';
$host = 'localhost';
$port = '8800';
$username = 'admin';
$password = 'admin';
//$phone = '0654491973';
//$msg = 'sio mimi nani kamwaga pombe yangu';
SendSMS($host,$port,$username,$password,$phone,$msg);
?>
</body>
</html>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        