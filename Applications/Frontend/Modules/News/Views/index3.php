	<form action="" method="post">
          <legend><h1>Je recherche</h1></legend>
  <p>
    <label>Prix Location <=</label>
    <input type="text" name="prixLocation" value="<?php if (isset($_POST['prixLocation'])) echo htmlspecialchars($_POST['prixLocation']); ?>" /><br />
    
    <label>Titre</label>
	<input type="text" name="titre" value="<?php if (isset($_POST['titre'])) echo htmlspecialchars($_POST['titre']); ?>" /><br />
    <br/>
	<input type="submit" value="Chercher" />
	
  </p>
</form>

<?php

echo $result;

?>

<!--<iframe width="425" height="344" src="http://www.youtube.com/embed/lniVx_pFM_A?fs=1&quot; frameborder="0" allowFullScreen=""></iframe>-->
<!--<img src="http://cdn.pratique.fr/sites/default/files/articles/lapin-blanc.jpg" alt="lapin" /> -->
