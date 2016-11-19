<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:23
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';
require_once 'php/classes/StockMouvement.php';

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
     * @var string
     */
    private $libelle_anglais;

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
     *
     * @author Valentin Dérudet
     */
    public function __construct()
    {

    }

    /**
     *
     * PUBLIC METHODS
     *
     */

    /**
     * Permet d'ajouter un produit.
     * Utilisation :    $p = new Product();
     *                  $p->add($id_utilisateur, $libelle, $prix, $stock);
     *
     * @author Valentin Dérudet
     *
     * @param $id_utilisateur
     * @param $libelle
     * @param $libelle_anglais (optionnal) (default=null)
     * @param $prix
     * @param $stock
     * @return bool|Produit
     */
    public function add($id_utilisateur, $libelle, $prix, $stock, $libelle_anglais = null)
    {
        global $pdo;
        if(!empty($libelle) && !empty($prix) && !empty($id_utilisateur) && !empty($stock)) {
            $query = 'INSERT INTO Produit (id_produit, libelle, libelle_anglais, prix, id_utilisateur, active, stock) 
                      VALUES (DEFAULT, "'.$libelle.'", "'.$libelle_anglais.'", "'.$prix.'", "'.$id_utilisateur.'", "1", "'.$stock.'")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet d'update un produit.
     * Utilisation :    $p = Produit::rechercheParId($id);
     *                  $p->setParam($param)
     *                  $p->update();
     *
     * @author Valentin Dérudet
     *
     * @return Produit
     */
    public function update()
    {
        global $pdo;

        $query = 'UPDATE Produit SET libelle = "'.$this->libelle.'", libelle_anglais = "'.$this->libelle_anglais.'", prix = "'.$this->prix.'", id_utilisateur = "'.$this->id_utilisateur.'", active = "'.$this->active.'", stock = "'.$this->stock.'" WHERE id_produit ='.$this->id_produit;

        $pdo->exec($query);
        return $this::rechercheParId($this->id_produit);
    }

    /**
     * Permet de supprimer un produit
     * Utilisation :    $p = Produit::rechercheParId($id);
     *                  $p->delete();
     *
     * @author Valentin Dérudet
     *
     * @return Produit
     */
    public function delete()
    {
        $this->setActive(0);
        return $this->update();
    }

    /**
     * Permet d'entree du stock pour un produit.
     * Utilisation :    $p = Produit::rechercheParId($id)
     *                  $p->entreeStock($quantite);
     *                  $p->update();
     *
     * @author Valentin Dérudet
     *
     * @param int $quantite
     *
     * @return Produit
     */
    public function entreeStock($quantite, $id_panier)
    {
        $message = 'Erreur lors de l\'entree stock, veillez à ce que la quantité entrée soit positive.';
        if($quantite > 0) {
            $message = 'Entrée stock effecutée avec succès.';
            $this->stock += $quantite;
            $t = new StockMouvement();
            $t->add($quantite, 1, $this->getId(), $id_panier);
        }
        echo $message;
        return $this->update();
    }

    /**
     * Permet de sortir de stock pour un produit.
     * Utilisation :    $p = Produit::rechercheParId($id)
     *                  $p->sortieStock($quantite);
     *                  $p->update();
     *
     * @author Valentin Dérudet
     *
     * @param int $quantite
     *
     * @return Produit
     */
    public function sortieStock($quantite, $id_panier)
    {
        $message = 'Erreur lors de la sortie de stock, la quantité maximale que vous pouvez sortir est '.$this->stock.'.';
        if($quantite <= $this->stock && $this->stock !== 0) {
            $message = 'Sortie stock effecutée avec succès.';
            $this->stock -= $quantite;
            $t = new StockMouvement();
            $t->add($quantite, 2, $this->getId(), $id_panier);
        }
        echo $message;
        return $this->update();
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
     * @return Produit
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
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
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return string
     */
    public function getLibelleAnglais()
    {
        return $this->libelle_anglais;
    }

    /**
     * @param string $libelle_anglais
     * @return Produit
     */
    public function setLibelleAnglais($libelle_anglais)
    {
        $this->libelle_anglais = $libelle_anglais;
        return $this;
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
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
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
     * @return Produit
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
        return $this;
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
     * @return Produit
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
        return $this;
    }
}