
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
 * @param operator        Si c'est un ajout ou une suppression
 * @param id_produit
 * @param quantite_stock  La quantite a ne pas dépasser
 */
function modificationQuantite(operator, id_produit, quantite_stock) {
  var input = document.getElementById("nombreProduit"+id_produit),
      quantite = input.value;

  if(operator == '+' && quantite < quantite_stock) {
    input.value = quantite - (-1);
  }
  else if (operator == '-' && quantite > 0) {
    input.value = quantite - 1;
  }
}
