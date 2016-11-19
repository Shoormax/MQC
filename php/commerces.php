<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 20/09/2016
 * Time: 17:25
 */

$a = Article::rechercherParParam(array('titre_article' => "Les commerces"), 1);
if($a instanceof Article) {
    echo
        "<div class='article' id='articleCommerci'>
            <div class='wrap-visuel'>
                <div class='wrap-titre-sous-container tcenter'>
                    <span class='titre-sous-container'>".$a->getTitreArticle()."</span>
                </div>
                <img class='imgArticle' src='".$a->getImage()."'>
            </div>
            <div class='wrap-textuel'>
                <div class='sous-wrap-text tcenter'>
                    <p>".$a->getTitreShortTexte()."</p>
                    <span>".$a->getShortTexte()."</span>
                </div>
            </div>
            <div class='clearfix'></div>
        </div>";
}