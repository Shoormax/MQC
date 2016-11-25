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

/**
 * Permet de rechercher un produit grâce au champ de recherche de la boutique
 *
 * @auhtor Valentin Dérudet
 */
function rechercheProduit(){
    var texte = $('#autoComplementationProduit').val();

    if(texte.length <= 0) {
        $('.apercuProduit').removeClass("produitRecherche");
    }
    else if(texte.length > 2) {
        $('.apercuProduit').removeClass("produitRecherche");

        $.ajax({
            url: 'php/autocomplementationProduit.php',
            type: 'POST',
            data : 'recherche=' + texte,
            dataType: "json",
            success: function(retour) {
                for(var i = 0; i <retour.length; i++)
                {
                    $("#apercuProduit" + retour[i]).addClass("produitRecherche");
                }

            },
            error: function() {
                console.log('a');
                alert("Erreur lors de la récupération");
            }
        });
    }
}

/**
 * Permet d'afficher une erreur.
 *
 * @auhtor Valentin Dérudet
 *
 * @param texte
 */
function affichageErreur(texte, status) {
    if(texte !== '') {
        if ($('#affichageOk').is(':visible')) {
            $('#affichageOk').hide();
        }
        $('#affichageErreur').show();
        $('#messageErreur').html(texte);

        if(typeof status != 'undefined') {
            $('#codeErreur').html('Code : '+status);
        }
    }
}

/**
 * Permet d'afficher une erreur.
 *
 * @auhtor Valentin Dérudet
 *
 * @param texte
 */
function affichageOk(texte) {
    if(texte !== '') {
        if($('#affichageErreur').is(':visible')) {
            $('#affichageErreur').hide();
        }
        $('#affichageOk').show();
        $('#messageOk').html(texte);
    }
}

/**
 * Redirige sur la page de détail du produit.
 *
 * @auhtor Valentin Dérudet
 *
 * @param id_utilisateur
 * @param id_produit
 * @returns {boolean}
 */
function redirectProduitDetaille(id_produit) {
    if(typeof id_produit != 'undefinded') {
    $.ajax({
            url: 'php/views/boutique/affichage_produit_detail.php',
            type: 'POST',
            data : {id_produit:id_produit},
            dataType: "json",
            success: function(retour) {
                affichageOk(retour['html']);
            },
            error: function(retour) {
                affichageErreur(retour['html']);
            }
        });
    }
    else{
        affichageErreur('Erreur lors de l\'affichage');
    }
}

/**
 * Permet d'ajouter un produit au panier
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 * @param id_produit
 * @returns {boolean}
 */
function ajoutPanier(id_utilisateur, id_produit) {
    if(id_utilisateur <= 0) {
        affichageErreur('Veuillez vous connecter pour ajouter ce produit à votre panier.');
        return false;
    }
    else if(typeof id_produit == 'undefined') {
        affichageErreur('Erreur lors de l\'ajout du produit au panier.');
        return false;
    }
    var quantite = $('#nombreProduit'+id_produit).val();

    $.ajax({
        url: 'php/views/boutique/ajoutPanier.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, id_produit:id_produit, quantite:quantite},
        dataType: "json",
        success: function(retour) {
            console.log(retour);
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                affichageOk(retour['html']);
            }
        },
        error: function(retour) {
            console.log(retour);
            affichageErreur(retour['html'], retour['status']);
        }
    });
}

function fermerErreur(div) {
    $('#'+div).hide();
}