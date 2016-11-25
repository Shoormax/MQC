<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 19/11/2016
 * Time: 10:51
 */

class Droit extends CommunTable
{
    /**
     * @var int
     */
    private $id_droit;

    /**
     * @var string
     */
    private $libelle;

    /**
     * Droit constructor.
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
     * Permet d'ajouter un droit.
     * Utilisation :    $d = new Droit();
     *                  $d->add($libelle);
     *
     * @author Valentin Dérudet
     *
     * @param $libelle
     * @return Droit|bool
     */
    public function add($libelle)
    {
        global $pdo;
        if(!empty($libelle)) {
            $this->libelle = $libelle;
            $query = 'INSERT INTO Droit (id_langue, libelle) VALUES (NULL, "'.$libelle.'")';
        }
        else{
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
        return $this->id_droit;
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
     * @return Droit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }
}