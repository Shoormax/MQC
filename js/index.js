/**
 * Created by Valentin on 20/09/2016.
 */

function chargementPage(fichier) {
    document.location.href = 'php/' + fichier + '.php' ;
}

function slide(page) {
    window.scroll(0, findPos(document.getElementById(page)));
}

function findPos(obj) {
    var curtop = 0;
    if (obj.offsetParent) {
        do {
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
        return [curtop];
    }
}