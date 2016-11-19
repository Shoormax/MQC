<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 17/11/2016
 * Time: 00:39
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';

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
     * @author Valentin Dérudet
     *
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
     * @param $titre_article
     * @param $titre_short_texte
     * @param $short_texte
     * @param $texte
     * @return bool|Article
     */
    public function add($titre_article, $titre_short_texte, $short_texte, $texte, $id_langue)
    {
        global $pdo;
        if(!empty($titre_article) && !empty($titre_short_texte)  && !empty($short_texte) && !empty($texte)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $query = 'INSERT INTO article (id_article, titre_article, titre_short_texte, short_texte, texte, date_add, date_upd, active) VALUES (NULL, "'.$titre_article.'", "'.$titre_short_texte.'", "'.$short_texte.'", "'.$texte.'", "'.$ajd->format("Y-m-d H:i:s").'",NULL, 1)';
        }
        else{
            echo('Merci de remplir tous les champs.');
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
     * @return Article
     */
    public function update()
    {
        global $pdo;

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $query = 'UPDATE article SET titre_article = "'.$this->getTitreArticle().'", titre_short_texte = "'.$this->getTitreShortTexte().'",short_texte = "'.$this->getShortTexte().'", texte = "'.$this->getTexte().'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'", active = "'.$this->active.'" WHERE id_article = '.$this->id_article;

        $pdo->exec($query);
        return $this::rechercheParId($this->id_article);
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
        return utf8_encode($this->titre_article);
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
        return utf8_encode($this->titre_short_texte);
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
        return utf8_encode($this->short_texte);
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
}