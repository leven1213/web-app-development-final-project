<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Loads customer.xml
*/

header('Content-Type: text/xml');

$xmlfile = '../data/customer.xml';

if (!file_exists($xmlfile)){ // if the xml file does not exist
	alert("The xml file does not exist.");
} else {
	$doc = new DomDocument(); 
	$doc->load($xmlfile); 
	
	echo ($doc->saveXML());
}
?>