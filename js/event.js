/**
 * @author Joan TASSEL
 *
 * Créer un evenement sur chaque lien du "menu_haut"
 * Utilisation :
 * Creer un lien dans le "menu_haut" avec comme id "link_<name>" (<a id="link_fin"></a>)
 * Celui ci va scroller va l'élement d'id "<name>" (<div id="fin"></div>)
 *
 */
var menuLink = document.getElementById('menu_haut').getElementsByTagName('div');
for(var i=0; i<menuLink.length; i++) {
	menuLink[i].addEventListener('click', function(e) {
    e = e.target;
    if(e.tagName != 'DIV') {
      e = e.parentNode;
    }
		if(e.id != '') {
			var destination = e.id.replace("link_", "");
			scroll.To(destination);
		}
	});
}

var divArticles = document.getElementsByClassName('article');
for(var i=0; i<divArticles.length; i++) {
  	divArticles[i].addEventListener('click', function(e) {
      var id = e.target.id;
    	if(id.substr(id.length-3, id.length) == 'Img') {
    		id = id.substr(0, id.length-3);
    	}
    	else if(id.substr(id.length-4, id.length) == 'Para') {
    		id = id.substr(0, id.length-4);
    	}
    	deploiement(id);
  });  
}
