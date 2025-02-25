<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Stores item in session if chosen to Place Bid
*/
session_start();
error_reporting();

// if newly logged in
if (isset($_POST["bidThis"])) {
	$_SESSION["bidThis"] = $_POST;  
}  else{
	echo "Hello, return to <a href='../bidding.htm'>Bidding page here</a>.";
}

?>