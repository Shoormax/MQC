<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 16/11/2016
 * Time: 01:28
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';

class Stock_Mouvement  extends CommunTable
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
     * Stock_Mouvement constructor.
     */
    public function __construct()
    {

    }

    /**
     * Permet d'ajouter un stock mouvement
     * Utilisation :    $sm = new Stock_Mouvement();
     *                  $sm->add($quantite, $id_type_mouvement, $id_produit);
     *
     * @author Valentin Dérudet
     *
     * @param $quantite
     * @param $id_type_mouvement
     * @param $id_produit
     * @return bool|object
     */
    public function add($quantite, $id_type_mouvement, $id_produit)
    {
        global $pdo;

        $ajd = new DateTime();
        $now = $ajd->format('Y-m-d H:i:s');

        if(!empty($quantite) && !empty($id_type_mouvement) && !empty($id_produit)) {
            $query = 'INSERT INTO Stock_Mouvement (id_stock_mouvement, quantite, date_add, id_type_mouvement, id_produit) 
                      VALUES (DEFAULT, "'.$quantite.'", "'.$now.'", "'.$id_type_mouvement.'", "'.$id_produit.'")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $pdo->lastInsertId());
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
     */
    public function setQuantite(int $quantite)
    {
        $this->quantite = $quantite;
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
     */
    public function setDateAdd(DateTime $date_add)
    {
        $this->date_add = $date_add;
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
     */
    public function setIdTypeMouvement(int $id_type_mouvement)
    {
        $this->id_type_mouvement = $id_type_mouvement;
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
     */
    public function setIdProduit(int $id_produit)
    {
        $this->id_produit = $id_produit;
    }


}