<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:56
 */
$template = "<div id='".$a->getTitreNavbar()."' class='sous-container'>
        <div class='article' id=''>
            <div class='wrap-visuel'>
                <div class='wrap-titre-sous-container tcenter'>
                    <span class='titre-sous-container'>".$a->getTitreArticle()."</span>
                </div>";
 $template .= $a->getTitreArticle() == 'Accessibilité' ?
            "
            <div id='buttonsMap'>
              <button type='button' id='btn_famille'>Familial</button>
              <button type='button' id='btn_sportif'>Sportif</button>
              <button type='button' id='btn_culturel'>Culturel</button>
            </div>
            <div id='carte'></div>" :
            "<img class='imgArticle' src='".$a->getImage()."'>";
            $template .= "</div>
            <div class='wrap-textuel'>
                <div class='sous-wrap-text tcenter'>
                    <p>".$a->getTitreShortTexte()."</p>
                    <span>".$a->getShortTexte()."</span>
                </div>
            </div>
            <div class='clearfix'></div>
        </div>
    </div>";

echo $template;
