<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">


				<xsl:for-each select='//movie'>
				
				
					
					<h2><xsl:value-of select="title"/> ( <xsl:value-of select="date"/> )</h2>
					
					<p>
					<b>Genre</b> : <xsl:value-of select='genres'/>
					<br/>
					
					<xsl:choose>
						<xsl:when test="count(actor) &gt; 1">
						<b>Acteurs : </b>
						</xsl:when>
						<xsl:otherwise>
						<b>Acteur : </b>
						</xsl:otherwise>
					</xsl:choose>
					<xsl:for-each select="actor">
							<xsl:value-of select="node()"/>.
					</xsl:for-each>
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
							<xsl:value-of select="node()"/>.
					</xsl:for-each>
					<br/>
					
					<b>Date de sortie</b> : <xsl:value-of select='date'/>
					<br/>	
					
					<b>Duree</b> : <xsl:value-of select='runtime'/> min
					<br/>	
					
					<b>Langue</b> : <xsl:value-of select='language'/>
					<br/><br/>
					
					<xsl:value-of select="summary"/>...<br/><br/><br/>
					</p>
					
					<xsl:choose>
						<xsl:when test="$loue = 1">
							<xsl:element name="video">
								<xsl:attribute name="width">
									99%
								</xsl:attribute>
								<xsl:attribute name="height">
									99%
								</xsl:attribute>
								<xsl:attribute name="poster">
									<xsl:value-of select="concat('Web/videos/poster/', title, '.png')" />
								</xsl:attribute>
								<xsl:attribute name="src">
									Web/videos/<xsl:value-of select="title" />.mp4
								</xsl:attribute>
								<xsl:attribute name="controls" />
								Votre navigateur n'est pas compatible avec le HTML 5, désolé.
							</xsl:element>
						</xsl:when>
						<xsl:otherwise>
							<div class="miniature" style="float:left;">
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
						</xsl:otherwise>
					</xsl:choose>

					<xsl:element name="a">
						<xsl:attribute name="href">/WebVideo/achat-<xsl:value-of select="@id"/>.html</xsl:attribute>
						<xsl:attribute name="name">Acheter</xsl:attribute>
						<xsl:attribute name="style">background-color: cyan;color: purple; font-weight:bold</xsl:attribute>
						<xsl:attribute name="onclick" />
						Acheter
					</xsl:element>
					
					<xsl:element name="a">
						<xsl:attribute name="href">/WebVideo/location-<xsl:value-of select="@id"/>.html</xsl:attribute>
						<xsl:attribute name="name">Louer</xsl:attribute>
						<xsl:attribute name="style">background-color: red;color: purple; font-weight:bold</xsl:attribute>
						<xsl:attribute name="onclick" />
						Louer
					</xsl:element>
						
				</xsl:for-each>
			
</xsl:template>
</xsl:stylesheet>
