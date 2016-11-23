<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 20/11/2016
 * Time: 16:13
 */
$template = "<div id='".$a->getTitreNavbar()."' class='sous-container'><div class='article'>
        <div class='wrap-visuel'>
            <div class='wrap-titre-sous-container tcenter'>
                <textarea name='tireTexte".$a->getid()."'>".$a->getTitreArticle()."</textarea>
            </div>
            <label for='titreNavBar' style='color:black;font-size:0.5em'>Titre navbar</label>
            <input type='text' name='titreNavBar".$a->getid()."' value='".$a->getTitreNavbar()."'>";
$template.= $a->getTitreArticle() == 'Accessibilité' ? "" : "<img class='imgArticle' src='../".$a->getImage()."'>
            <input name='imageArticle".$a->getid()."' type='text' value='".$a->getImage()."'>
            <input type='hidden' name='MAX_FILE_SIZE' value='1048576' />
            <input type='file' style='color:black' name='fichierimgArticle".$a->getid()."'/><br />";
$template .= " </div>
        <div class='wrap-textuel'>
            <div class='sous-wrap-text tcenter'>
                <p><textarea name='titreShort".$a->getid()."'>".$a->getTitreShortTexte()."</textarea></p>
                <span><textarea name='articleShort".$a->getid()."' class='articleShortText'>".$a->getShortTexte()."</textarea></span>
            </div>
        </div>
        <div class='clearfix'></div>
        </div>
    </div>";

echo $template;