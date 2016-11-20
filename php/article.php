<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:56
 */
echo '<div id="'.$a->getTitreNavbar().'" class="sous-container">';
echo "<div class='article' id=''>
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
        </div>
    </div>";