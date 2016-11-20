
document.getElementById("btnConnexion").addEventListener("click", function () {
  gestionConnection();
});

var afficherConnecter = false;

function gestionConnection() {
  afficherConnecter = !afficherConnecter;
  if(afficherConnecter) {
    document.getElementById("formulaireConnexion").style.display = "block";
  } else {
    document.getElementById("formulaireConnexion").style.display = "none";
  }

}

function gestionConnection() {
  afficherConnecter = !afficherConnecter;
  if(afficherConnecter) {
    document.getElementById("formulaireConnexion").style.display = "block";
  } else {
    document.getElementById("formulaireConnexion").style.display = "none";
  }

}

/**
 * Permet de modifier la quantite sélectionnée pour les produits
 *
 * @auhtor Valentin Dérudet
 *
 * @param operator Si c'est un ajout ou une suppression
 * @param id_produit
 */
function modificationQuantite(operator, id_produit) {
  var input = document.getElementById("nombreProduit"+id_produit),
      quantite = input.value;

  if(operator == '+') {
    input.value = quantite - (-1);
  }
  else if (operator == '-') {
    input.value = quantite - 1;
  }
}
