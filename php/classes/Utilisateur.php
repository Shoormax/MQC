<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 16/11/2016
 * Time: 21:13
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';

class Utilisateur
{
    private $id_utilisateur;
    private $id_droit;
    private $email;
    private $password;
    private $date_add;
    private $active;

    public function __construct()
    {
    }

    /**
     *
     * PUBLIC METHODS
     *
     */
    public function add($id_droit, $email, $password)
    {
        global $pdo;
        if(!empty($id_droit) && !empty($email) && !empty($password)) {
            $ajd = new DateTime();
            $query = 'INSERT INTO utilisateur (id_utilisateur, id_droit, email, password, date_add, active) VALUES (NULL, "'.$id_droit.'", "'.$email.'", "'.$password.'", "'.$ajd->format("Y-m-d H:i:s").'", "1")';
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

    }

    /**
     *
     * GETTERS / SETTERS
     *
     *
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdDroit()
    {
        return $this->id_droit;
    }

    /**
     * @param mixed $id_droit
     */
    public function setIdDroit($id_droit)
    {
        $this->id_droit = $id_droit;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     */
    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}