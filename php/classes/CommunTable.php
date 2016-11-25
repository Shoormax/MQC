<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 16/11/2016
 * Time: 00:33
 */

class CommunTable
{
    /**
     * Permet de rechercher un objet par id
     * Utilisation :    $obj = Class::rechercherParId($className, $id);
     *
     * @author Valentin Dérudet
     *
     * @param int $id       id de l'objet
     *
     * @return object
     */
    public static function rechercheParId($id)
    {
        global $pdo;
        $class = get_called_class();

        if(method_exists(get_called_class(), 'isActive')) {
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
     * @return object[]
     */
    public static function rechercheAll()
    {
        global $pdo;
        $class = get_called_class();

        if(method_exists(get_called_class(), 'isActive')) {
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
     * @param array $params Paramètres à rechercher
     * @param int $limit (optionnal) (default=null)  Permet de spécifier le nombre de résultats que l'on veut récupérer
     *
     * @return object|object[]|bool|null
     */
    public static function rechercherParParam($params, $limit = null)
    {
        global $pdo;
        $class = get_called_class();

        if(!is_array($params)) {
            echo 'Erreur lors de la recherche des '.strtolower($class).'s.';
            return false;
        }

        if(method_exists(get_called_class(), 'isActive')) {
            $requete = 'SELECT * from '.$class.' where active = 1';
        }
        else {
            $requete = 'SELECT * from '.$class.' where 1';
        }

        foreach ($params as $key => $param)
        {
            $requete .= ' AND '.$key.'="'.$param.'"';
        }

        if($limit !== null) {
            $requete .= ' LIMIT '.$limit;
            if($limit == 1) {
                $query = $pdo->prepare($requete);
                $query->execute();
                if(!is_bool($query)) {
                    return $query->fetchObject($class);
                }
                return null;
            }
        }

        $query = $pdo->query($requete);
        $objs = array();

        while ($obj = $query->fetchObject($class)) {
            $objs[$obj->getId()] = $obj;
        }

        return $objs;
    }
}
