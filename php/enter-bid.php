<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <!-- Viewport set to scale 1.0 -->       
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Descriptive meta tags -->   
    <meta name="description" content="ShopOnline bidding">
	<meta name="keywords" content="ShopOnline, bid, bidding">
	<meta name="author" content="Levenspeil Sangalang"> 
    <title>ShopOnline &#8211; Bid Item</title>
    <!-- References to external basic CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">  
    <!-- References to external script file/s --> 
    <script type="text/javascript" src="../js/validate-bid.js"></script>
    <!-- References to external fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;600;800&display=swap" rel="stylesheet"> 
</head>
<body>    
    <header>
        <h1 class="semibold blue">ShopOnline<h1>
        <menu>   
            <li><a href="../listing.htm">Listing</a></li>
            <li><a href="../bidding.htm" id="select">Bidding</a></li>
            <li><a href="../maintenance.htm">Maintenance</a></li>
            <li><a href="../php/logout.htm">Logout</a></li>
        </menu>
    </header>
    <?php 
        session_start();
        if (isset($_POST["buyThis"])){
            $_SESSION["buyThis"] = $_POST["buyThis"];
            $_SESSION["startPrice"] = $_POST["startPrice"];
            $_SESSION["bidPrice"] = $_POST["bidPrice"];
            header("Location: buy-outcome.php");
        } 
        else {
            $_SESSION["bidThis"] = $_POST; 
        }
    ?>
    <!-- General container containing elements --> 
    <div class="form-pop" id="popBidForm"> 
        <p class="error-msg-pln" id="msg"></p> 
        <form method="POST" action="bid-outcome.php">
            <div class="semibold height">Item No. 
            <input type="text" class="input-disable transform-left" id="itemNo" name="itemNo" value="<?php echo $_POST["itemID"]; ?>"></div>
            <h2><?php echo $_POST["itemName"]; ?> </h2> </form>
            <br/>
            <p>Enter bidding price</p>
            <div class="input-field"><input type="text" id="inputPrice" name="inputPrice"></div>
            <input type="hidden" class="input-disable" id="startPrice" name="startPrice" value="<?php echo $_POST["startPrice"]; ?>">
            <button id="fill-btn" onclick="validateBid()">Bid Item</button>
            <br/> 
        </form>
        <button id="red-fill" onclick="window.location.href='../bidding.htm';">Close</button>
	</div>
</body>
</html>