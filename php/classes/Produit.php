<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:23
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';
require_once 'php/classes/Stock_Mouvement.php';

class Produit extends CommunTable
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
     * @var int
     */
    private $stock;

    /**
     * Produit constructor.
     */
    public function __construct()
    {

    }

    public function add($id_utilisateur, $libelle, $prix, $stock)
    {
        global $pdo;
        if(!empty($libelle) && !empty($prix) && !empty($id_utilisateur) && !empty($stock)) {
            $query = 'INSERT INTO Produit (id_produit, libelle, prix, id_utilisateur, active, stock) 
                      VALUES (DEFAULT, "'.$libelle.'", "'.$prix.'", "'.$id_utilisateur.'", "1", "'.$stock.'")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $pdo->lastInsertId());
    }

    public function update()
    {
        global $pdo;

        $query = 'UPDATE Produit SET libelle = "'.$this->libelle.'", prix = "'.$this->prix.'", id_utilisateur = "'.$this->id_utilisateur.'", active = "'.$this->active.'", stock = "'.$this->stock.'" WHERE id_produit ='.$this->id_produit;

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $pdo->lastInsertId());
    }

    public function entreeStock($quantite)
    {
        $message = 'Erreur lors de l\'entree stock, veillez à ce que la quantité entrée soit positive.';
        if($quantite > 0) {
            $message = 'Entrée stock effecutée avec succès.';
            $this->stock += $quantite;
            $t = new Stock_Mouvement();
            $t->add($quantite, 1, $this->getId());
        }
        echo $message;
    }

    public function sortieStock($quantite)
    {
        $message = 'Erreur lors de la sortie de stock, la quantité maximale que vous pouvez sortir est '.$this->stock;
        if($quantite < $this->stock) {
            $message = 'Sortie stock effecutée avec succès.';
            $this->stock -= $quantite;
            $t = new Stock_Mouvement();
            $t->add($quantite, 2, $this->getId());
        }
        echo $message;
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

    /**
     * @param boolean $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }
}