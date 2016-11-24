<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 23/11/2016
 * Time: 21:28
 */
final class Auth
{
    /**
     * @var Utilisateur
     */
    private static $user;

    /**
     * Permet d'assigner un utilisateur.
     * Utilisation :    Auth::setUser($user);
     *
     * @author Valentin Dérudet
     *
     * @param Utilisateur $user
     */
    final public static function  setUser($user)
    {
        self::$user = $user instanceof Utilisateur ? $user : null;
    }

    /**
     * Permet de récupérer l'utilisateur connecté.
     * Utilisation :    Auth::user()->getId();
     *
     * @author Valentin Dérudet
     *
     * @return Utilisateur
     */
    final public static function  user()
    {
        return self::$user instanceof Utilisateur ? self::$user : null;
    }
}