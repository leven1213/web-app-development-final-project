/*
	Author: Levenspeil Sangalang (104328146)
	Date: 16/10/2023
    Function: Calls out transform-xsl.php file to generate XSLT table
*/

// Create XMLHttpRequest object for making AJAX requests
var xhr = false;
if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest(); // For modern browsers
}
else if (window.ActiveXObject) {
    xhr = new ActiveXObject("Microsoft.XMLHTTP"); // For older versions of Internet Explorer
}   

// Function to trigger report generation by calling transform-xsl.php
function generateReport() {
    // Open a GET request to fetch data from transform-xsl.php file
    xhr.open("GET", "../php/transform-xsl.php", true);

    // Define callback function to process XSLT response
    xhr.onreadystatechange = generateReportXSLT;

    // Send request to server
    xhr.send(null);    
}

// Callback function to handle XSLT response
function generateReportXSLT() {
    // Check if request has completed successfully (readyState == 4, status == 200)
    if (xhr.readyState == 4 && xhr.status == 200){
        // Get HTML element where XSLT result will be inserted
        var generateResults = document.getElementById("generateResults");

        // Insert response (XSLT table) into specified element
        generateResults.innerHTML = xhr.responseText;
    } 
}
