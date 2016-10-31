/**
 * @author Joan
 * Objet Scroll
 *
 * Permet de naviguer d'une partie à une autre dans le site au clique du menu
 * Utilisation : scroll.To('id');
 * @type {{To}}
 */
var scroll = (function() {
  var marge = document.getElementById('menu_haut').clientHeight;
  var elementPosition = function(elem) {
    return function() {
      return elem.getBoundingClientRect().top - marge;
    };
  };
  var scrolling = function(elemID) {
    var el = document.getElementById( elemID ),
    elPos = elementPosition( el ),
    increment = Math.round( Math.abs( elPos() )/40 ),
    time = Math.round( (5/elPos()) ),
    prev = 0,
    E;

    function scroller() {
      E = elPos();

      if (E === prev) {
        return;
      } else {
        prev = E;
      }

      increment = (E > -20 && E < 20) ? ((E > - 5 && E < 5) ? 1 : 5) : increment;

      if (E > 1 || E < -1) {
        if (E < 0) {
          window.scrollBy( 0,-increment );
        } else {
          window.scrollBy( 0,increment );
        }
        setTimeout(scroller, time);
      } else {
        el.scrollTo( 0,0 );
      }
    }

    scroller();
  };
  return {
    To: scrolling
  }
})();

