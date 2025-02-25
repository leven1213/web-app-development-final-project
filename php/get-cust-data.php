<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Opens customer.xml and checks if account is registered
*/

header('Content-Type: application/xml');

$xmlfile = '../data/customer.xml';

if (!file_exists($xmlfile)){ // if the xml file does not exist
	echo '<script type="text/javascript">' . 
	'document.getElementById("msg").innerHTML +="You have not registered."' . '</script>';
	
} else {
	$doc = new DomDocument(); 
	$doc->load($xmlfile); 
	
	echo ($doc->saveXML());
}
?>