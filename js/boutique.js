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

/**
 * Function pour tester des boutons et leur appel js
 *
 * @author Valentin Dérudet
 */
function test() {
    alert('a');
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
 * @param id_produit
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
                refreshAffichagePanier(id_utilisateur);
                $('#libelleProduitAffichage'+id_produit).html(retour['stock']);
            }
        },
        error: function(retour) {
            affichageErreur(retour['html'], retour['status']);
        }
    });
}

/**
 * Permet de fermer l'affichage d'erreurs ou de message de validation
 *
 * @author Valentin Dérudet
 *
 * @param div
 */
function fermerErreur(div) {
    $('#'+div).hide();
}

/**
 * Permet d'actualiser l'affichage du panier. Appelé au lancement de la page pour récupéré un panier potentiellement existant.
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function refreshAffichagePanier(id_utilisateur) {
    $.ajax({
        url: 'php/traitement/panier.php',
        type: 'POST',
        data: {id_utilisateur: id_utilisateur},
        dataType: "json",
        success: function (retour) {
            $('#contenuPanier').html(retour['html']);
        },
        error: function (retour) {
            affichageErreur(retour['html'], retour['status']);
        }
    });
}

/**
 * Permet d'afficher/fermer le panier au clique.
 *
 * @author Valentin Dérudet
 */
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

/**
 * Permet de modifier le panier en ajoutant/supprimant des produits
 *
 * @author Valentin Dérudet
 *
 * @param id_produit
 * @param id_panier
 * @param input
 */
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
            if(retour['status'] != 1) {
                affichageErreur(retour['html']);
            }
            else {
                refreshAffichagePanier(retour['id_utilisateur']);
                $('#libelleProduitAffichage'+id_produit).html(retour['stock']);
            }
        },
        error: function(retour) {
            affichageErreur(retour['html']);
        }
    });
}

/**
 * Permet de valider le panier actuellement actif
 *
 * @auhtor Valentin Dérudet
 *
 * @param id_panier
 */
function validationPanier(id_panier, id_utilisateur) {
    $('#validationPanier'+id_panier).hide();
    $('#validationPanierLoader'+id_panier).show();
    if(id_panier <= 0) {
        affichageErreur('Ce panier est introuvable.','000005');
        return false;
    }
    $.ajax({
        url: 'php/traitement/validation_panier.php',
        type: 'POST',
        data : {id_panier:id_panier, id_utilisateur:id_utilisateur},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                affichageOk(retour['html']);
                refreshAffichagePanier(id_utilisateur);
            }
            $('#validationPanierLoader'+id_panier).hide();
            $('#validationPanier'+id_panier).show();
        },
        error: function(retour) {
            affichageErreur(retour['html'], retour['status']);
        }
    });
}

/**
 * Permet a un super utilisateur d'afficher les produits des/de la boutique(s) de l'utilisateur
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function gestionProduits(id_utilisateur) {
    $.ajax({
        url: 'php/views/boutique/affichage_produits_modification.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur},
        dataType: "json",
        success: function (retour) {
            $('#gestionProduits').attr("onclick","location.reload()").html('Retour boutique');
            $('#boutique').html(retour['html']);
        },
        error: function(retour) {
            affichageErreur(retour['html'], retour['status'])
        }
    });
}

/**
 * Permet a un super utilisateur de modifier ses produits
 *
 * @author Valentin Dérudet
 *
 * @param id_produit
 * @param id_utilisateur
 */
function modificationProduit(id_produit, id_utilisateur) {
    var libelleProduit = $('#libelleProduit'+id_produit).val(),
        stock = $('#stockProduit'+id_produit).val(),
        prixProduit = $('#prixProduit'+id_produit).val(),
        description = $('#descriptionProduit'+id_produit).val();

    $.ajax({
        url: 'php/traitement/modifier_produit.php',
        type: 'POST',
        data : {id_produit:id_produit, libelleProduit:libelleProduit, prixProduit:prixProduit, id_utilisateur:id_utilisateur, stock:stock, description:description},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                affichageOk(retour['html']);
                gestionProduits(id_utilisateur)
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet de supprimer un produit d'une boutique
 *
 * @author Valentin Dérudet
 *
 * @param id_produit
 * @param id_utilisateur
 */
function supprimerProduit(id_produit, id_utilisateur) {
    $.ajax({
        url: 'php/traitement/supprimer_produit.php',
        type: 'POST',
        data : {id_produit:id_produit},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else{
                gestionProduits(id_utilisateur);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet d'ajouter un produit et de le lier à une boutique
 *
 * @author Valentin Dérudet
 *
 * @param id_boutique
 * @param id_utilisateur
 */
function ajoutProduit(id_boutique, id_utilisateur) {
    var libelle = $('#libelleAjoutProduit').val(),
        prix = $('#prixAjoutProduit').val(),
        stock = $('#stockAjoutProduit').val(),
        description = $('#descriptionAjoutProduit').val();

    $.ajax({
        url: 'php/traitement/ajout_produit.php',
        type: 'POST',
        data : {id_boutique:id_boutique, libelle:libelle, prix:prix, stock:stock, description:description},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                gestionProduits(id_utilisateur);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet d'afficher les boutiques actives et permet d'en ajouter une
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function gestionBoutique(id_utilisateur) {
    $('#autoComplementationProduit').hide();
    $.ajax({
        url: 'php/views/boutique/modification_boutique.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                $('#gestionBoutiques').attr("onclick","location.reload()").html('Retour boutique');
                $('#boutique').html(retour['html']);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet de modifier une boutique
 *
 * @author Valentin Dérudet
 *
 * @param id_boutique
 * @param id_utilisateur
 */
function modificationBoutique(id_boutique, id_utilisateur) {
    var libelle = $('#libelleBoutique' + id_boutique).val(),
        adresse = $('#adresseBoutique' + id_boutique).val(),
        code_postal = $('#codePostalBoutique' + id_boutique).val(),
        ville = $('#villeBoutique' + id_boutique).val();

    $.ajax({
        url: 'php/traitement/modification_boutique.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, id_boutique:id_boutique, libelle:libelle, adresse:adresse, code_postal:code_postal, ville:ville},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                affichageOk(retour['html']);
                gestionBoutique(id_utilisateur);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet de supprimer une boutique
 *
 * @author Valentin Dérudet
 *
 * @param id_boutique
 * @param id_utilisateur
 */
function suppressionBoutique(id_boutique, id_utilisateur) {
    $.ajax({
        url: 'php/traitement/suppression_boutique.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, id_boutique:id_boutique},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                gestionBoutique(id_utilisateur);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet d'ajouter une boutique
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function ajoutBoutique(id_utilisateur) {
    var libelle = $('#libelleAjoutBoutique').val(),
        adresse = $('#adresseAjoutBoutique').val(),
        code_postal = $('#codePostalAjoutBoutique').val(),
        ville = $('#villeAjoutBoutique').val();

    $.ajax({
        url: 'php/traitement/ajout_boutique.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, libelle:libelle, adresse:adresse, code_postal:code_postal, ville:ville},
        dataType: "json",
        success: function (retour) {
            if(retour['status'] != 1) {
                affichageErreur(retour['html'], retour['status']);
            }
            else {
                gestionBoutique(id_utilisateur);
            }
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}