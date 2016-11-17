<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */

$a = Article::rechercherParParam('Article', array('titre_article' => "Les commerces"), 1);
var_dump($a);