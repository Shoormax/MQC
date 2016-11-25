<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 21:23
 */

class Produit extends CommunTable
{
    /**
     * @var int
     */
    private $id_produit;

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
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $description_anglais;

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
     * MAGIC METHODS
     *
     */

    /**
     * Permet de retourner le libelle et la quantite ce produit.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->libelle.' ('.$this->stock.')';
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
     * @param $id_boutique
     * @param $libelle
     * @param $libelle_anglais (optionnal) (default=null)
     * @param $prix
     * @param $stock
     * @return bool|Produit
     */
    public function add($libelle, $prix, $stock = 0, $id_boutique, $libelle_anglais = null, $description = null, $description_anglais = null,  $image = null)
    {
        global $pdo;
        if(!empty($libelle) && !empty($prix) && !empty($stock) && !empty($id_boutique)) {
            $query = 'INSERT INTO Produit (id_produit, libelle, libelle_anglais, description, description_anglais, prix, active, stock, image, id_boutique) 
                      VALUES (DEFAULT, "'.$libelle.'", "'.$libelle_anglais.'",  "'.$description.'",  "'.$description_anglais.'",'.$prix.', "1", "'.$stock.'", "'.$image.'", "'.$id_boutique.'")';
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

        $query = 'UPDATE Produit SET libelle = "'.$this->libelle.'", libelle_anglais = "'.$this->libelle_anglais.'", 
                    prix = "'.$this->prix.'", active = "'.$this->active.'", stock = "'.$this->stock.'", image = "'.$this->image.'",
                    id_boutique = "'.$this->id_boutique.'", description = "'.$this->description.'", 
                    description_anglais = "'.$this->description_anglais.'" WHERE id_produit ='.$this->id_produit;

        $pdo->exec($query);
        return $this;
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
        if($quantite > 0) {
            $this->stock += $quantite;
            $t = new StockMouvement();
            $t->add($quantite, 1, $this->getId(), $id_panier);
        }
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
        if($quantite <= $this->stock && $this->stock !== 0) {
            $this->stock -= $quantite;
            $t = new StockMouvement();
            $t->add($quantite, 2, $this->getId(), $id_panier);
        }
        return $this->update();
    }

    /**
     * Permet de remplir le champ de recherche des produits.
     *
     * @author Valentin Dérudet
     *
     * @param $text
     *
     * @return Produit[]
     */
    public static function autocomplementationProduit($text)
    {
        global $pdo;
        $texte = '%'.$text.'%';
        $req = "SELECT * FROM produit WHERE libelle LIKE '".$texte."' AND active = 1";

        $query = $pdo->query($req);
        $objs = array();

        while ($obj = $query->fetchObject(__CLASS__)) {
            $objs[] = $obj->getId();
        }

        return $objs;
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
        return round($this->prix,2);
    }

    /**
     * @param float $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = round($prix, 2);
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

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdBoutique()
    {
        return $this->id_boutique;
    }

    /**
     * @param int $id_boutique
     * @return Produit
     */
    public function setIdBoutique($id_boutique)
    {
        $this->id_boutique = $id_boutique;
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
     */
    public function setIdProduit(int $id_produit)
    {
        $this->id_produit = $id_produit;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionAnglais()
    {
        return $this->description_anglais;
    }

    /**
     * @param string $description_anglais
     * @return Produit
     */
    public function setDescriptionAnglais($description_anglais)
    {
        $this->description_anglais = $description_anglais;
        return $this;
    }
}