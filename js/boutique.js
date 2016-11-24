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

function apercuProduit(id_produit) {
  var div = document.getElementById("detailProduit");
  div.style.display = "block";
  div.innerHTML = id_produit;
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

function rechercheProduit(){
    var texte = $('#autoComplementationProduit').val();
    if(texte.length <= 0) {
        $("#tableauRecherche").html('').hide();
    }
    else if(texte.length > 2) {
        $.ajax({
            url: 'php/autocomplementationProduit.php',
            type: 'POST',
            data : 'recherche=' + texte,
            dataType: "text",
            success: function(retour) {
                $("#tableauRecherche").show().html(retour);
            },
            error: function() {
                alert("Erreur lors de la récupération");
            }
        });
    }
}