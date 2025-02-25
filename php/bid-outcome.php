<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Opens auction.xml and checks bid price. Buys item if exceeds bid price
*/ 
header('Content-Type: text/plain'); 

if(isset($_GET["bidPrice"])){
	$bidPrice = $_GET["bidPrice"]; 
	$startPrice = $_GET["startPrice"]; 
	$itemNo = $_GET["itemNo"]; 
	$xmlfile = '../data/auction.xml'; 
 
	$errMsg = "";
	if (empty($bidPrice)) {
		$errMsg .= "<div class=\"error-msg\">Please enter bid price for item.</div> <br />";
	} 

	if ($bidPrice <= 0) {
		$errMsg .= "<div class=\"error-msg\">Bid price must exceed 0.</div> <br />";
	}

	if ((!preg_match('#^\d+(?:\.\d{1,2})$#', $bidPrice))) {
        $errMsg .= "<div class=\"error-msg\">Price/s must follow <i>0.00</i> format.</div> <br />";
    }

	if ($bidPrice < $startPrice){
		$errMsg .= "<div class=\"error-msg\">Bid price must exceed latest bid price.</div> <br />";
	}
	
	if ($errMsg != "") {
		echo $errMsg;
	}
	else {  
			$xmlfile = '../data/auction-0.xml';  
			$doc = new DomDocument();  
			$doc->preserveWhiteSpace = FALSE; 
			$doc->load($xmlfile);  
			//create a listeditem node under listeditems node
			$listeditemGet = $doc->getElementsByTagName('listedItem');
			$bidPriceGet = $_GET["bidPrice"]; 

			foreach($listeditemGet as $node)
			{
				$itemID = $node->getElementsByTagName('itemID')->item(0);
				$itemID = $itemID->nodeValue;

				$itemName = $node->getElementsByTagName('itemName')->item(0);
				$itemName = $itemName->nodeValue;

				if($itemID == $itemNo){
					$bidValue = $node->getElementsByTagName('bidPrice')->item(0);
					$lastBidValue = $bidValue->nodeValue;
						
					$buyprcValue = $node->getElementsByTagName('buyItNowPrice')->item(0);
					$buyprcValue = $buyprcValue->nodeValue;
					
					if(strval($bidPriceGet) >= strval($buyprcValue)){   
						$bidValue = $node->getElementsByTagName('bidPrice')->item(0);
						$bidValue = $bidValue->nodeValue = strval($bidPriceGet);

						$currentStatus = $node->getElementsByTagName('status')->item(0);
						$currentStatus = $currentStatus->nodeValue = 'Sold';

						echo "Thank you for purchasing this item.";  

					} else if (strval($bidPriceGet) > strval($lastBidValue)){
						$bidValue = $node->getElementsByTagName('bidPrice')->item(0);
						$bidValue = $bidValue->nodeValue = strval($bidPriceGet);
						echo "Thank you! Your bid is recorded in ShopOnline."; 

					} else {
						echo "Sorry, your bid is not valid.”";
					}
					// save the XML file
					$doc->formatOutput = true;
					$doc->save($xmlfile);  
				}
			} 
		} 
	}

?>