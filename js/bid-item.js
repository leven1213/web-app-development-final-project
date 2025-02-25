/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
	Function: Opens auction-item.php file to create auction information for bidding
*/

var xhr = false;
if (window.XMLHttpRequest) {
	xhr = new XMLHttpRequest();
}
else if (window.ActiveXObject) {
	xhr = new ActiveXObject("Microsoft.XMLHTTP");
} 

xhr.open("POST", "../php/auction-item.php", true);
xhr.onreadystatechange = createBidItem;
xhr.send(null);

// Auto-refresh page every 15 sec
window.setTimeout( function() {
	window.location.reload();
  }, 65000);

function createBidItem(){
	// Get the container where auction items will be displayed
	var bidsArea = document.getElementById("bidsArea"); 

	// Check if the AJAX request has completed and was successful (readyState 4 and status 200)
	if ((xhr.readyState == 4) && (xhr.status == 200)) {
		 // Parse the XML response
		var myXml = xhr.responseXML;
		// Get all "listedItem" nodes from the XML
		var getListedItm = myXml.getElementsByTagName("listedItem");

		// Loop through each "listedItem" in the XML
		for (let i = 0; i < getListedItm.length; i++){ 
			// Check if the status of the auction item is "In progress"
			if(getListedItm[i].getElementsByTagName('status')[0].textContent == "In progress"){  
				// Create HTML structure for the auction item and append it to the bidsArea 
				bidsArea.innerHTML += 
				'<div class="auction-cube wide">' // Container for each auction item
					+ '<form action="../php/enter-bid.php" method="POST">' // Form for bidding or buying
						// Item No. field (hidden, to submit item ID)
						+ '<div class="label-contain">Item No:</div><div class="item-contain">'
						+ '<input type="text" class="input-disable" id="itemID" name="itemID" value="'+getListedItm[i].getElementsByTagName('itemID')[0].textContent+'"/>'
						+ '</div>'
						// Item name field (display only)
						+ '<div class="label-contain">Item name:</div><div class="item-contain">'
						+ '<input type="text" class="input-disable" id="itemName" name="itemName" value="'+getListedItm[i].getElementsByTagName('itemName')[0].textContent+'"/>'
						+ '</div>' 
						// Category field (display only)
						+ '<div class="label-contain">Category:</div><div class="info-contain">'
						+ getListedItm[i].getElementsByTagName('category')[0].textContent
						+ '</div>' 
						// Description field (display only)
						+ '<div class="label-contain">Description:</div><div class="info-contain">'
						+ getListedItm[i].getElementsByTagName('description')[0].textContent
						+ '</div>'
						// Buy It Now price field (display only)
						+ '<div class="label-contain">Buy It Now price:</div><div class="info-contain">'
						+ getListedItm[i].getElementsByTagName('buyItNowPrice')[0].textContent
						+ '</div>' 
                        // Bid price field (editable, default value is current bid price)
						+ '<div class="label-contain">Bid price:</div><div class="item-contain">'
						+ '<input type="text" class="input-disable" id="startPrice" name="startPrice" value="'+getListedItm[i].getElementsByTagName('bidPrice')[0].textContent+'"/>'
						+ '</div>'
						// Buttons for bidding and buying
						+ '<div class="button-contain center">'   
							// Place bid button
							+ '<button class="red-btn" name="bidThis" id="bidThis value="'+getListedItm[i].getElementsByTagName('itemID')[0].textContent +'">Place Bid</button>' 
							// Buy It Now button
							+ '<button class="fill-btn" name="buyThis" id="buyThis" value="'+getListedItm[i].getElementsByTagName('itemID')[0].textContent+'">Buy It Now</button>' 
						+ '</div>'
					+ '</form>'
				+ '</div>';  // Close the auction item container
			} 
		} 
	} 
}    
