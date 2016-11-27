/**
 * Created by Shosho on 26/11/2016.
 */

/**
 * Permet de modifier l'utilisateur avec les champs renseigner dans la page correspondante
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function modificationUtilisateur(id_utilisateur) {
    var nom = $('#nomUtilisateur'+id_utilisateur).val(),
        prenom = $('#prenomUtilisateur'+id_utilisateur).val(),
        email = $('#emailUtilisateur'+id_utilisateur).val(),
        new_password = $('#nouveauPassword'+id_utilisateur).val(),
        password = $('#verifPassword'+id_utilisateur).val();

    $.ajax({
        url: '../traitement/modification_utilisateur.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, nom:nom, prenom:prenom, email:email, new_password:new_password, password:password},
        dataType: "json",
        success: function (retour) {
            $('#retourModif').show().html(retour['html']);
        },
        error: function(retour) {
            $('#retourModif').show().html(retour['html']);
        }
    });
}

/**
 * Permet à un utilisateur de supprimer son compte.
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function suppressionCompte(id_utilisateur) {
    var password = $('#verifPassword'+id_utilisateur).val();
    $.ajax({
        url: '../traitement/suppression_compte.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur, password:password},
        dataType: "json",
        success: function (retour) {
            $('#retourModif').show().html(retour['html']);
            window.location = '../../deconnexion.php';
        },
        error: function(retour) {
            console.log(retour);
            $('#retourModif').show().html(retour['html']);
        }
    });
}

/**
 * Permet d'afficher les commandes d'un utilisateur
 *
 * @author Valentin Dérudet
 *
 * @param id_utilisateur
 */
function affichageCommandes(id_utilisateur) {
    $.ajax({
        url: '../traitement/affichage_commandes.php',
        type: 'POST',
        data : {id_utilisateur:id_utilisateur},
        dataType: "json",
        success: function (retour) {
            $('#affichageCommandes'+id_utilisateur).html(retour['html']);
        },
        error: function(retour) {
            console.log(retour);
        }
    });
}

/**
 * Permet d'afficher le contenu d'une commande
 *
 * @author Valentin Dérudet
 *
 * @param id_panier
 */
function affichage_contenu_commande(id_panier) {
    if($('#affichageContenuCommande'+id_panier).html() == "") {
        $.ajax({
            url: '../traitement/affichage_contenu_commande.php',
            type: 'POST',
            data : {id_panier:id_panier},
            dataType: "json",
            success: function (retour) {
                $('#affichageContenuCommande'+id_panier).html(retour['html']);
            },
            error: function(retour) {
                console.log(retour);
            }
        });
    }
    else {
        $('#affichageContenuCommande'+id_panier).html("");
    }
}