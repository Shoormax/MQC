<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 16/11/2016
 * Time: 01:28
 */

class StockMouvement  extends CommunTable
{
    /**
     * @var int
     */
    private $id_stock_mouvement;

    /**
     * @var int
     */
    private $quantite;

    /**
     * @var DateTime
     */
    private $date_add;

    /**
     * @var int
     */
    private $id_type_mouvement;

    /**
     * @var int
     */
    private $id_produit;

    /**
     * @var int
     */
    private $id_panier;

    /**
     * StockMouvement constructor.
     */
    public function __construct()
    {
    }

    /**
     * Permet d'ajouter un stock mouvement
     * Utilisation :    $sm = new StockMouvement();
     *                  $sm->add($quantite, $id_type_mouvement, $id_produit);
     *
     * @author Valentin Dérudet
     *
     * @param $quantite
     * @param $id_type_mouvement
     * @param $id_produit
     * @return bool|object
     */
    public function add($quantite, $id_type_mouvement, $id_produit, $id_panier)
    {
        global $pdo;

        if(!empty($quantite) && !empty($id_type_mouvement) && !empty($id_produit) && !empty($id_panier)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));

            $query = 'INSERT INTO Stock_Mouvement (id_stock_mouvement, quantite, date_add, id_type_mouvement, id_produit, id_panier) 
                      VALUES (DEFAULT, "'.$quantite.'", "'.$ajd->format('Y-m-d H:i:s').'", "'.$id_type_mouvement.'", "'.$id_produit.'",  "'.$id_panier.'")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
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
        return $this->id_stock_mouvement;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     * @return StockMouvement
     */
    public function setQuantite(int $quantite)
    {
        $this->quantite = $quantite;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param DateTime $date_add
     * @return StockMouvement
     */
    public function setDateAdd(DateTime $date_add)
    {
        $this->date_add = $date_add;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdTypeMouvement()
    {
        return $this->id_type_mouvement;
    }

    /**
     * @param int $id_type_mouvement
     * @return StockMouvement
     */
    public function setIdTypeMouvement(int $id_type_mouvement)
    {
        $this->id_type_mouvement = $id_type_mouvement;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdProduit()
    {
        return $this->id_produit;
    }

    /**
     * @param int $id_produit
     * @return StockMouvement
     */
    public function setIdProduit(int $id_produit)
    {
        $this->id_produit = $id_produit;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPanier()
    {
        return $this->id_panier;
    }

    /**
     * @param int $id_panier
     * @return StockMouvement
     */
    public function setIdPanier($id_panier)
    {
        $this->id_panier = $id_panier;
        return $this;
    }
}