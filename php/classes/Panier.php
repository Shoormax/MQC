<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 19/11/2016
 * Time: 12:18
 */

class Panier extends CommunTable
{
    /**
     * @var int
     */
    private $id_panier;

    /**
     * @var int
     */
    private $id_utilisateur;

    /**
     * @var float
     */
    private $total;

    /**
     * @var DateTime
     */
    private $date_add;

    /**
     * @var DateTime
     */
    private $date_upd;

    /**
     * @var bool
     */
    private $validation;

    /**
     * Panier constructor.
     */
    public function __construct()
    {
    }

    /**
     * Permet à un utilisateur de créer un panier.
     * Utilisation :    $p->new Panier();
     *                  $p->add($id_utilisateur)
     *
     * @author Valentin Dérudet
     *
     * @param $id_utilisateur
     *
     * @return bool|Panier
     */
    public function add($id_utilisateur)
    {
        global $pdo;
        if(!empty($id_utilisateur)) {
            $ajd = new DateTime();
            $this->id_utilisateur = $id_utilisateur;
            $this->date_add = $ajd->format("Y-m-d H:i:s");
            $this->validation = 0;
            $this->total = 0;
            $query = 'INSERT INTO Panier (id_panier, id_utilisateur, total, date_add, date_upd, validation) 
                      VALUES (DEFAULT, "'.$id_utilisateur.'", DEFAULT,  "'.$ajd->format("Y-m-d H:i:s").'", DEFAULT, DEFAULT)';
        }
        else{
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet d'update le panier.
     *
     * @author Valentin Dérudet
     *
     * @return Panier
     */
    public function update()
    {
        global $pdo;
        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->date_upd = $ajd->format("Y-m-d H:i:s");
        $query = 'UPDATE Panier SET id_utilisateur = "'.$this->id_utilisateur.'", total = "'.$this->total.'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'", validation = "'.$this->validation.'" WHERE id_panier = '.$this->id_panier;

        $pdo->exec($query);
        return $this;
    }

    /**
     * Permet d'ajouter ou de modifier un produit dans le panier.
     * Utilisation :    $p = Panier::rechercheParId($id_panier);
     *                  $p->ajoutProduit($id_product, $quantite);
     *
     * @author Valentin Dérudet
     *
     * @param int $id_product
     *
     * @return Panier
     */
    public function ajoutProduit($id_product, $quantite)
    {
        global $pdo;
        $produit = Produit::rechercheParId($id_product);

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));

        $query = 'INSERT INTO panier_has_produit (id_panier, id_produit, quantite, date_add, date_upd) VALUES ('.$this->id_panier.', '.$id_product.', '.$quantite.', "'.$ajd->format('Y-m-d H:i:s').'", DEFAULT)';
        foreach ($this->getProduits() as $q) {
            if(in_array($id_product, $q))
            {
                $query = 'UPDATE panier_has_produit SET date_upd = "'.$ajd->format('Y-m-d H:i:s').'",quantite = panier_has_produit.quantite+'.$quantite.' WHERE id_panier = '.$this->id_panier.' AND id_produit ='.$id_product;
            }
        }

        $pdo->exec($query);
        $produit->sortieStock($quantite, $this->id_panier);
        $this->setTotal($this->total + $produit->getPrix()*$quantite);
        $panier = $this->update();
        return $panier;
    }

    /**
     * Permet de retirer en partiellement ou complètement un produit de ce panier
     * Utilisation :    $p = Panier::rechercherParId($id_panier);
     *                  $p->suppressionProduit($id_product, $quantite);
     *
     * @author Valentin Dérudet
     *
     * @param $id_product
     * @param null $quantite
     *
     * @return bool|Panier
     */
    public function suppressionProduit($id_product, $quantite = null)
    {
        global $pdo;
        $produit = Produit::rechercheParId($id_product);
        $quantity = $quantite;
        if($this->getTotal() > 0) {
            if($quantity > 0)
            {
                $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
                $query = 'UPDATE panier_has_produit SET date_upd = "'.$ajd->format('Y-m-d H:i:s').'", quantite = panier_has_produit.quantite-'.$quantity.' WHERE id_produit = '.$id_product.' AND id_panier= '.$this->id_panier;
            }
            else{
                $query = 'DELETE FROM panier_has_produit WHERE id_produit = '.$id_product.' AND id_panier= '.$this->id_panier;
                $quantity = $this->getQuantiteProduit($id_product);
            }
            $pdo->exec($query);
            $produit->entreeStock($quantity, $this->id_panier);
            $this->setTotal($this->total - $produit->getPrix()*$quantity);
            $panier = $this->update();
            return $panier;
        }
        return false;
    }

    /**
     * Récupère tous les id_produit de ce panier.
     *
     * @author Valenttin Dérudet
     *
     * @return array
     */
    public function getProduits()
    {
        global $pdo;
        $req = 'SELECT id_produit FROM panier_has_produit WHERE id_panier ='.$this->id_panier;
        $query = $pdo->query($req);
        return $query->fetchAll();
    }

    /**
     * Permet de récupérer la quantite d'un produit dans ce panier
     *
     * @author Valenttin Dérudet
     *
     * @param $id_product
     * @return int
     */
    public function getQuantiteProduit($id_product)
    {
        global $pdo;
        $req = 'SELECT quantite FROM panier_has_produit WHERE id_panier ='.$this->id_panier.' AND id_produit ='.$id_product;
        $query = $pdo->query($req);
        return $query->fetch()[0];
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
        return $this->id_panier;
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
     * @return Panier
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param mixed $date_add
     * @return Panier
     */
    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpd()
    {
        return $this->date_upd;
    }

    /**
     * @param mixed $date_upd
     * @return Panier
     */
    public function setDateUpd($date_upd)
    {
        $this->date_upd = $date_upd;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return round($this->total, 2);
    }

    /**
     * @param float $total
     * @return Panier
     */
    public function setTotal($total)
    {
        $this->total = round($total,2);
        return $this;
    }

    /**
     * @return bool
     */
    public function isValidation()
    {
        return $this->validation;
    }

    /**
     * @param bool $validation
     * @return Panier
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
        return $this;
    }
}