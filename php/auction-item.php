<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Opens auction.xml if exists, otherwise creates new listed item  
*/
error_reporting();
header('Content-Type: application/xml');

$xmlfile = '../data/auction.xml';

if (!file_exists($xmlfile)){ // if the xml file does not exist
	$doc = new DomDocument('1.0', 'UTF-8');
	$doc->preserveWhiteSpace = FALSE;  

	// create sample auction item
	// root node $listeditems
	$listeditems = $doc->createElement('listedItems');
	$doc->appendChild($listeditems);

	$listeditem = $doc->createElement('listedItem');
	$listeditems->appendChild($listeditem); 

	// create a CustomerId node ....
	$CustomerId = $doc->createElement('customerID');
	$listeditem->appendChild($CustomerId);   
	$customerIdValue = $doc->createTextNode('0');
	$CustomerId->appendChild($customerIdValue); 

	// create an ItemID node under listeditem node ....  
	$ItemId = $doc->createElement('itemID');
	$listeditem->appendChild($ItemId); 
	$itemid = $doc->getElementsByTagName('listedItem')->length;
	$itemidValue = $doc->createTextNode($itemid);
	$ItemId->appendChild($itemidValue);

	// create an ItemName node ....
	$ItemName = $doc->createElement('itemName');
	$listeditem->appendChild($ItemName);
	$itemnameValue = $doc->createTextNode('Samsung Galaxy S23');
	$ItemName->appendChild($itemnameValue);

	// create a Category node .... 
	$Category = $doc->createElement('category');
	$listeditem->appendChild($Category);
	$categoryValue = $doc->createTextNode('phone');
	$Category->appendChild($categoryValue);

	// create an Description node ....
	$Desc = $doc->createElement('description');
	$listeditem->appendChild($Desc);
	$descValue = $doc->createTextNode('128GB with charger. Unused');
	$Desc->appendChild($descValue);

	// create a StartPrice node ....
	$StartPrice = $doc->createElement('startPrice');
	$listeditem->appendChild($StartPrice);
	$startprcValue = $doc->createTextNode('200.00');
	$StartPrice->appendChild($startprcValue); 

	// create a ReservePrice node ....
	$ReservePrice = $doc->createElement('reservePrice');
	$listeditem->appendChild($ReservePrice);
	$resvprcValue = $doc->createTextNode('240.00');
	$ReservePrice->appendChild($resvprcValue); 

	// create a BuyItNowPrice node ....
	$BuyItNowPrice = $doc->createElement('buyItNowPrice');
	$listeditem->appendChild($BuyItNowPrice);
	$buyprcValue = $doc->createTextNode('310.00');
	$BuyItNowPrice->appendChild($buyprcValue); 

	// create a Bid node ....
	$Bid = $doc->createElement('bidPrice');
	$listeditem->appendChild($Bid);
	$bidValue = $doc->createTextNode('200.00');
	$Bid->appendChild($bidValue); 

	// php date/time function from W3schools.com
	date_default_timezone_set("Australia/Melbourne");
	$curDate = date("d/m/Y");
	$curTime = date("h:i:sa");

	// create a Day node ....
	$Day = $doc->createElement('day');
	$listeditem->appendChild($Day);
	$dayValue = $doc->createTextNode('0');
	$Day->appendChild($dayValue);  

	// create a Hour node ....
	$Hour = $doc->createElement('hour');
	$listeditem->appendChild($Hour);
	$hourValue = $doc->createTextNode('0');
	$Hour->appendChild($hourValue);  

	// create a Minute node ....
	$Minute = $doc->createElement('minute');
	$listeditem->appendChild($Minute);
	$minuteValue = $doc->createTextNode('5');
	$Minute->appendChild($minuteValue);  

	// create a Status node ....
	$Status = $doc->createElement('status');
	$listeditem->appendChild($Status);   
	$statusValue = $doc->createTextNode('In progress');
	$Status->appendChild($statusValue);

	// create a StartDate node ....
	$StartDate = $doc->createElement('startDate');
	$listeditem->appendChild($StartDate); 
	$strdateValue = $doc->createTextNode($curDate);
	$StartDate->appendChild($strdateValue);   

	// create a StartTime node ....
	$StartTime = $doc->createElement('startTime');
	$listeditem->appendChild($StartTime); 
	$strtimeValue = $doc->createTextNode($curTime);
	$StartTime->appendChild($strtimeValue);   

	// create a BidderId node ....
	$BidderId = $doc->createElement('bidderID');
	$listeditem->appendChild($BidderId);   
	$bidderIdValue = $doc->createTextNode('0');
	$BidderId->appendChild($bidderIdValue);

	// save the XML file
	$doc->formatOutput = true;
	$doc->save($xmlfile);  

} else {
	$doc = new DomDocument(); 
	$doc->load($xmlfile); 
	
	echo ($doc->saveXML());
}
?>