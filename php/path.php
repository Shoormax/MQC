<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 21/09/2016
 * Time: 09:16
 */
if(file_exists("C:/Users/Valentin")){
    define("__LOCAL_PATH__", "http://localhost/ProjectOne");
} else if(file_exists("C:/Users/quentin")){
    define("__LOCAL_PATH__", "http://localhost:8001/ProjectOne");
} elseif( file_exists("C:/Users/AifeDesPaix") ) {
    define("__LOCAL_PATH__", "http://localhost/ProjectOne");
} elseif (file_exists("C:/Users/Ben")) {
    define("__LOCAL_PATH__", "http://localhost/MQC/MQC/");
}

define("__INCLUDE_PATH__", __LOCAL_PATH__."/php/include/");
define("__CSS_PATH__",  __LOCAL_PATH__."/css/");
define("__JS_PATH__",  __LOCAL_PATH__."/js/");
define("__IMG_PATH__",  __LOCAL_PATH__."/img/");
