<?php

define('FPDF_FONTPATH','../../fonts');
require ('../include/fpdf.php');
include_once '../path.php';
include_once '../include/init.php';
include_once '../classes/CommunTable.php';
include_once '../classes/Utilisateur.php';
include_once '../classes/Panier.php';
include_once '../classes/Produit.php';
include_once '../classes/Boutique.php';

class PDF extends FPDF
{

    private $panier;

    function setPanier($p) {
        $this->panier = $p;
    }

    // En-tête
    function Header()
    {
        // Logo
        $this->Image('../../img/min/Musee.png',20,6,30);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        $this->Cell(120);
        // Titre
        $this->Cell(70,10,'Facture de votre panier',1,0,'C');
        $this->Ln(10);
        //Date
        $this->SetFont('Arial','',14);
        //$this->Cell(190,8,'Date : ' . date("d/m/Y"),0,0,'R');
        $this->Cell(190,8,'Date : ' . $this->panier->getDateAdd(true),0,0,'R');
        $this->Ln(8);
        //Nom société
        //$this->SetTextColor(0,158,215);
        $this->SetFont('Arial','',16);
        $this->Cell(70,10,'Mon Quartier Confluence',0,0,'L');
        $this->Ln(15);
    }

    //Info utilisateur
    function Utilisateur($user) {
        $this->Rect(105,43,95,33);
        $this->SetFont('Arial','IU',15);
        $this->Cell(144);
        $this->Cell(50,12,'Informations client',0,1,'L');
        $this->SetFont('Arial','',14);
        $this->Cell(100);
        $this->Cell(70,6,utf8_decode('Nom : ' . $user->getNom()),0,1,'L');
        $this->Cell(100);
        $this->Cell(70,6,utf8_decode('Prénom : ' . $user->getPrenom()),0,1,'L');
        $this->Cell(100);
        $this->Cell(70,6,'Courriel : ' . $user->getEmail(),0,0,'L');
        $this->Ln(15);
    }

    // Crée le tableau de produit
    function TableauProduit($header, $boutique, $produits)
    {
        // A ajouter : Infos boutique

        $this->SetFont('Arial','B', 15);
        $this->Cell(35, 10, '   Produits :', 0, 1, 'L');
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // En-tête
        $w = array(10, 90,  25, 35, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Courier');

        // Données
        $fill = false;
        $somme = 0;
        foreach($produits as $produit)
        {

            $quantite = $this->panier->getQuantiteProduit($produit->getId());
            $prix = $produit->getPrix();
            $total = $prix * $quantite;
            $somme += $total;

            $this->Cell($w[0],7,$produit->getId(),'LR', 0,'C',$fill);
            $this->Cell($w[1],7,'   ' . utf8_decode($produit->getLibelle()),'LR', 0,'L',$fill);
            $this->Cell($w[2],7,$quantite,'LR', 0,'C',$fill);
            $this->Cell($w[3],7,$prix,'LR', 0,'C',$fill);
            $this->Cell($w[4],7,$total,'LR', 0,'C',$fill);


            $this->Ln();
            $fill = !$fill;
        }
        // Dernière ligne Total
        $this->Cell(125,0,'','T');
        $this->SetFont('Arial','B');
        $this->Cell(35, 9, utf8_decode('Total à régler'), 1, 0, 'C');
        $this->Cell(30, 9, $somme, 1, 0, 'C');

        return $somme;
    }
}

//Récupération du panier à l'aide de l'url et de la méthode rechercheParId
$panier = Panier::rechercheParId($_GET['id']);

$pdf = new PDF();
$pdf->setPanier($panier);
// Titres des colonnes
$header = array('ID', 'Libellé', 'Quantité', 'Prix unitaire', 'Total');
// Récupération des produits et tri par boutique
$produits = $panier->getProduits();
$idBoutiques = array();
$produitsBoutique = array();
$cpt = 0;
foreach($produits as $produit) {
    //Récupération du produit
    $p = Produit::rechercheParId($produit['id_produit']);
    //Si l'id de la boutique n'existe pas encore dans notre liste, on l'ajoute
    if (!in_array($p->getIdBoutique(), $idBoutiques)) {
        $idBoutiques[$cpt] = $p->getIdBoutique();
        //On crée un tableau qui recevra les produits de cette boutique
        $produitsBoutique[$p->getIdBoutique()] = array();
        $cpt++;
    }
    //Ajout du produit dans sa boutique correspondantes
    array_push($produitsBoutique[$p->getIdBoutique()], $p);
}

$pdf->AddPage();
$pdf->Utilisateur(Utilisateur::rechercheParId($panier->getIdUtilisateur()));

//Pour chaque boutiques différentes on appelle la méthode pour afficher les produits.
//Et on ajoute le total de chaque boutique pour avoir la somme total à régler
//On aurait très bien pu utiliser le champs total du panier mais cela fait une revérification
//au cas où il n'y aurait pas eu d'update sur des produits
$sommeTotal = 0;
for ($i = 0; $i < $cpt; $i++) {
    $b = Boutique::rechercheParId($idBoutiques[$i]);
    $sommeTotal += $pdf->TableauProduit($header, $b, $produitsBoutique[$idBoutiques[$i]]);
    if ($i != $cpt-1) $pdf->AddPage();
}

$pdf->Output();
?>