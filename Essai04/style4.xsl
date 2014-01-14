<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
<head>
        <title>Title</title>
</head>
<body>
        <xsl:for-each select="//movie">
                <h1><xsl:value-of select="title"/> ( <xsl:value-of select="year"/> )</h1>
                <xsl:choose>
                        <xsl:when test="count(directors/director) &gt; 1">
                        Realisateurs :
                        </xsl:when>
                        <xsl:otherwise>
                        Realisateur :
                        </xsl:otherwise>
                </xsl:choose>

                <xsl:for-each select="directors/director">
                        <xsl:value-of select="name/firstname"/>
                        <xsl:value-of select="name/lastname"/>,
                </xsl:for-each>
                <p>
                        <xsl:value-of select="summary"/>
                </p>

                <xsl:for-each select="actor">
                        <xsl:value-of select="role"/> :
                        <xsl:value-of select="name/firstname"/>
                        <xsl:value-of select="name/lastname"/><br/>

                </xsl:for-each>
        </xsl:for-each>
</body>
</html>
</xsl:template>
</xsl:stylesheet>