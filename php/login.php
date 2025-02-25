<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Stores login info in session
*/
session_start();
error_reporting();

// if newly logged in
if (isset($_POST["email-log"]) && isset($_POST["pwd-log"])) {
	$_SESSION["email-log"] = $_POST["email-log"];
	$_SESSION["pwd-log"] = $_POST["pwd-log"];
	$xmldata = simplexml_load_file("../data/customer.xml");
	foreach ($xmldata->children() as $login) {
		if ($login->email == $_SESSION["email-log"]) {
			header("location:../bidding.htm");
			$_SESSION["customer"] = (string)$login->id;
		}
	}
}  else{
	echo "Hello, return to <a href='../bidding.htm'>Bidding page here</a>.";
}

// if session is already stored
if (isset($_SESSION["email-log"]) && ($_SESSION["pwd-log"])) {
	echo "<br/> Or you can go to the <a href='../listing.htm'>Listing page here</a>.";
}
	
?>