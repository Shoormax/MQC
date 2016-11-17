<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 16/11/2016
 * Time: 21:13
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';

class Utilisateur extends CommunTable
{
    /**
     * @var int
     */
    private $id_utilisateur;

    /**
     * @var int
     */
    private $id_droit;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var DateTime
     */
    private $date_add;

    /**
     * @var bool
     */
    private $active;

    /**
     * @author Valentin Dérudet
     *
     * Utilisateur constructor.
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
     * Permet d'ajouter un utilisateur.
     * Utilisation :    $u = new Utilisateur();
     *                  $u->add($id_droit, $email, $password);
     *
     * @author Valentin Dérudet
     *
     * @param $id_droit
     * @param $email
     * @param $password
     * @return bool|self
     */
    public function add($id_droit, $email, $password)
    {
        global $pdo;
        if(!empty($id_droit) && !empty($email) && !empty($password)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $query = 'INSERT INTO utilisateur (id_utilisateur, id_droit, email, password, date_add, date_upd, active) VALUES (NULL, "'.$id_droit.'", "'.$email.'", "'.$password.'", "'.$ajd->format("Y-m-d H:i:s").'", NULL,"1")';
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $pdo->lastInsertId());
    }

    /**
     * Permet de mettre à jour un utilisateur.
     * Utilisation :    $u = Utilisateur::rechercheParId($classname, $id);
     *                  $u->setParam($param);
     *                  $u->update();
     *
     * @author Valentin Dérudet
     *
     * @return self
     */
    public function update()
    {
        global $pdo;

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $query = 'UPDATE Utilisateur SET id_droit = "'.$this->id_droit.'", email = "'.$this->email.'",password = "'.$this->password.'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'", active = "'.$this->active.'" WHERE id_utilisateur = '.$this->id_utilisateur;

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $this->id_utilisateur);
    }

    /**
     * Permet de supprimer un utilisateur
     * Utilisation :    $u = Utilisateur::rechercheParId($classname, $id);
     *                  $u->delete();
     *
     * @author Valentin Dérudet
     *
     * @return Utilisateur
     */
    public function delete()
    {
        $this->setActive(0);
        return $this->update();
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