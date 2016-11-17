<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 20/09/2016
 * Time: 17:25
 */
require_once 'classes/Article.php';

$a = Article::rechercherParParam('Article', array('titre_article' => 'Les commerces'), 1);

echo"
<div class='article' id='articleCommerci'>
    <div class='wrap-visuel'>
        <div class='wrap-titre-sous-container tcenter'>
            <span class='titre-sous-container'>".$a->getTitreArticle()."</span>
        </div>
        <img class='imgArticle' src='img/min/musee.jpg'>
    </div>
    <div class='wrap-textuel'>
        <div class='sous-wrap-text tcenter'>
            <p>".$a->getTitreShortTexte()."</p>
            <span>".$a->getShortTexte()."</span>
        </div>
    </div>
    <div class='clearfix'></div>
</div>";