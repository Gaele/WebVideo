<p style="text-align: center">Il y a actuellement <?php echo $nombreData; ?> clients. En voici la liste :</p>

<table>
<tr><th>Pseudonyme</th><th>MotDePasse</th><th>Montant</th><th>Mail</th><th>Action</th></tr>
<?php

foreach ($listeData as $data)
{
  echo '<tr><td>', $data['pseudonyme'], '</td><td>', $data['motDePasse'], '</td><td>', $data['montantCharge'], '</td><td>', $data['mail'], '</td><td><a href="client-update-', $data['id'], '.html"><img src="../Web/images/update.png" alt="Modifier" /></a> <a href="client-delete-', $data['id'], '.html"><img src="../Web/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
echo 'Ajouter un client : <a href="client-insert.html"><img src="../Web/images/update.png" alt="Ajouter" /></a>';
?>
</table>