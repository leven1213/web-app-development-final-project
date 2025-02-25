/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
    Function: Calls out bid-outcome.php to validate inputs
*/

// Create XMLHttpRequest object for AJAX requests
var xhr = false;
if (window.XMLHttpRequest) {
	xhr = new XMLHttpRequest(); // modern browsers
}
else if (window.ActiveXObject) {
	xhr = new ActiveXObject("Microsoft.XMLHTTP"); // older versions of IE
}  

// Function to validate the bid when user submits a bid
function validateBid() {  
	// Get the values entered in the form fields for bid price, starting price, and item number
	var bidPrice = document.getElementById('inputPrice').value;
    var startPrice = document.getElementById('startPrice').value;
    var itemNo = document.getElementById('itemNo').value;

	// Open a GET request to send the form data (bid price, start price, and item number) to 'bid-outcome.php'
    xhr.open("GET", "../php/bid-outcome.php?bidPrice=" + bidPrice + "&startPrice=" + startPrice + "&itemNo=" + itemNo, true);

	// Define the callback function to handle the server response
    xhr.onreadystatechange = validateMsg;

	// Send the request to the server
    xhr.send(null); 
}

// Callback function to handle the server's response after validating the bid
function validateMsg() { 
	// If the request was successful (readyState 4 and status 200)
    if ((xhr.readyState == 4) && (xhr.status == 200)) { 
		// Display the server's response (validation message) in the 'msg' element
        document.getElementById('msg').innerHTML = xhr.responseText;  
    }
}  
