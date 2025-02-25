<?php
/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Checks registration info and creates account if meets reqs
*/

header('Content-Type: text/plain');

// Hides generated database error
error_reporting(0);

session_start();

if(isset($_GET["firname"]) && isset($_GET["surname"]) && isset($_GET["email"]) && isset($_GET["password"])){

	$firname = $_GET["firname"];
	$surname = $_GET["surname"];
	$email = $_GET["email"];
	$password = $_GET["password"];
    $password2 = $_GET["password2"];  
	$xmlfile = '../data/customer.xml';
    $xmlGet = file_get_contents($xmlfile);

	$errMsg = "";
	if (empty($firname)) {
		$errMsg .= "<div class=\"error-msg\">You must enter a first name.</div> <br />";
	}
	
	if (empty($surname)) {
		$errMsg .= "<div class=\"error-msg\">You must enter a last name.</div> <br />";
	}

    if (empty($email)) {
        $errMsg .= "<div class=\"error-msg\">You must enter a valid email.</div> <br />";
    } 

    if (strpos($xmlGet, $email) !== false) {
        $errMsg .= "<div class=\"error-msg\">Email already exists.</div> <br />";
    }
    
    // email reg ex by Regexr.com
    if (!preg_match('^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$^', $email)) {
        $errMsg .= "<div class=\"error-msg\">Email should follow <i>user@email.com</i> format.</div> <br />";
    }  

	if (empty($password)) {
		$errMsg .= "<div class=\"error-msg\">You must enter a password.</div> <br />";
	}

    if (empty($password2)) {
		$errMsg .= "<div class=\"error-msg\">You must re-enter your password.</div> <br />";
	}

    if($password!=$password2){
        $errMsg .= "<div class=\"error-msg\">Sorry, passwords do not match.</div>";  
    }   
	
	if ($errMsg != "") {
		echo $errMsg;
	}
	else {
	    $doc = new DomDocument();
        
	    if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
	    	$customers = $doc->createElement('customers');
	    	$doc->appendChild($customers);
	    }
	    else { // load the xml file
	    	$doc->preserveWhiteSpace = FALSE; 
	    	$doc->load($xmlfile);  
	    }
    
	    //create a customer node under customers node
	    $customers = $doc->getElementsByTagName('customers')->item(0);
	    $customer = $doc->createElement('customer');
	    $customers->appendChild($customer);

        // create an ID node under customer node ....  
	    $Id = $doc->createElement('id');
	    $customer->appendChild($Id);
        $id = $doc->getElementsByTagName('customer')->length+1;
	    $idValue = $doc->createTextNode($id);
	    $Id->appendChild($idValue);
 
	    // create a FirstName node ....
	    $FirstName = $doc->createElement('firstname');
	    $customer->appendChild($FirstName);
	    $firnameValue = $doc->createTextNode($firname);
	    $FirstName->appendChild($firnameValue);

        // create a Surname node ....
	    $Surname = $doc->createElement('surname');
	    $customer->appendChild($Surname);
	    $surnameValue = $doc->createTextNode($surname);
	    $Surname->appendChild($surnameValue);
    
	    // create an Email node ....
	    $Email = $doc->createElement('email');
	    $customer->appendChild($Email);
	    $emailValue = $doc->createTextNode($email);
	    $Email->appendChild($emailValue);
    
	    // create a pwd node ....
	    $pwd = $doc->createElement('password');
	    $customer->appendChild($pwd);
	    $pwdValue = $doc->createTextNode($password);
	    $pwd->appendChild($pwdValue); 
    
	    // save the XML file
	    $doc->formatOutput = true;
	    $doc->save($xmlfile);  

        //send email
        $to = $_GET['email'];  
        $subject = "Welcome to ShopOnline!";
        $message = "Dear" .$_GET["firname"]. "\n, welcome to use ShopOnline! Your customer id is" .$id. "and the password is" .$_GET["password"]. ".";
        $headers = "From: registration@shoponline.com.au"; 

        $mailTo = mail($to, $subject, $message, $headers);
    
        if ($mailTo !== false) {
            echo "Dear " .$_GET['firname']. ", you have successfully registered, a confirmation email is sent to " .$_GET['email']. ".";
            $_SESSION = $_GET;
            $_SESSION["id"] = $id;  
            return true; 
        }
	} 
}

?>