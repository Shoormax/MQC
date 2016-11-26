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
    $('#inputAjoutPanier'+id_produit).hide();
    $('#inputAjoutPanierLoader'+id_produit).show();
    if(id_utilisateur <= 0) {
        affichageErreur('Veuillez vous connecter pour ajouter ce produit à votre panier.');
        return false;
    }
    else if(typeof id_produit == 'undefined') {
        affichageErreur('Erreur lors de l\'ajout du produit au panier.');
        return false;
    }
    var quantite = $('#nombreProduit'+id_produit).val();
    $('#nombreProduit'+id_produit).val(0);

    $.ajax({
        url: 'php/views/boutique/ajoutPanier.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, id_produit:id_produit, quantite:quantite},
        dataType: "json",
        success: function(retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                affichageOk(retour['html']);
                refreshAffichagePanier(id_utilisateur);
            }
            $('#inputAjoutPanierLoader'+id_produit).hide();
            $('#inputAjoutPanier'+id_produit).show();
        },
        error: function(retour) {
            affichageErreur(retour['html'], retour['status']);
            $('#inputAjoutPanierLoader'+id_produit).hide();
            $('#inputAjoutPanier'+id_produit).show();
        }
    });
}

function fermerErreur(div) {
    $('#'+div).hide();
}

function refreshAffichagePanier(id_utilisateur) {
    $.ajax({
        url: 'php/traitement/panier.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur},
        dataType: "json",
        success: function (retour) {
            $('#tablePanier').html(retour['html']);
        },
        error: function(retour) {
            console.log(retour);
            affichageErreur(retour['html'], retour['status']);
        }
    });
}

function affichagePanier() {
    if ($('#contenuPanier').is(':visible')) {
        $('#contenuPanier').hide();
        $('.fa-cart-arrow-down').show()
    }
    else  {
        $('.fa-cart-arrow-down').hide();
        $('#contenuPanier').show();
    }
}

function modificationPanier(id_produit, id_panier, input) {
    var method = 'ajout';

    if(input.className == 'fa fa-minus-circle') {
        method = 'suppression';
    }

    $.ajax({
        url: 'php/traitement/modification_panier.php',
        type: 'POST',
        data : {id_produit:id_produit, id_panier:id_panier, method:method},
        dataType: "json",
        success: function (retour) {
            refreshAffichagePanier(retour['id_utilisateur']);
        },
        error: function(retour) {
            affichageErreur(retour['html']);
        }
    });
}
