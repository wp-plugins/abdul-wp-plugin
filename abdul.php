<?php
include_once( dirname(__FILE__).'/abdulapi/ABDUL.php');
$result ="";
$q="";
if(isset($_REQUEST['q'])){
	$q=$_REQUEST['q'];
	$abdul = new ABDUL;
	$result = $abdul->getAnswer($q);	
	echo $result;
}
?>
