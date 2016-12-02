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
        $this->Image('../../img/logo/Bleu.png',10,6,80);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        $this->Cell(120);
        // Titre
        $this->SetDrawColor(0);
        $this->Cell(70,10,'Facture de votre panier',1,0,'C');
        $this->Ln(10);
        //Date
        $this->SetFont('Arial','',12);
        //$this->Cell(190,8,'Date : ' . date("d/m/Y"),0,0,'R');
        $this->Cell(190,8,'Date : ' . $this->panier->getDateAdd(true) . '  ',0,0,'R');
        $this->Ln(8);
        //Nom société
        //$this->SetTextColor(0,158,215);
        //$this->SetFont('Arial','',16);
        //$this->Cell(70,10,'Mon Quartier Confluence',0,0,'L');
        $this->Ln(15);

        $this->Utilisateur(Utilisateur::rechercheParId($this->panier->getIdUtilisateur()));
    }

    // En-tête
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',12);
        $this->Cell(190, 12, utf8_decode('http://www.monquartierconfluence.labo-g4.fr/'), 0, 0, 'C', 0);
        // Numéro de page centré
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'R');
    }

    //Info utilisateur
    function Utilisateur($user) {
        $this->Rect(108,43,92,33);
        $this->SetFont('Arial','IU',15);
        $this->Cell(98);
        $this->SetTextColor(0,139,205);
        $this->Cell(10,12,'                               Informations Client ',0,1,'L');
        $this->SetTextColor(0);
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
        // Infos boutique
        $this->SetDrawColor(0);
        $this->Rect(10,83,90,32);
        $this->SetFont('Arial','IU',15);
        $this->SetTextColor(0,139,205);
        $this->Cell(10,12,' Informations Boutique                        ',0,1,'L');
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',14);
        $this->Cell(10,6,utf8_decode('   ' . $boutique->getLibelle()),0,1,'L');
        $this->SetFont('Arial','',12);
        $this->Cell(10,6,utf8_decode('    ' . $boutique->getAdresse()),0,1,'L');
        $this->Cell(10,6,utf8_decode('    ' . $boutique->getCodePostal() . ', ' . $boutique->getVille()),0,1,'L');
        $this->Ln(10);

        // Tableau de produit
        $this->SetFont('Arial','B', 15);
        $this->Cell(35, 10, '   Liste des produits :', 0, 1, 'L');
        // Couleurs, épaisseur du trait et police grasse pour l'en-tête du tableau
        $this->SetFillColor(0,139,205);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,40,100);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',14);
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
            $this->Cell($w[3],7,number_format($prix, 2, ',', ' '),'LR', 0,'C',$fill);
            $this->Cell($w[4],7,number_format($total, 2, ',', ' '),'LR', 0,'C',$fill);


            $this->Ln();
            $fill = !$fill;
        }
        // Dernière ligne Total
        $this->Cell(125,0,'','T');
        $this->SetFont('Arial','B', 13);
        $this->Cell(35, 9, utf8_decode('Total à régler'), 1, 0, 'C');
        $this->SetFont('Arial','B', 15);
        $this->Cell(30, 9, number_format($somme, 2, ',', ' ')  . chr(128), 1, 1, 'C');

        return $somme;
    }

    function aPayer($prix) {
        $this->Ln(20);
        $this->SetFont('Arial','', 17);
        $this->SetDrawColor(0);
        $this->SetFillColor(0,139,205);
        $this->SetTextColor(255);
        $this->Cell(190, 11, utf8_decode('Le montant total de votre facture s\'élève à ') .
            number_format($prix, 2, ',', ' ') . chr(128), 1, 0, 'C', 1);
        $this->Ln(15);
        $this->SetFont('Arial','I', 13);
        $this->SetTextColor(0);
        $this->Cell(190, 8, utf8_decode('Nous restons à votre disposition pour toutes informations complémentaires.'), 0, 0, 'C');
        $this->Ln(20);
        $this->SetFont('Arial','', 14);
        $this->Cell(190, 8, utf8_decode('Cordialement.'), 0, 0, 'L');
    }
}

//Récupération du panier à l'aide de l'url et de la méthode rechercheParId
$panier = Panier::rechercheParId($_GET['id']);

//Création du pdf et attribution du panier, + alias pour le nb total de page
$pdf = new PDF();
$pdf->AliasNbPages();
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

$pdf->aPayer($sommeTotal);

$pdf->Output();
?>