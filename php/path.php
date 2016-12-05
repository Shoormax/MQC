<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 21/09/2016
 * Time: 09:16
 */

if(file_exists("C:/Users/Valentin")){
  define("__LOCAL_PATH__", "http://localhost/MQC");
  define('__DB_HOST__', 'localhost');
  define('__DB_NAME__', 'mqc');
  define('__USER__', 'root');
  define('__PASSWORD__', '');
}
elseif(file_exists("C:/Users/quentin")){
  define("__LOCAL_PATH__", "http://localhost:8001/ProjectOne");
    define('__DB_HOST__', 'localhost');
    define('__DB_NAME__', 'mqc');
    define('__USER__', 'root');
    define('__PASSWORD__', 'root');
}
elseif( file_exists("C:/Users/AifeDesPaix") ) {
  define("__LOCAL_PATH__", "http://localhost/MQC");
  define('__DB_HOST__', 'localhost');
  define('__DB_NAME__', 'mqc');
  define('__USER__', 'root');
  define('__PASSWORD__', '');
}
elseif(file_exists("C:/Users/Shosho")) {
  define("__LOCAL_PATH__", "http://localhost/MySites/MQC");
  define('__DB_HOST__', 'localhost');
  define('__DB_NAME__', 'mqc');
  define('__USER__', 'root');
  define('__PASSWORD__', '');
}
elseif( file_exists("C:/Users/Ben") ) {
    define("__LOCAL_PATH__", "http://localhost/MQC");
    define('__DB_HOST__', 'localhost');
    define('__DB_NAME__', 'mqc');
    define('__USER__', 'root');
    define('__PASSWORD__', '');
}
else {
  define("__LOCAL_PATH__", "http://monquartierconfluence.labo-g4.fr/MonQuartierConfluence");
}

define("__INCLUDE_PATH__", __LOCAL_PATH__."/php/include/");
define("__CSS_PATH__",  __LOCAL_PATH__."/css/");
define("__JS_PATH__",  __LOCAL_PATH__."/js/");
define("__IMG_PATH__",  __LOCAL_PATH__."/img/");
define("__ADDRESS_CLASSES__",  "php/classes/", true);
define("__VIEW_PATH__",  __LOCAL_PATH__."/php/views/");
