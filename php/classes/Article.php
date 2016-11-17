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
     * @return bool|object
     */
    public function add($titre_article, $titre_short_texte, $short_texte, $texte)
    {
        global $pdo;
        if(!empty($titre_article) && !empty($titre_short_texte)  && !empty($short_texte) && !empty($texte)) {
            $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $query = "INSERT INTO article (id_article, titre_article, titre_short_texte, short_texte, texte, date_add, date_upd) VALUES (NULL, '".$titre_article."', '".$titre_short_texte."', '".$short_texte."', '".$texte."', '".$ajd->format("Y-m-d H:i:s")."',NULL)";
        }
        else{
            echo('Merci de remplir tous les champs.');
            return false;
        }

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $pdo->lastInsertId());
    }

    /**
     * Permet d'ajouter un article
     * Utilisation :    $a = Article::rechercheParId($id)
     *                  $a->setParam($param);
     *                  $a->update();
     *
     * @return object
     */
    public function update()
    {
        global $pdo;

        $ajd = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $query = 'UPDATE article SET titre_article = "'.$this->titre_article.'", titre_short_texte = "'.$this->titre_short_texte.'",short_texte = "'.$this->short_texte.'", texte = "'.$this->texte.'", date_upd = "'.$ajd->format("Y-m-d H:i:s").'" WHERE id_article = '.$this->id_article;

        $pdo->exec($query);
        return $this::rechercheParId(self::class, $this->id_article);
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
     */
    public function setTitreArticle($titre_article)
    {
        $this->titre_article = $titre_article;
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
     */
    public function setTitreShort($titre_short_texte)
    {
        $this->titre_short_texte = $titre_short_texte;
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
     */
    public function setShortTexte($short_texte)
    {
        $this->short_texte = $short_texte;
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
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    }
}