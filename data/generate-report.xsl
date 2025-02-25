<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
    <xsl:output 
        method="html"
        indent="yes" />

    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet" type="text/css" href="style.css" />  
            </head>
            <body>  
                <table>
                    <br/><br/>
                    <h3 class="regular height">Sold</h3> 
                    <br/>
                    <tr>
                        <th>Customer ID</th>
                        <th>Item ID</th>
                        <th>Item Name</th> 
                        <th>Category</th>
                        <th>Start Price</th>
                        <th>Reserve Price</th>
                        <th>Buy It Now Price</th>
                        <th>Latest Bid Price</th>
                        <th>Duration</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>Bidder ID</th>
                    </tr>
                        
                        <tr>
                        <xsl:for-each select="listedItems/listedItem">
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="customerID"/></td>
                            </xsl:if> 
 
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="itemID"/></td>
                            </xsl:if> 
 
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="itemName"/></td>
                            </xsl:if> 
  
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="category"/></td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="startPrice"/></td>
                            </xsl:if> 
                         
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="reservePrice"/></td>
                            </xsl:if> 
                        
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="buyItNowPrice"/></td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="bidPrice"/></td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="day"/>D <xsl:value-of select="hour"/>H <xsl:value-of select="minute"/>M </td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="startdate"/></td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="starttime"/></td>
                            </xsl:if> 
                     
                            <xsl:if test="status='Sold'">
                                <td><xsl:value-of select="bidderID"/></td>
                            </xsl:if> 
                        
                        </xsl:for-each>
                        </tr>
                </table>  
                <h4 class="button-contain green">No. of items sold:
                    <xsl:value-of select="count(//listedItem[status='Sold'])"/>
                </h4> 
                <p class="regular grey">Failed items revenue:
                    $<xsl:value-of select="format-number(sum(//listedItem[status='Failed']/bidPrice)*0.01, '#0.00###')"/>
                </p>

                <table>
                    <br/><br/>
                    <h3 class="regular height">Failed</h3> 
                    <br/>
                    <tr>
                        <th>Customer ID</th>
                        <th>Item ID</th>
                        <th>Item Name</th> 
                        <th>Category</th>
                        <th>Start Price</th>
                        <th>Reserve Price</th>
                        <th>Buy It Now Price</th>
                        <th>Latest Bid Price</th>
                        <th>Duration</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>Bidder ID</th>
                    </tr>
                       
                    <tr>
                        <xsl:for-each select="listedItems/listedItem"> 
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="customerID"/></td>
                            </xsl:if>
                          
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="itemID"/></td>
                            </xsl:if>
                           
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="itemName"/></td>
                            </xsl:if>
                           
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="category"/></td>
                            </xsl:if>
                          
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="startPrice"/></td>
                            </xsl:if>
                           
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="reservePrice"/></td>
                            </xsl:if> 

                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="buyItNowPrice"/></td>
                            </xsl:if> 
                          
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="bidPrice"/></td>
                            </xsl:if>
                    
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="day"/>D <xsl:value-of select="hour"/>H <xsl:value-of select="minute"/>M </td>
                            </xsl:if>

                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="startdate"/></td>
                            </xsl:if>
                    
                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="starttime"/></td>
                            </xsl:if>

                            <xsl:if test="status='Failed'">
                                <td><xsl:value-of select="bidderID"/></td>
                            </xsl:if>  
                        </xsl:for-each>
                    </tr>
                </table>  
                <h4 class="inline button-contain blue">No. of items failed:
                    <xsl:value-of select="count(//listedItem[status='Failed'])"/>
                </h4>
                <p class="regular grey">Failed items revenue:
                    $<xsl:value-of select="format-number(sum(//listedItem[status='Failed']/bidPrice)*0.03, '#0.00###')"/>
                </p>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>