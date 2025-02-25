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
                    <h3 class="regular height">In progress</h3> 
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
                    <xsl:for-each select="listedItems/listedItem">  
                    <tr>
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="customerID"/></td>
                            </xsl:if> 
 
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="itemID"/></td>
                            </xsl:if> 
 
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="itemName"/></td>
                            </xsl:if> 
  
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="category"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="startPrice"/></td>
                            </xsl:if> 
                        
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="reservePrice"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="buyItNowPrice"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="bidPrice"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="day"/>D <xsl:value-of select="hour"/>H <xsl:value-of select="minute"/>M </td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="startDate"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="startTime"/></td>
                            </xsl:if> 
                    
                           
                            <xsl:if test="status='In progress'">
                                <td><xsl:value-of select="bidderID"/></td>
                            </xsl:if>
                    </tr> 
                    </xsl:for-each>
                </table>   
                <h4 class="button-contain gold">No. of items in progress:
                    <xsl:value-of select="count(//listedItem[status='In progress'])"/>
                </h4> 

            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>