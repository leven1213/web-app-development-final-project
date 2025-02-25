<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Compares date/time now to duration of bid to identify item expiry
*/
    $xml = new DOMDocument;
    $xml->load('../data/auction.xml');

    $xsl = new DOMDocument;
    $xsl->load('../data/process-report.xsl');

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    echo $proc->transformToXML($xml);

    //create a listeditem node under listeditems node
    $listeditemGet = $xml->getElementsByTagName('listedItem'); 

    foreach($listeditemGet as $node)
    {
        $startDateGet = $node->getElementsByTagName('startDate')->item(0);
        $startDateGet = $startDateGet->nodeValue;

        $startTimeGet = $node->getElementsByTagName('startTime')->item(0);
        $startTimeGet = $startTimeGet->nodeValue;

        $dayGet = $node->getElementsByTagName('day')->item(0);
        $dayGet = $dayGet->nodeValue;

        $hourGet = $node->getElementsByTagName('hour')->item(0);
        $hourGet = $hourGet->nodeValue;

        $minuteGet = $node->getElementsByTagName('minute')->item(0);
        $minuteGet = $minuteGet->nodeValue;

        $reservePrcGet = $node->getElementsByTagName('reservePrice')->item(0);
        $reservePrcGet = $reservePrcGet->nodeValue;

        $bidprcGet = $node->getElementsByTagName('bidPrice')->item(0);
        $bidprcGet = $bidprcGet->nodeValue;

        $statusGet = $node->getElementsByTagName('status')->item(0);
        $statusNow = $statusGet->nodeValue;

        if($statusNow == "In progress"){ 
            $startDuration = $startDateGet . " " . $startTimeGet;

            $durationResult = DateTime::createFromFormat("d/m/Y H:i", $startDuration);
            $dateTimeNow = new DateTime();

            $durationAdd = "P" . $dayGet . "D" . "T" . $hourGet . "H" . $minuteGet . "M";

            $durationResult->add(new DateInterval($durationAdd));  
 
        }
    }
    // save the XML file
    $doc->formatOutput = true;
    $doc->save($xmlfile);     
    alert ("Item information updated.");  
?>
