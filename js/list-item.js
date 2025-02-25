/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Calls out validate-item.php to validate inputs and shows Other txtfield if chosen
*/

// Create XMLHttpRequest object for AJAX requests
var xhr = false;
if (window.XMLHttpRequest) {
	xhr = new XMLHttpRequest(); // modern browsers
}
else if (window.ActiveXObject) {
	xhr = new ActiveXObject("Microsoft.XMLHTTP"); // older versions of IE
}

// List item validation function: Sends form data to 'validate-item.php' for validation
function listGet() {
	// Get values from input fields
	var itmName = document.getElementById('itmName').value;
	var itmCatg = document.getElementById('itmCatg').value;
	var itmDsc = document.getElementById('itmDsc').value;
	var startPric = document.getElementById('startPric').value;
	var rsvPric = document.getElementById('rsvPric').value;
	var buyPric = document.getElementById('buyPric').value;
	var dayQty = document.getElementById('dayQty').value;
	var hrQty = document.getElementById('hrQty').value;
	var minQty = document.getElementById('minQty').value;

	// Check if selected category is "other"
	if (itmCatg == "other") {
		// Get value from "Other" category field
		var otherCatg = document.getElementById('other-name').value;

		// Send form data (including custom "Other" category) to server for validation
		xhr.open("GET", "../php/validate-item.php?itm-name=" + itmName + "&itm-catg=" + otherCatg + "&itm-dsc=" + itmDsc + "&start-prc="
			+ startPric + "&rsv-prc=" + rsvPric + "&buy-prc=" + buyPric + "&day-qty=" + dayQty + "&hr-qty=" + hrQty + "&min-qty=" + minQty, true);
		xhr.onreadystatechange = listInput; // Set callback function to handle server response
		xhr.send(null); // Send request
	}
	else {
		// Send form data (without custom "Other" category) to server for validation
		xhr.open("GET", "../php/validate-item.php?itm-name=" + itmName + "&itm-catg=" + itmCatg + "&itm-dsc=" + itmDsc + "&start-prc="
			+ startPric + "&rsv-prc=" + rsvPric + "&buy-prc=" + buyPric + "&day-qty=" + dayQty + "&hr-qty=" + hrQty + "&min-qty=" + minQty, true);
		xhr.onreadystatechange = listInput; // Set callback function to handle server response
		xhr.send(null); // Send request
	}
}

// Callback function to handle server's response after submitting form data
function listInput() {
	// If request was successful (readyState 4 and status 200)
	if ((xhr.readyState == 4) && (xhr.status == 200)) {
		// Display server's response message in 'msg' element
		document.getElementById('msg').innerHTML = xhr.responseText;
	}
}

// Function to activate and display "Other" category input field
function addCatg() {
	// Get selected category from dropdown
	var addCatg = document.getElementById('itmCatg').value;

	// If user selected "Other" as category, display additional input field
	if (addCatg == "other") {
		var enableCatg = document.getElementById("addCatg");

		// Insert input field for entering custom category name
		enableCatg.innerHTML = '<label class="label-contain">Other category*</label><div class="input-field"><input type="text" name="other-name" id="other-name"> </div>';
	}
}

// Function to clear all form inputs (reset form)
function clearForm() {
	// Reset form with ID 'listingForm' to clear all input fields
	document.getElementById('listingForm').reset();
} 
