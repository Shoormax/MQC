<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 21/09/2016
 * Time: 09:16
 */

if(file_exists("C:/Users/Valentin")){
    define("__LOCAL_PATH__", "http://localhost/MQC");
} else if(file_exists("C:/Users/quentin")){
    define("__LOCAL_PATH__", "http://localhost:8001/ProjectOne");
} elseif( file_exists("C:/Users/AifeDesPaix") ) {
    define("__LOCAL_PATH__", "http://localhost/connardedeconfluence/MQC");
} else {
    define("__LOCAL_PATH__", "http://monquartierconfluence.labo-g4.fr/MonQuartierConfluence");
}
define("__INCLUDE_PATH__", __LOCAL_PATH__."/php/include/");
define("__CSS_PATH__",  __LOCAL_PATH__."/css/");
define("__JS_PATH__",  __LOCAL_PATH__."/js/");
define("__IMG_PATH__",  __LOCAL_PATH__."/img/");
