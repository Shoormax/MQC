<?php

define('FPDF_FONTPATH','../../fonts');
require ('../include/fpdf.php');
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Panier.php';
include_once '../classes/Produit.php';

class PDF extends FPDF
{

// Crée le tableau de produit
    function ProduitTable($header, $panier, $produits)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // En-tête
        $w = array(10, 90,  25, 35, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Données
        $fill = false;
        foreach($produits as $produit)
        {
            //Récupération du produit
            $p = Produit::rechercheParId($produit['id_produit']);

            $quantite = $panier->getQuantiteProduit($p->getId());
            $prix = $p->getPrix();
            $total = $prix * $quantite;


            $this->Cell($w[0],7,$p->getId(),'LR', 0,'C',$fill);
            $this->Cell($w[1],7,utf8_decode($p->getLibelle()),'LR', 0,'L',$fill);
            $this->Cell($w[2],7,$quantite,'LR', 0,'C',$fill);
            $this->Cell($w[3],7,$prix,'LR', 0,'C',$fill);
            $this->Cell($w[4],7,$total,'LR', 0,'C',$fill);


            $this->Ln();
            $fill = !$fill;
        }
        // Dernière ligne Total
        $this->Cell(125,0,'','T');
        $this->SetFont('','B');
        $this->Cell(35, 9, utf8_decode('Total à régler'), 1, 0, 'C');
        $this->Cell(30, 9, $panier->getTotal(), 1, 0, 'C');
    }
}

//Récupération du panier à l'aide de l'url et de la méthode rechercheParId
$panier = Panier::rechercheParId($_GET['id']);

$pdf = new PDF();
// Titres des colonnes
$header = array('ID', 'Libelle', utf8_decode('Quantité'), 'Prix unitaire', 'Total');
// Chargement des données
$produits = $panier->getProduits();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->ProduitTable($header,$panier, $produits);
$pdf->Output();
?>