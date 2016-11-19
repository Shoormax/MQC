<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 19/11/2016
 * Time: 18:39
 */
abstract class Configuration
{
    final public static function chargementClasses() {
        spl_autoload_register(array(__CLASS__, 'autoload'), false);
    }

    final private static function autoload($className) {
        $className = str_replace('\\', '/', $className);
        if (!class_exists($className, false) && file_exists(__ADDRESS_CLASSES__.$className.'.php')) {
            include __ADDRESS_CLASSES__.$className.'.php';
            return true;
        }
        return false;
    }
}