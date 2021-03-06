<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 17/11/2016
 * Time: 00:39
 */

class Article extends CommunTable
{
    /**
     * @var int
     */
    private $id_article;

    /**
     * @var string
     */
    private $titre_article;

    /**
     * @var string
     */
    private $titre_short_texte;

    /**
     * @var string
     */
    private $short_texte;

    /**
     * @var string
     */
    private $texte;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var int
     */
    private $id_langue;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $titre_navbar;

    /**
     * @var string
     */
    private $image_navbar;

    /**
     * @var date
     */
    private $date_upd;

    /**
     * @var date
     */
    private $date_add;

    /**
     * Article constructor.
     */
    public function __construct()
    {
    }

    /**
     * Permet d'ajouter un article
     * Utilisation :    $a = new Article()
     *                  $a->add($titre_article, $titre_short_texte, $short_texte, $texte);
     *
     * @author Valentin Dérudet
     *
     * @param $titre_article
     * @param $titre_short_texte
     * @param $short_texte
     * @param $texte
     *
     * @return bool|Article
     */
    public function add($titre_article, $titre_short_texte, $short_texte, $texte, $id_langue, $image, $titre_navbar, $image_navbar)
    {
        global $pdo;
        if(!empty($titre_article) && !empty($titre_short_texte)  && !empty($short_texte) && !empty($texte) && !empty($titre_navbar) && !empty($image_navbar)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $this->titre_article = $titre_article;
            $this->titre_short_texte = $titre_short_texte;
            $this->short_texte = $short_texte;
            $this->texte = $texte;
            $this->id_langue = $id_langue;
            $this->image = $image;
            $this->titre_navbar = $titre_navbar;
            $this->image_navbar = $image_navbar;
            $this->date_add = $ajd->format("Y-m-d H:i:s");
            $this->active = 1;

            $query = 'INSERT INTO article (id_article, titre_article, titre_short_texte, short_texte, texte, date_add, date_upd, active, id_langue, image, titre_navbar, image_navbar) 
                      VALUES (NULL, "'.$titre_article.'", "'.$titre_short_texte.'", "'.$short_texte.'", "'.$texte.'", "'.$ajd->format("Y-m-d H:i:s").'",
                      NULL, 1, "'.$id_langue.'", "'.$image.'", "'.$titre_navbar.'", "'.$image_navbar.'")';
        }
        else{
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId($pdo->lastInsertId());
    }

    /**
     * Permet d'ajouter un article
     * Utilisation :    $a = Article::rechercheParId($id)
     *                  $a->setParam($param);
     *                  $a->update();
     *
     * @author Valentin Dérudet
     *
     * @return Article
     */
    public function update()
    {
        global $pdo;

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->date_upd = $ajd->format("Y-m-d H:i:s");

        $query = 'UPDATE article SET titre_article = "'.$this->getTitreArticle().'", titre_short_texte = "'.$this->getTitreShortTexte().'",short_texte = "'.$this->getShortTexte().'",
                    texte = "'.$this->getTexte().'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'", active = "'.$this->active.'", id_langue = "'.$this->id_langue.'", 
                    image = "'.$this->image.'", titre_navbar = "'.$this->titre_navbar.'", image_navbar = "'.$this->image_navbar.'" WHERE id_article = '.$this->id_article;

        $pdo->exec($query);
        return $this;
    }

    /**
     * Permet de supprimer un article
     * Utilisation :    $u = Article::rechercheParId($id);
     *                  $u->delete();
     *
     * @author Valentin Dérudet
     *
     * @return Article
     */
    public function delete()
    {
        $this->setActive(0);
        return $this->update();
    }

    /**
     * Permet de vérifier si cet article est une rubrique "Accessibilité" et qui n'a donc pas d'image associée.
     *
     * @author Valentin Dérudet
     *
     * @return bool
     */
    public function isAccessibilite()
    {
        return in_array($this->id_article, array(5, 10));
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
        return $this->id_article;
    }

    /**
     * @return string
     */
    public function getTitreArticle()
    {
        return $this->titre_article;
    }

    /**
     * @param string $titre_article
     * @return Article
     */
    public function setTitreArticle($titre_article)
    {
        $this->titre_article = $titre_article;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitreShortTexte()
    {
        return $this->titre_short_texte;
    }

    /**
     * @param string $titre_short_texte
     * @return Article
     */
    public function setTitreShort($titre_short_texte)
    {
        $this->titre_short_texte = $titre_short_texte;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortTexte()
    {
        return $this->short_texte;
    }

    /**
     * @param string $short_texte
     * @return Article
     */
    public function setShortTexte($short_texte)
    {
        $this->short_texte = $short_texte;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexte()
    {
        return utf8_encode($this->texte);
    }

    /**
     * @param string $texte
     * @return Article
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * @param $active
     * @return Article
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return int
     */
    public function getIdLangue()
    {
        return $this->id_langue;
    }

    /**
     * @param int $id_langue
     * @return Article
     */
    public function setIdLangue($id_langue)
    {
        $this->id_langue = $id_langue;
        return $this;
    }

    /**
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;
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
     * @param string $image_navbar
     * @return Article
     */
    public function setImageNavbar($image_navbar)
    {
        $this->image_navbar = $image_navbar;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageNavbar()
    {
        return $this->image_navbar;
    }

    /**
     * @param string $titre_navbar
     * @return Article
     */
    public function setTitreNavbar($titre_navbar)
    {
        $this->titre_navbar = $titre_navbar;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitreNavbar()
    {
        return $this->titre_navbar;
    }

    /**
     * @return mixed
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param $date_add
     * @return Article
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
     * @param  $date_upd
     * @return Article
     */
    public function setDateUpd($date_upd)
    {
        $this->date_upd = $date_upd;
        return $this;
    }
}
