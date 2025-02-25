<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Opens auction.xml and checks item info-creates item if meeets format
*/

header('Content-Type: text/plain');
session_start();
error_reporting();

if(isset($_GET["itm-name"])){
	$itmname = $_GET["itm-name"];
	$itmcatg = $_GET["itm-catg"]; 
	$itmdsc = $_GET["itm-dsc"];
	$startprc = $_GET["start-prc"]; 
	$rsvprc = $_GET["rsv-prc"]; 
	$buyprc = $_GET["buy-prc"]; 
	$dayqty = $_GET["day-qty"]; 
	$hrqty = $_GET["hr-qty"]; 
	$minqty = $_GET["min-qty"]; 

	$xmlfile = '../data/auction.xml'; 

	$errMsg = "";
	if (empty($itmname)) {
		$errMsg .= "<div class=\"error-msg\">Please enter an item name.</div> <br />";
	}
	
	if (empty($itmcatg)) {
		$errMsg .= "<div class=\"error-msg\">Please add a category.</div> <br />";
	} 

    if (empty($itmdsc)) {
        $errMsg .= "<div class=\"error-msg\">Please add an item description.</div> <br />";
    }  

	if ((empty($startprc)) || ($startprc <= 0)) {
		$errMsg .= "<div class=\"error-msg\">Please enter a start price, must exceed 0.</div> <br />";
	}
    if ((empty($rsvprc)) || ($rsvprc <= 0)) {
		$errMsg .= "<div class=\"error-msg\">Please enter a reserve price, must exceed 0.</div> <br />";
	}  

	if ((empty($buyprc)) || ($buyprc <= 0)) {
		$errMsg .= "<div class=\"error-msg\">Please enter a buy-it-now price, must exceed 0.</div> <br />";
	}  
 
    if ((!preg_match('#^\d+(?:\.\d{1,2})$#', $startprc)) || (!preg_match('#^\d+(?:\.\d{1,2})$#', $rsvprc)) || (!preg_match('#^\d+(?:\.\d{1,2})$#', $buyprc))) {
        $errMsg .= "<div class=\"error-msg\">Price/s must follow <i>0.00</i> format.</div> <br />";
    }  

	if(strval($startprc) > strval($rsvprc)){
		$errMsg .= "<div class=\"error-msg\">Start price must not exceed reserve price.</div> <br />";
	}

	if(strval($rsvprc) > strval($buyprc)){
		$errMsg .= "<div class=\"error-msg\">Reserve price must not exceed buy-it-now price.</div> <br />";
	}

	if (!($dayqty >= 0)) {
		$errMsg .= "<div class=\"error-msg\">Please select duration of day/s for your item.</div> <br />";
	}

    if (!($hrqty >= 0)) {
		$errMsg .= "<div class=\"error-msg\">Please select duration of hour/s for your item.</div> <br />";
	} 

	if (empty($minqty)) {
		$errMsg .= "<div class=\"error-msg\">Please select duration of minute/s for your item.</div> <br />";
	}  
	
	if ($errMsg != "") {
		echo $errMsg;
	}
	else {
	    $doc = new DomDocument();
        
	    if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $listeditems
	    	$listeditems = $doc->createElement('listedItems');
	    	$doc->appendChild($listeditems);
	    }
	    else { // load the xml file
	    	$doc->preserveWhiteSpace = FALSE; 
	    	$doc->load($xmlfile);  
	    }
    
	    //create a listeditem node under listeditems node
	    $listeditems = $doc->getElementsByTagName('listedItems')->item(0);
	    $listeditem = $doc->createElement('listedItem');
	    $listeditems->appendChild($listeditem);

		// create a CustomerId node ....
	    $CustomerId = $doc->createElement('customerID');
	    $listeditem->appendChild($CustomerId);   
	    $customerIdValue = $doc->createTextNode($_SESSION["customer"]);
	    $CustomerId->appendChild($customerIdValue); 

        // create an ItemID node under listeditem node ....  
	    $ItemId = $doc->createElement('itemID');
	    $listeditem->appendChild($ItemId);
        $itemid = $doc->getElementsByTagName('listedItem')->length;
	    $itemidValue = $doc->createTextNode($itemid);
	    $ItemId->appendChild($itemidValue);
		// keep item ID in session
		$_SESSION["itemid"] = $itemid; 
 
	    // create an ItemName node ....
	    $ItemName = $doc->createElement('itemName');
	    $listeditem->appendChild($ItemName);
	    $itemnameValue = $doc->createTextNode($itmname);
	    $ItemName->appendChild($itemnameValue);
		
        // create a Category node ....
	    if (!isset($GET["other-name"])) {
			$Category = $doc->createElement('category');
			$listeditem->appendChild($Category);
			$categoryValue = $doc->createTextNode($itmcatg);
			$Category->appendChild($categoryValue);
		} else {
			$othercatg = $_GET["other-name"]; 
			$otherCategory = $doc->createElement('category');
			$listeditem->appendChild($otherCategory);
			$otherValue = $doc->createTextNode($othercatg);
			$otherCategory->appendChild($otherValue);
		}
    
	    // create an Description node ....
	    $Desc = $doc->createElement('description');
	    $listeditem->appendChild($Desc);
	    $descValue = $doc->createTextNode($itmdsc);
	    $Desc->appendChild($descValue);
    
	    // create a StartPrice node ....
	    $StartPrice = $doc->createElement('startPrice');
	    $listeditem->appendChild($StartPrice);
	    $startprcValue = $doc->createTextNode($startprc);
	    $StartPrice->appendChild($startprcValue); 

		// create a ReservePrice node ....
	    $ReservePrice = $doc->createElement('reservePrice');
	    $listeditem->appendChild($ReservePrice);
	    $resvprcValue = $doc->createTextNode($rsvprc);
	    $ReservePrice->appendChild($resvprcValue); 

		// create a BuyItNowPrice node ....
	    $BuyItNowPrice = $doc->createElement('buyItNowPrice');
	    $listeditem->appendChild($BuyItNowPrice);
	    $buyprcValue = $doc->createTextNode($buyprc);
	    $BuyItNowPrice->appendChild($buyprcValue); 

		// create a Bid node ....
	    $Bid = $doc->createElement('bidPrice');
	    $listeditem->appendChild($Bid);
	    $bidValue = $doc->createTextNode($startprc);
	    $Bid->appendChild($bidValue); 

		// php date/time function from W3schools.com
		date_default_timezone_set("Australia/Melbourne");
		$curDate = date("d/m/Y");
		$curTime = date("h:i:sa");

		// create a Day node ....
	    $Day = $doc->createElement('day');
	    $listeditem->appendChild($Day);
	    $dayValue = $doc->createTextNode($dayqty);
	    $Day->appendChild($dayValue);  

		// create a Hour node ....
	    $Hour = $doc->createElement('hour');
	    $listeditem->appendChild($Hour);
	    $hourValue = $doc->createTextNode($hrqty);
	    $Hour->appendChild($hourValue);  

		// create a Minute node ....
	    $Minute = $doc->createElement('minute');
	    $listeditem->appendChild($Minute);
	    $minuteValue = $doc->createTextNode($minqty);
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
		// keep date in session
		$_SESSION['startdate'] = $strdateValue->textContent;

		// create a StartTime node ....
	    $StartTime = $doc->createElement('startTime');
	    $listeditem->appendChild($StartTime); 
	    $strtimeValue = $doc->createTextNode($curTime);
	    $StartTime->appendChild($strtimeValue);  
		// keep time in session
		$_SESSION['starttime'] = $strtimeValue->textContent;

		// create a BidderId node ....
	    $BidderId = $doc->createElement('bidderID');
	    $listeditem->appendChild($BidderId);   
	    $bidderIdValue = $doc->createTextNode($_SESSION["customer"]);
	    $BidderId->appendChild($bidderIdValue);
		
	    // save the XML file
	    $doc->formatOutput = true;
	    $doc->save($xmlfile);  
		
		$_SESSION["GET"] = $_GET;
		
		echo '<div class="success">Thank you! Your item has been listed in ShopOnline. <br/> The item number is '; 
		echo '<strong>';
		echo $_SESSION['itemid'];
		echo '</strong>';
		echo ', and the bidding starts now: '; 
		echo '<strong>';
		echo $_SESSION['starttime']; 
		echo '</strong>';
		echo ' on ';
		echo '<strong>';
		echo $_SESSION['startdate']; 
		echo '</strong>';
		echo '</div>';
	} 
}
?>