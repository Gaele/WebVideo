<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
<head>
        <title>Title</title>
		<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="Envision.css" type="text/css" />
</head>
<body>
        <xsl:for-each select="//movie">
                <h2><a href="news-01.html">
				<xsl:value-of select="title"/> ( <xsl:value-of select="date"/> )</a></h2>

				<div class="miniature" style="float:left;width:40%;">
					<img style="width:99%;" src="Web/videos/poster/
					<xsl:value-of select='title'/>.png" />
				</div>

				<p>
				<b>Duree</b> : <xsl:value-of select='runtime'/> min
				<br/>
				
				
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
				<br/>
				
				<b>Acteurs</b>
				<xsl:for-each select="actor">
                        <xsl:value-of select="role"/> :
                        <xsl:value-of select="name/firstname"/>
                        <xsl:value-of select="name/lastname"/><br/>
                </xsl:for-each>
				
				<br/>
				<b>Description :</b><br/>
				<xsl:value-of select="summary"/>
				
        </xsl:for-each>
</body>
</html>
</xsl:template>
</xsl:stylesheet>



