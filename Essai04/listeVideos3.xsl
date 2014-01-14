<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">


				<xsl:for-each select='//movie[prixLocation &lt;= $pl]'>
				
				<xsl:if test="($a = 1 and title = $t) or $a = 0">
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
				</xsl:if>
				</xsl:for-each>
			
</xsl:template>
</xsl:stylesheet>
