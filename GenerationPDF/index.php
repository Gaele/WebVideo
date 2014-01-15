<?php
require('fpdf.php');

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=news', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$montantTotal = 0;
$reponse = $bdd->query('SELECT * FROM clients');

// Instanciation de la classe dérivée

$pdf = new FPDF();
// Titres des colonnes
$header = array('pseudonyme','nomDuTitulaire', 'mail', 'montantCharge', 'dateInscription');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();

    // En-tête
    foreach($header as $col)
        $pdf->Cell(40,7,$col,1);
    $pdf->Ln();
    // Données
while ($donnees = $reponse->fetch())
    {
        $pdf->Cell(40,6,$donnees['pseudonyme'],1);
		$pdf->Cell(40,6,$donnees['nomDuTitulaire'],1);
		$pdf->Cell(40,6,$donnees['mail'],1);
		$pdf->Cell(40,6,(string) $donnees['montantCharge'],1);
		$pdf->Cell(40,6,$donnees['dateInscription'],1);
        $pdf->Ln();
		
	$montantTotal = $montantTotal + $donnees['montantCharge'];
    }
	
$reponse->closeCursor(); 

$pdf->Cell(40,6,"montant total de tous les clients : " + (string) $montantTotal,1);
$pdf->Output();

?>