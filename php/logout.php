<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Logs out account 
*/
session_destroy();
header('Location: ../login.htm');

?>