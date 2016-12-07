/**
 * Created by quentin on 26/09/2016.
 */

/**
 * Toggle la div de contenus par l'id placer en parametre.
 * Structure : id = transport ; id de la balise img = transportImg ; id de l'article collapse = transportCollapse
 *             id du paragraphe explicatif = transportPara
 *
 * @author Quentin Benyahia
 * @param id
 */
function deploiement(id){
    var el  = document.getElementById(id),
        list = document.getElementsByClassName('article');
    if(el.getAttribute('data-toggle') === true) {
        var elPara = document.getElementById(id+'Para');
        elPara.style.textAlign = "left" ;
        elPara.style.width = "50%" ;
        elPara.style.color = "black" ;
        var elImg = document.getElementById(id+'Img');
        elImg.style.width = '50%' ;
        var elCollapse = document.getElementById(id+'Collapse');
        elCollapse.style.maxHeight = '0px' ;
        el.setAttribute('data-toggle', 'false');
        setTimeout(function(){elPara.style.position = "relative" ; }, 500);
    }
    else{
        for (var i = 0; i < list.length; i++) {
            var elementListe = list[i],
                idElementListe = elementListe.getAttribute('id');
            if (elementListe.getAttribute('data-toggle') === 'true'){
                var elementListePara = document.getElementById(idElementListe+'Para');
                elementListePara.style.textAlign = "left" ;
                elementListePara.style.width = "50%" ;
                elementListePara.style.color = "black" ;
                var elementListeImg = document.getElementById(idElementListe+'Img');
                elementListeImg.style.width = '50%' ;
                var elCollapse = document.getElementById(idElementListe+'Collapse');
                elCollapse.style.maxHeight = '0px' ;
                elementListe.setAttribute('data-toggle', 'false');
                setTimeout(function(){elementListePara.style.position = "relative" ; }, 500);
            }

        }
        var elPara = document.getElementById(id+'Para');
        elPara.style.position = "absolute" ;
        elPara.style.textAlign = "center" ;
        elPara.style.width = "80%" ;
        elPara.style.color = "#fff" ;
        var elImg = document.getElementById(id+'Img');
        elImg.style.width = '100%' ;
        var elCollapse = document.getElementById(id+'Collapse');
        elCollapse.style.maxHeight = '100%' ;
        el.setAttribute('data-toggle', 'true')
    }
}
