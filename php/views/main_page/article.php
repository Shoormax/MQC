<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 15:56
 */
$familial = $_COOKIE["langue"] == 1 ? "Familial" : "Familly";
$sportif = $_COOKIE["langue"] == 1 ? "Sportif" : "Sportive";
$culturel = $_COOKIE["langue"] == 1 ? "Culturel" : "Educational";

$id = $a->getTitreArticle() == 'Accessibilité' ? 'access' : null;
$template = "<div id='".$a->getTitreNavbar()."' class='sous-container'>
        <div class='article' id='".$id."'>
            <div class='wrap-visuel'>
                <div class='wrap-titre-sous-container tcenter'>
                    <span class='titre-sous-container'>".$a->getTitreArticle()."</span>
                </div>";
 $template .= $a->getTitreArticle() == 'Accessibilité' || $a->getTitreArticle() == 'Accessibility' ?
            "<div id='buttonsMap'>
              <button type='button' id='btn_famille'>".$familial."</button>
              <button type='button' id='btn_sportif'>".$sportif."</button>
              <button type='button' id='btn_culturel'>".$culturel."</button>
            </div>
            <div id='carte'></div><img src='img/carte/famille.png' id='imageCartePrint'/>" :
            "<img class='imgArticle' src='".$a->getImage()."'>";
            $template .= "</div>
            <div class='wrap-textuel'>
                <div class='sous-wrap-text tcenter'>
                    <p>".$a->getTitreShortTexte()."</p>
                    <span>".nl2br($a->getShortTexte())."</span>
                </div>
            </div>
            <div class='clearfix'></div>
        </div>
    </div>";

echo $template;
