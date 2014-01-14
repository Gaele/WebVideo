<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
        <title>Title</title>
		<link rel="stylesheet" href="Web/css/Envision.css" type="text/css" />
</head>
<body>
	<div id="wrap">
		<div id="header">
			<h1 id="logo-text"><a href="/">Mon super site</a></h1>
			<p id="slogan">Comment ça « il n'y a presque rien » ?</p>
		</div>

		<div  id="menu">
			<ul>
				<li><a href="/">Accueil</a></li>
				<li><a href="/admin/">Admin</a></li>
				<li><a href="/admin/news-insert.html">Ajouter une news</a></li>
			</ul>
		</div>

		<div id="content-wrap">
			<div id="main">
				<xsl:for-each select="//movie">
					<h2><a href="news-01.html">
					<xsl:value-of select="title"/> ( <xsl:value-of select="date"/> )</a></h2>
					
					<div class="miniature" style="float:left;width:40%;">
						<img style="width:99%;" src="" />
						<xsl:element name="img">
							<xsl:attribute name="src">
								<xsl:value-of select="concat('Web/videos/poster/', title, '.png')" />
							</xsl:attribute>
							<xsl:attribute name="style">
								width:99%
							</xsl:attribute>						
						</xsl:element>
					</div>

					<b>Duree</b> : <xsl:value-of select='runtime'/> min
					<br/>	
					
					<xsl:choose>
							<xsl:when test="count(directors/director) &gt; 1">
							<b>Realisateurs : </b>
							</xsl:when>
							<xsl:otherwise>
							<b>Realisateur : </b>
							</xsl:otherwise>
					</xsl:choose>
					<xsl:for-each select="directors/director">
							<xsl:value-of select="name/firstname"/>
							<xsl:value-of select="name/lastname"/>,
					</xsl:for-each>
					<br/>
					
					<b>Acteurs : </b>
					<xsl:for-each select="actor">
							<xsl:value-of select="role"/> /
							<xsl:value-of select="name/firstname"/>
							<xsl:value-of select="name/lastname"/>,<br/>
					</xsl:for-each>
					
					<br/>
					<b>Description :</b><br/>
					<xsl:value-of select="summary"/>
				</xsl:for-each>
			</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>



