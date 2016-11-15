<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:23
 */
include_once 'php/include/init.php';

class Produit
{
    /**
     * @var int
     */
    private $id_produit;
    /**
     * @var int
     */
    private $id_utilisateur;
    /**
     * @var string
     */
    private $libelle;
    /**
     * @var float
     */
    private $prix;
    /**
     * @var bool
     */
    private $active;

    /**
     * Produit constructor.
     */
    public function __construct()
    {

    }

    public function add($id_utilisateur, $libelle, $prix)
    {
        global $pdo;
        if(!empty($libelle) && !empty($prix) && !empty($id_utilisateur)) {
            $requete = 'INSERT INTO Produit (id_produit, libelle, prix, id_utilisateur, active) VALUES (DEFAULT, "'.$libelle.'", "'.$prix.'", "'.$id_utilisateur.'", "1")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($requete);
        return $this::rechercheProduitParId($pdo->lastInsertId());
    }

    /**
     * MARCHE SANS PARAM DANS LE CONSTRUCT MDEIR
     */
    public static function rechercheProduitParId($id_produit)
    {
        global $pdo;
        $query = $pdo->prepare('SELECT * from Produit where id_produit ='.$id_produit);
        $query->execute();
        return $query->fetchObject(__CLASS__);
    }

    public static function rechercheAllProduit()
    {
        global $pdo;
        $query=$pdo->query('SELECT * from Produit where active = 1');

        $produits = array();
        while ($produit = $query->fetchObject(__CLASS__)) {
            $produits[$produit->getId()] = $produit;
        }
        return $produits;
    }

    /**
     *
     * GETTERS / SETTERS
     *
     */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_produit;
    }


    /**
     * @return int
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param int $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}