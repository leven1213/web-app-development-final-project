
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <!-- Viewport set to scale 1.0 -->       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Descriptive meta tags -->   
        <meta name="description" content="ShopOnline bidding">
        <meta name="keywords" content="ShopOnline, buy, bidding">
        <meta name="author" content="Levenspeil Sangalang"> 
        <title>ShopOnline &#8211; Buy Item</title>
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
                <li><a href="../php/logout.php">Logout</a></li>
            </menu>
        </header>
        <?php 
            session_start(); 

            if(isset($_SESSION["buyThis"])){ 
                $bidPrice = $_SESSION["bidPrice"]; 
                $startPrice = $_SESSION["startPrice"]; 
                $itemNo = $_SESSION["buyThis"];  
                $xmlfile = '../data/auction.xml'; 

                $doc = new DomDocument();  
                $doc->preserveWhiteSpace = FALSE; 
                $doc->load($xmlfile);  

                //create a listeditem node under listeditems node
                $listeditemGet = $doc->getElementsByTagName('listedItem'); 

                foreach($listeditemGet as $node)
                {
                    $itemID = $node->getElementsByTagName('itemID')->item(0);
                    $itemID = $itemID->nodeValue;

                    $itemName = $node->getElementsByTagName('itemName')->item(0);
                    $itemName = $itemName->nodeValue;

                    $buyprcValue = $node->getElementsByTagName('buyItNowPrice')->item(0);
					$buyprcValue = $buyprcValue->nodeValue;

                    if($itemID == $itemNo){
                        $bidValue = $node->getElementsByTagName('bidPrice')->item(0);
                        $bidValue = $bidValue->nodeValue = $buyprcValue ;

                        $currentStatus = $node->getElementsByTagName('status')->item(0);
                        $currentStatus = $currentStatus->nodeValue = 'Sold';

                        $successMsg = "<br/>Thank you for purchasing<br/>";  
                    }
                }
                // save the XML file
                $doc->formatOutput = true;
                $doc->save($xmlfile); 
                unset($_SESSION['buyThis']); 
            } 
        ?>
        <div class="form-pop"> 
            <h2 id="msg"> <?php echo $successMsg; echo $itemName; ?>!</h2>
            <br/>  
            <button id="red-fill" onclick="window.location.href='../bidding.htm';">Return to Bid</button>
	    </div>
    </body>
</html>