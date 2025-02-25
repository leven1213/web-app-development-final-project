/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Calls out validate-register.php and get-cust-data.php to validate inputs
*/

// Create XMLHttpRequest object for AJAX requests
var xhr = false;
if (window.XMLHttpRequest) {
	xhr = new XMLHttpRequest(); // modern browsers
}
else if (window.ActiveXObject) {
	xhr = new ActiveXObject("Microsoft.XMLHTTP"); // older versions of IE
}

// Register function: Sends user data to 'validate-register.php' for validation
function registerGet() {
	// Retrieve values entered by the user
	var firname = document.getElementById('firname').value;
	var surname = document.getElementById('surname').value;
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	var password2 = document.getElementById('password2').value;

	// Open a GET request to validate-register.php with query parameters for the form data
	xhr.open("GET", "../php/validate-register.php?firname=" + firname + "&surname=" + surname + "&email=" + email + "&password=" + password + "&password2=" + password2, true);

	// Set the callback function for when the request completes
	xhr.onreadystatechange = registerInput;

	// Send the request
	xhr.send(null);
}

// Callback function to handle the response from validate-register.php
function registerInput() {
	// If the request was successful and completed (readyState 4 and status 200)
	if ((xhr.readyState == 4) && (xhr.status == 200)) {
		// Display the server's response message in the 'msg' element
		document.getElementById('msg').innerHTML = xhr.responseText;
	}
}

// Login function: Sends user credentials to 'get-cust-data.php' for account validation
function loginGet() {
	// Check if XMLHttpRequest can be opened with POST method to get user data
	if (xhr.open("POST", "../php/get-cust-data.php", true)) {
		alert("Sorry, we could not find your account."); // If POST cannot be opened, show an alert
	} else {
		// Open the POST request to 'get-cust-data.php'
		xhr.open("POST", "../php/get-cust-data.php", true);
		// Set the callback function for when the request completes
		xhr.onreadystatechange = loginInput;
		// Send the request
		xhr.send(null);
	}
}

// Callback function to handle the response from get-cust-data.php for login validation
function loginInput() {
	// If the request was successful and completed (readyState 4 and status 200)
	if ((xhr.readyState == 4) && (xhr.status == 200)) {
		// Parse the XML response
		var myXml = xhr.responseXML;
		// Get all customer data elements from the XML
		var getCustomer = myXml.getElementsByTagName('customer');

		// Retrieve the email and password entered by the user
		var emailLog = document.getElementById('email-log').value;
		var pwdLog = document.getElementById('pwd-log').value;

		// Get the element to display error messages
		var loginError = document.getElementById("msg");

		// Check if the user hasn't entered their email and password
		if ((emailLog == "") && (pwdLog == "")) {
			loginError.innerHTML = 'Please enter your email and password.' + getEmail + getPwd;
		} else {
			// Loop through the customer data and check if the entered email and password match any stored ones
			for (let i = 0; i < getCustomer.length; i++) {
				// Get email and password from the XML data for comparison
				if (getCustomer[i].getElementsByTagName('email')[0]) {
					var getEmail = getCustomer[i].getElementsByTagName('email')[0].textContent;
				}

				if (getCustomer[i].getElementsByTagName('password')[0]) {
					var getPwd = getCustomer[i].getElementsByTagName('password')[0].textContent;
				}

				// If email and password match, redirect the user to the bidding page
				if (emailLog == getEmail && pwdLog == getPwd) {
					window.location.replace("../bidding.htm"); // Redirect to bidding page
					document.getElementById("login-form").submit(); // Submit the login form (optional depending on your setup)
					return (true); // Stop further processing
				}
			}
		}

		// If no match was found, display an error message
		loginError.innerHTML = 'Sorry, we could not find your account. <br>Please try again.';
		return false; // Prevent form submission if login fails
	}
}
