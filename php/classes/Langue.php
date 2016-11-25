<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 19/11/2016
 * Time: 10:41
 */

class Langue extends CommunTable
{
    /**
     * @var int
     */
    private $id_langue;

    /**
     * @var string
     */
    private $libelle;

    /**
     * Langue constructor.
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
     * Permet d'ajouter une langue.
     * Utilisation :    $l = new Langue();
     *                  $l->add($libelle);
     *
     * @author Valentin Dérudet
     *
     * @param string $libelle
     * @return bool|Langue
     */
    public function add($libelle)
    {
        global $pdo;
        if(!empty($libelle)) {
            $this->libelle = $libelle;
            $query = 'INSERT INTO langue (id_langue, libelle) VALUES (NULL, "'.$libelle.'")';
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
        return $this->id_langue;
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
     * @return Langue
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }
}