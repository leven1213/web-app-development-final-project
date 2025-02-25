<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Transforms auction.xml to XSLT table
*/
    $xml = new DOMDocument;
    $xml->load('../data/auction.xml');

    $xsl = new DOMDocument;
    $xsl->load('../data/generate-report.xsl');

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    echo $proc->transformToXML($xml);
?>
