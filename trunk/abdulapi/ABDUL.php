<?php
require_once('nusoap.php');

class ABDUL {

    function getAnswer($query) {
		
	$res="";

	$send="<ms><bot>ABDUL</bot><txt>$query</txt><from>wordpress</from></ms>";
	
	if(!mb_check_encoding($send,'UTF-8')){
		$q = iconv('TIS-620', 'UTF-8', $send);
	}
       		
$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
$eventclient = new nusoap_client('http://203.185.132.242/agent/ABDULChatter/wsdl/ABDUL.wsdl', 'wsdl',
                                                $proxyhost, $proxyport, $proxyusername, $proxypassword);
        $err = $eventclient->getError();
        if ($err) {
        }
        $eventclient->soap_defencoding = "UTF-8";
        $eventclient->decode_utf8  = false;
        $parameters = array('in'=>$send);
        $result = $eventclient->call('response',$parameters);
		
				if ($eventclient->fault) {
					
				} else {
						$err = $eventclient->getError();
						if ($err) {
							echo $err;
						} else {
							$res = $result['responseReturn'];
							$res = str_replace("\n","",$res);
				
						}
				}
					
		return $res;
    }
}
?>
