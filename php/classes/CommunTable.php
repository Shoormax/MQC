<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 16/11/2016
 * Time: 00:33
 */
include_once 'php/include/init.php';

class CommunTable
{
    /**
     * Permet de rechercher un objet par id
     * Utilisation :    $obj = Class::rechercherParId($className, $id);
     *
     * @author Valentin Dérudet
     *
     * @param string $class classe de l'objet
     * @param int $id       id de l'objet
     *
     * @return object
     */
    public static function rechercheParId($class, $id)
    {
        global $pdo;
        if(method_exists($class, 'isActive')) {
            $query = $pdo->prepare('SELECT * from '.$class.' where id_'.strtolower($class).' ='.$id.' AND active = 1');
        }
        else {
            $query = $pdo->prepare('SELECT * from '.$class.' where id_'.strtolower($class).' ='.$id);
        }
        $query->execute();

        return $query->fetchObject($class);
    }

    /**
     * Permet de retourner tous les objets d'une classe
     * Utilisation :    $objs = Class::rechercherAll($className);
     *
     * @author Valentin Dérudet
     *
     * @param string $class classe de l'objet
     *
     * @return object[]
     */
    public static function rechercheAll($class)
    {
        global $pdo;

        if(method_exists($class, 'isActive')) {
            $query = $pdo->query('SELECT * from '.$class.' where active = 1');
        }
        else {
            $query = $pdo->query('SELECT * from '.$class);
        }

        $objs = array();

        while ($obj = $query->fetchObject($class)) {
            $objs[$obj->getId()] = $obj;
        }
        return $objs;
    }

    /**
     * Permet de rechercher un objet par n'importe quel parametre donné
     * Utilisation :    $params = array('column1' => 'doe', 'column2' => 'john');
     *                  $objs = Class::rechercherParParam($className, $params);
     *
     * @author Valentin Dérudet
     *
     * @param string $class classe de l'objet
     * @param array $params paramètres à rechercher
     *
     * @return object|object[]|bool
     */
    public static function rechercherParParam($class, $params, $limit = null)
    {
        global $pdo;

        if(!is_array($params)) {
            echo 'Erreur lors de la recherche des '.strtolower($class).'s.';
            return false;
        }

        if(method_exists($class, 'isActive')) {
            $requete = 'SELECT * from '.$class.' where active = 1';
        }
        else {
            $requete = 'SELECT * from '.$class.' where 1';
        }

        //$param = nomColonne
        //$key = valeur
        foreach ($params as $param => $key)
        {
            $requete .= ' AND '.$param.'="'.$key.'"';
        }

        if($limit !== null) {
            $requete .= ' LIMIT '.$limit;
            $query = $pdo->query($requete);
            $query->execute();
            return $query->fetchObject($class);
        }

        $query = $pdo->query($requete);
        $objs = array();

        while ($obj = $query->fetchObject($class)) {
            $objs[$obj->getId()] = $obj;
        }

        return $objs;
    }
}