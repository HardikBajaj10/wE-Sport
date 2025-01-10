<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" indent="yes" />

    <xsl:template match="/">
        <html>
            <head>
                <title>wE-Sports Games, Users, and Orders</title>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 80%;
                        margin: 20px auto;
                    }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f4f4f4;
                    }
                </style>
            </head>
            <body>
                <h1 style="text-align:center;">wE-Sports: Gaming and Buying Website</h1>

                <h2 style="text-align:center;">Available Games</h2>
                <table>
                    <tr>
                        <th>Game ID</th>
                        <th>Game Name</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Platform</th>
                        <th>Release Date</th>
                    </tr>
                    <xsl:for-each select="wE-Sports/Games/Game">
                        <tr>
                            <td><xsl:value-of select="GameID" /></td>
                            <td><xsl:value-of select="GameName" /></td>
                            <td><xsl:value-of select="Genre" /></td>
                            <td><xsl:value-of select="Price" /></td>
                            <td><xsl:value-of select="Platform" /></td>
                            <td><xsl:value-of select="ReleaseDate" /></td>
                        </tr>
                    </xsl:for-each>
                </table>

                <h2 style="text-align:center;">Registered Users</h2>
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Balance</th>
                    </tr>
                    <xsl:for-each select="wE-Sports/Users/User">
                        <tr>
                            <td><xsl:value-of select="UserID" /></td>
                            <td><xsl:value-of select="Username" /></td>
                            <td><xsl:value-of select="Email" /></td>
                            <td><xsl:value-of select="Balance" /></td>
                        </tr>
                    </xsl:for-each>
                </table>

                <h2 style="text-align:center;">Purchase Orders</h2>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Game ID</th>
                        <th>Purchase Date</th>
                        <th>Total Price</th>
                    </tr>
                    <xsl:for-each select="wE-Sports/Orders/Order">
                        <tr>
                            <td><xsl:value-of select="OrderID" /></td>
                            <td><xsl:value-of select="UserID" /></td>
                            <td><xsl:value-of select="GameID" /></td>
                            <td><xsl:value-of select="PurchaseDate" /></td>
                            <td><xsl:value-of select="TotalPrice" /></td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
