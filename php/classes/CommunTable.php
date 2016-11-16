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
    public static function rechercheParId($class, $id)
    {
        global $pdo;
        $query = $pdo->prepare('SELECT * from '.$class.' where id_'.strtolower($class).' ='.$id);
        $query->execute();
        return $query->fetchObject($class);
    }

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
}