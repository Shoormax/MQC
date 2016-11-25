<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 19/11/2016
 * Time: 20:24
 */
class Boutique extends CommunTable
{
    /**
     * @var int
     */
    private $id_boutique;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $code_postal;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var bool
     */
    private $active;

    /**
     * Boutique constructor.
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
     * Retourne le nom de la boutique
     *
     * @author Valentin Dérudet
     *
     * @return string
     */
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     *
     * PUBLIC METHODS
     *
     */

    /**
     * Retourne l'adresse complète de la boutique
     *
     * @author Valentin Dérudet
     * @param string $seprateur
     *
     * @return string
     */
    public function getAdresseComplete($seprateur = ' ')
    {
        return $this->adresse.$seprateur.$this->ville.' '.$this->code_postal;
    }

    /**
     * Permet de créer une boutique
     *
     * @author Valentin Dérudet
     *
     * @param $libelle
     * @param string $adresse
     * @param string $code_postal
     * @param string $ville
     *
     * @return bool|Boutique
     */
    public function add($libelle, $adresse = '', $code_postal = '', $ville = '')
    {
        global $pdo;

        if(!empty($libelle)) {
            $this->libelle = $libelle;
            $this->adresse = $adresse;
            $this->code_postal = $code_postal;
            $this->ville = $ville;
            $this->active = 1;

            $query = "INSERT INTO boutique (id_boutique, libelle, adresse, code_postal, ville, active) VALUES (DEFAULT, '".$libelle."', '".$adresse."', '".$code_postal."', '".$ville."', DEFAULT)";
        }
        else{
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet dde modifier une boutique.
     *
     * @author Valentin Dérudet
     *
     * @return Boutique
     */
    public function update()
    {
        global $pdo;
        
        $query = "UPDATE boutique SET libelle = '".$this->libelle."', adresse = '".$this->adresse."', code_postal = '".$this->code_postal."', ville = 'Lyon2' WHERE id_boutique = 1";
        $pdo->exec($query);
        return $this;
    }

    /**
     * Permet de supprimer une boutique.
     *
     * @author Valentin Dérudet
     *
     * @return Boutique
     */
    public function delete()
    {
        $this->setActive(0);
        return $this->update();
    }

    /**
     * Permet de retouner tous les utilisateurs de cette boutique.
     *
     * @author Valentin Dérudet
     *
     * @return array
     */
    public function getUtilisateurs()
    {
        global $pdo;

        $req = 'SELECT id_utilisateur FROM boutique_has_utilisateur WHERE id_boutique ='.$this->id_boutique;
        $query = $pdo->query($req);

        return $query->fetchAll();
    }

    /**
     * Retourne tous les produits cette boutique.
     *
     * @author Valentin Dérudet
     *
     * @return Produit[]
     */
    public function getProduits()
    {
        return Produit::rechercherParParam(array('id_boutique' => $this->id_boutique, 'active' => 1));
    }

    /**
     * Permet d'ajouter un utilisateur à cette boutique.
     *
     * @author Valentin Dérudet
     *
     * @param $id_utilisateur
     *
     * @return Boutique
     */
    public function addUtilisateur($id_utilisateur)
    {
        global $pdo;

        $query = "INSERT INTO boutique_has_utilisateur (id_boutique, id_utilisateur, active) VALUES (".$this->id_boutique.", ".$id_utilisateur.", 1)";
        $pdo->exec($query);

        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet de supprimer un utilisateur de cette boutique.
     *
     * @author Valentin Dérudet
     *
     * @param $id_utilisateur
     *
     * @return Boutique
     */
    public function supprimerUtilisateur($id_utilisateur)
    {
        global $pdo;

        $query = "UPDATE boutique_has_utilisateur SET active = 0 WHERE id_boutique = ".$this->id_boutique." AND id_utilisateur = ".$id_utilisateur;
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
        return $this->id_boutique;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param $libelle
     * @return Boutique
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Boutique
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param string $code_postal
     * @return Boutique
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return Boutique
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
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
     * @return Boutique
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }


}