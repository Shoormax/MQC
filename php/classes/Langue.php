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

  /**
   * Ceci frère est une fonction statique sa mère, elle permet de tranquillement
   * te balancer des liens html contenant tous les drapeaux sauf celui que tu ne veux pas xdlol
   * Alors utilise ce pouvori avec précaution car un grand pour implique
   * de grandes responsabilités enculé
   * @param int $except
   * @return string
   */
    public static function afficherDrapeau($except = 1) {
      $langues = Langue::rechercheAll();

      $drapeauxHtml = '';
      if(is_array($langues)) {
        /** @var Langue $langue */
        foreach ($langues as $langue) {
          if($langue->getId() != $except) {
            $drapeauxHtml .= '<a href="updateCookie.php?language='.$langue->getId().'">';

            $urlImage = 'img/langue/'.$langue->getLibelle().'.png';
            $drapeauxHtml .= '<img src="'.$urlImage.'" alt="'.$langue->getLibelle().'">';

            $drapeauxHtml .= '</a>';
          }
        }
      }
      return $drapeauxHtml;
    }
}
