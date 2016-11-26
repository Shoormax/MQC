<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 16/11/2016
 * Time: 21:13
 */

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
    private $nom;

    /**
     * @var string
     */
    private $prenom;

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
     * @var
     */
    private $date_upd;

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
     * MAGIC METHODS
     *
     */

    /**
     * Retourne le nom et le prénom de l'utilisateur.
     * Utilisation :    (string)$utilisateur
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nom.' '.$this->prenom;
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
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $password
     * @return bool|Utilisateur
     */
    public function add($id_droit, $nom, $prenom, $email, $password)
    {
        global $pdo;
        if(!empty($id_droit) && !empty($email) && !empty($password)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $this->id_droit = $id_droit;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->password = $password;
            $this->date_add = $ajd->format("Y-m-d H:i:s");
            $this->active = 1;

            $query = 'INSERT INTO utilisateur (id_utilisateur, id_droit, nom, prenom, email, password, date_add, date_upd, active) VALUES (NULL, "'.$id_droit.'", "'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$password.'", "'.$ajd->format("Y-m-d H:i:s").'", NULL,"1")';
        }
        else{
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet de mettre à jour un utilisateur.
     * Utilisation :    $u = Utilisateur::rechercheParId($id);
     *                  $u->setParam($param);
     *                  $u->update();
     *
     * @author Valentin Dérudet
     *
     * @return Utilisateur
     */
    public function update()
    {
        global $pdo;

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->date_upd = $ajd->format("Y-m-d H:i:s");

        $query = 'UPDATE Utilisateur SET id_droit = "'.$this->id_droit.'", nom = "'.$this->nom.'", prenom = "'.$this->prenom.'", email = "'.$this->email.'",password = "'.$this->password.'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'", active = "'.$this->active.'" WHERE id_utilisateur = '.$this->id_utilisateur;

        $pdo->exec($query);
        return $this;
    }

    /**
     * Permet de supprimer un utilisateur
     * Utilisation :    $u = Utilisateur::rechercheParId($id);
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
     * Récupère les paniers de cet utilisateur.
     *
     * @return Panier[]
     */
    public function getPaniersUtilisateur()
    {
        return Panier::rechercherParParam(array('id_utilisateur' => $this->id_utilisateur, 'validation' => 1));
    }

    /**
     * Permet de retourner le panier en cours de création.
     *
     * @author Valentin Dérudet
     *
     * @return bool|null|object|object[]
     */
    public function getPanierNonValide()
    {
        return Panier::rechercherParParam(array('id_utilisateur' => $this->id_utilisateur, 'validation' => 0), 1);
    }

    /**
     * @return array
     */
    public function getBoutique()
    {
        if(in_array($this->id_droit, array(1, 2))) {
            global $pdo;
            $req = 'SELECT id_boutique FROM boutique_has_utilisateur WHERE id_utilisateur ='.$this->id_utilisateur;
            $query = $pdo->query($req);
            return $query->fetchAll();
        }
        return null;
    }

    /**
     * Vérifie si l'utilisateur est administrateur
     *
     * @author Valentin Dérudet
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->id_droit == 1;
    }

    /**
     *
     * GETTERS / SETTERS
     *
     *
     */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_utilisateur;
    }

    /**
     * @return int
     */
    public function getIdDroit()
    {
        return $this->id_droit;
    }

    /**
     * @param int $id_droit
     * @return Utilisateur
     */
    public function setIdDroit($id_droit)
    {
        $this->id_droit = $id_droit;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     * @return Utilisateur
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
     * @return Utilisateur
     */
    public function setDateUpd($date_upd)
    {
        $this->date_upd = $date_upd;
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
     * @param bool $active
     * @return Utilisateur
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
}
