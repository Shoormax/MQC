/**
 * Created by Ben on 08/11/2016.
 */

// Initialisation des données en dur

// Tableau contenant tous les marqueurs
var activeMarkers = [];

// Tableaux contenant les coordonnées de tous les marqueurs, triés par catégorie
var markerFamille = [
    {lat: 45.732700, lng: 4.818213, desc: 'Le Musée des Confluences'},
    {lat: 45.729324, lng: 4.818430, desc: 'La pointe de Confluence'},
    {lat: 45.739697, lng: 4.814061, desc: 'Les Quais de Confluence'},
    {lat: 45.741073, lng: 4.817735, desc: 'Le Centre Commercial'},
    {lat: 45.741160, lng: 4.821978, desc: 'La Maison de la Confluence'},
    {lat: 45.742400, lng: 4.819914, desc: 'La Patinoire Charlemagne'},
    {lat: 45.743411, lng: 4.816987, desc: 'Les Jardins d\'Ereva'},
    {lat: 45.744070, lng: 4.814948, desc: 'Les Jardins de Ouagadougou'},
    {lat: 45.743001, lng: 4.814974, desc: 'La Maison de la Jeunesse et Culture de Confluence'}

];
var markerSportif = [
    {lat: 45.740650, lng: 4.817785, desc: 'AZIUM Escalade'},
    {lat: 45.744422, lng: 4.828798, desc: 'Lyon Sport Metropole Ski Nautique / Wakeboard'},
    {lat: 45.7408445, lng: 4.8188146, desc: 'Fitness Park, club de remise en forme'},
    {lat: 45.744907, lng: 4.817025, desc: 'Stade de Foot'},
    {lat: 45.741007, lng: 4.818351, desc: 'GO Sport, magasin de sport'},
    {lat: 45.742400, lng: 4.819914, desc: 'La Patinoire Charlemagne'},
    {lat: 45.7448014, lng: 4.8200559, desc: 'Keep Cool, salle de sport'},
    {lat: 45.743001, lng: 4.814974, desc: 'La Maison de la Jeunesse et Culture de Confluence'}

];
var markerCulturel = [
    {lat: 45.732700, lng: 4.818213, desc: 'Le Musée des Confluences'},
    {lat: 45.734477, lng: 4.815629, desc: 'Siège d\'Euronews, le bâtiment vert'},
    {lat: 45.737088, lng: 4.814949, desc: 'La Sucrière'},
    {lat: 45.738090, lng: 4.814660, desc: 'L\'Entrepôt des Douanes'},
    {lat: 45.739147, lng: 4.814407, desc: 'Le Cube Orange'},
    {lat: 45.739721, lng: 4.8141153, desc: 'La gare ferroviaire'},
    {lat: 45.740932, lng: 4.814330, desc: 'Le Jardin aquatique Jean Couty'},
    {lat: 45.741124, lng: 4.816998, desc: 'Librairie Decitre Confluence'},
    {lat: 45.742499, lng: 4.816081, desc: 'Le Pont des Arts'},
    {lat: 45.744070, lng: 4.814948, desc: 'Les Jardins de Ouagadougou'},
    {lat: 45.743411, lng: 4.816987, desc: 'Les Jardins d\'Ereva'},
    {lat: 45.742759, lng: 4.817828, desc: 'Galerie d\'Art Henri Chartier'},
    {lat: 45.742283, lng: 4.818252, desc: 'Le Monolithe'},
    {lat: 45.741160, lng: 4.821978, desc: 'La Maison de la Confluence'},
    {lat: 45.741381, lng: 4.822727, desc: 'Le Marché Gare, salle de concert'},
    {lat: 45.744952, lng: 4.823641, desc: 'Eglise Lyon Centre'}

];


// Fonction d'initialisation contenant l'API Google et permettant donc l'instanciation des variables de Google Map
function initMap() {
    // Objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
    // de définir des options d'affichage de notre carte
    var options = {
        center: new google.maps.LatLng(45.737085, 4.817744),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Constructeur de la carte qui prend en paramètre le conteneur HTML
    // dans lequel la carte doit s'afficher et les options
    var carte = new google.maps.Map(document.getElementById("carte"), options);

    // Les itinéraires personnalisé grâce aux objet Polyline
    var itineraireFamille = new google.maps.Polyline({
        strokeColor: "#0000FF",
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    var itineraireSportif = new google.maps.Polyline({
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    var itineraireCulturel = new google.maps.Polyline({
        strokeColor: "#00FF00",
        strokeOpacity: 1.0,
        strokeWeight: 2
    });

    //--- Itinéraire n°1 - Famille
    var pointsItineraireFamille = [
        new google.maps.LatLng(45.733691, 4.818739), //Arrêt T1
        new google.maps.LatLng(45.732700, 4.818213), //Musée
        new google.maps.LatLng(45.733691, 4.818739), //Arrêt T1
        new google.maps.LatLng(45.733257, 4.818943),
        new google.maps.LatLng(45.731108, 4.818476),
        new google.maps.LatLng(45.729324, 4.818430), //Pointe de Confluence
        new google.maps.LatLng(45.731123, 4.817730),
        new google.maps.LatLng(45.731853, 4.816657),
        new google.maps.LatLng(45.732276, 4.815772), //Les Quais
        new google.maps.LatLng(45.739697, 4.814061), //Les Quais
        new google.maps.LatLng(45.740584, 4.814011), //Les Quais
        new google.maps.LatLng(45.742580, 4.814437), //Les Quais
        new google.maps.LatLng(45.742165, 4.815718),
        new google.maps.LatLng(45.741871, 4.815506), //Entrée Centre
        new google.maps.LatLng(45.741073, 4.817735), //Centre Commercial
        new google.maps.LatLng(45.740624, 4.818831), //Entrée Centre
        new google.maps.LatLng(45.740538, 4.819191),
        new google.maps.LatLng(45.740929, 4.819580),
        new google.maps.LatLng(45.740615, 4.820540),
        new google.maps.LatLng(45.741227, 4.821178),
        new google.maps.LatLng(45.741109, 4.821646),
        new google.maps.LatLng(45.741236, 4.821756),
        new google.maps.LatLng(45.741160, 4.821978), //Maison de la Confluence
        new google.maps.LatLng(45.741236, 4.821756),
        new google.maps.LatLng(45.741404, 4.821882),
        new google.maps.LatLng(45.741606, 4.821490),
        new google.maps.LatLng(45.742121, 4.821822),
        new google.maps.LatLng(45.742645, 4.820556),
        new google.maps.LatLng(45.742248, 4.820213),
        new google.maps.LatLng(45.742400, 4.819914), //Patinoire
        new google.maps.LatLng(45.742248, 4.820213),
        new google.maps.LatLng(45.741542, 4.819685),
        new google.maps.LatLng(45.742880, 4.816488),
        new google.maps.LatLng(45.743384, 4.816845),
        new google.maps.LatLng(45.743411, 4.816987), //Jardin d'Ereva
        new google.maps.LatLng(45.744359, 4.816558),
        new google.maps.LatLng(45.744803, 4.815627),
        new google.maps.LatLng(45.744318, 4.815160),
        new google.maps.LatLng(45.744070, 4.814948), //Jardins Ouagadougou
        new google.maps.LatLng(45.743186, 4.814648),
        new google.maps.LatLng(45.743001, 4.814974)  //MJC
    ];

    //--- Itinéraire n°2 - Sportif
    var pointsItineraireSportif = [
        new google.maps.LatLng(45.740647, 4.818888),
        new google.maps.LatLng(45.738509, 4.817081),
        new google.maps.LatLng(45.738077, 4.816789),
        new google.maps.LatLng(45.737603, 4.816628),
        new google.maps.LatLng(45.736901, 4.816545),
        new google.maps.LatLng(45.736446, 4.816609),
        new google.maps.LatLng(45.735851, 4.816883),
        new google.maps.LatLng(45.734247, 4.817605),
        new google.maps.LatLng(45.733790, 4.817648),
        new google.maps.LatLng(45.733603, 4.817495),
        new google.maps.LatLng(45.733305, 4.818115),
        new google.maps.LatLng(45.733678, 4.818491),
        new google.maps.LatLng(45.733530, 4.819049),
        new google.maps.LatLng(45.733453, 4.818995),
        new google.maps.LatLng(45.733367, 4.819102),
        new google.maps.LatLng(45.733199, 4.819086),
        new google.maps.LatLng(45.731769, 4.818703),
        new google.maps.LatLng(45.730584, 4.818569),
        new google.maps.LatLng(45.729521, 4.818507),
        new google.maps.LatLng(45.728531, 4.818579),
        new google.maps.LatLng(45.728544, 4.818426),
        new google.maps.LatLng(45.729227, 4.818351),
        new google.maps.LatLng(45.729903, 4.818174),
        new google.maps.LatLng(45.730478, 4.817965),
        new google.maps.LatLng(45.731027, 4.817622),
        new google.maps.LatLng(45.731536, 4.817104),
        new google.maps.LatLng(45.731856, 4.816651),
        new google.maps.LatLng(45.732279, 4.815774),
        new google.maps.LatLng(45.732616, 4.815626),
        new google.maps.LatLng(45.739679, 4.814097),
        new google.maps.LatLng(45.740563, 4.814038),
        new google.maps.LatLng(45.742566, 4.814451),
        new google.maps.LatLng(45.742150, 4.815752), //Pont
        new google.maps.LatLng(45.742820, 4.816353), //Pont
        new google.maps.LatLng(45.743385, 4.815039),
        new google.maps.LatLng(45.743430, 4.814712),
        new google.maps.LatLng(45.744150, 4.814989),
        new google.maps.LatLng(45.745281, 4.816001),
        new google.maps.LatLng(45.745778, 4.816616),
        new google.maps.LatLng(45.743741, 4.821514),
        new google.maps.LatLng(45.740647, 4.818888)
    ];
    // Distance et temps du parcours :
    // 4,6km - 30 ou 35 minutes
    // Calcul du parcours Google: https://www.google.fr/maps/dir/45.7456375,4.8170064/45.745776,4.816634/@45.7371353,4.8126107,15z/data=!4m14!4m13!1m10!3m4!1m2!1d4.8185011!2d45.728523!3s0x47f4ebd6b1fe81fd:0x21c617095dcae5a2!3m4!1m2!1d4.8144489!2d45.7425455!3s0x47f4ebc616599529:0x75bfd8446d2c4579!1m0!3e2

    //--- Itinéraire n°3 - Culturel
    var pointsItineraireCulturel = [
        new google.maps.LatLng(45.732700, 4.818213), //Musée
        new google.maps.LatLng(45.733639, 4.818466),
        new google.maps.LatLng(45.733974, 4.817755),
        new google.maps.LatLng(45.733965, 4.817586),
        new google.maps.LatLng(45.734147, 4.817552),
        new google.maps.LatLng(45.734070, 4.816002),
        new google.maps.LatLng(45.734118, 4.815946),
        new google.maps.LatLng(45.734058, 4.815329),
        new google.maps.LatLng(45.734515, 4.815235),
        new google.maps.LatLng(45.734477, 4.815629), //Batiment vert
        new google.maps.LatLng(45.734515, 4.815235),
        new google.maps.LatLng(45.737024, 4.814707),
        new google.maps.LatLng(45.737088, 4.814949), //La Sucrière
        new google.maps.LatLng(45.737024, 4.814707),
        new google.maps.LatLng(45.738086, 4.814432),
        new google.maps.LatLng(45.738090, 4.814660), //Entrepôt des Douanes
        new google.maps.LatLng(45.738086, 4.814432),
        new google.maps.LatLng(45.739141, 4.814227),
        new google.maps.LatLng(45.739147, 4.814407), //Batiment orange
        new google.maps.LatLng(45.739141, 4.814227),
        new google.maps.LatLng(45.739721,4.8141153), //Gare ferroviaire
        new google.maps.LatLng(45.740436, 4.814094),
        new google.maps.LatLng(45.740932, 4.814330), //Jardins Jean Couty
        new google.maps.LatLng(45.741467, 4.814156),
        new google.maps.LatLng(45.742568, 4.814464),
        new google.maps.LatLng(45.742181, 4.815797),
        new google.maps.LatLng(45.742499, 4.816081), //Pont des Arts
        new google.maps.LatLng(45.742784, 4.816312),
        new google.maps.LatLng(45.743438, 4.814735),
        new google.maps.LatLng(45.744070, 4.814948), //Jardin Ouagadougou
        new google.maps.LatLng(45.744722, 4.815623),
        new google.maps.LatLng(45.744351, 4.816511),
        new google.maps.LatLng(45.743806, 4.816015),
        new google.maps.LatLng(45.743411, 4.816987), //Jardin d'Ereva
        new google.maps.LatLng(45.742972, 4.817678),
        new google.maps.LatLng(45.742787, 4.817852),
        new google.maps.LatLng(45.742759, 4.817828), //Galerie d'art
        new google.maps.LatLng(45.742787, 4.817852),
        new google.maps.LatLng(45.742711, 4.818068),
        new google.maps.LatLng(45.742357, 4.817757),
        new google.maps.LatLng(45.742178, 4.818150),
        new google.maps.LatLng(45.742283, 4.818252), //Le Monolithe
        new google.maps.LatLng(45.742178, 4.818150),
        new google.maps.LatLng(45.741439, 4.819960),
        new google.maps.LatLng(45.741342, 4.819877),
        new google.maps.LatLng(45.740955, 4.820810),
        new google.maps.LatLng(45.740903, 4.820952),
        new google.maps.LatLng(45.741229, 4.821201),
        new google.maps.LatLng(45.741077, 4.821609),
        new google.maps.LatLng(45.741255, 4.821761),
        new google.maps.LatLng(45.741160, 4.821978), //Maison Confluence
        new google.maps.LatLng(45.741255, 4.821761),
        new google.maps.LatLng(45.741772, 4.822158),
        new google.maps.LatLng(45.741581, 4.822684),
        new google.maps.LatLng(45.741381, 4.822727), //Marché Gare
        new google.maps.LatLng(45.741581, 4.822684),
        new google.maps.LatLng(45.741774, 4.822896),
        new google.maps.LatLng(45.741952, 4.822480),
        new google.maps.LatLng(45.743006, 4.823282),
        new google.maps.LatLng(45.743255, 4.822845),
        new google.maps.LatLng(45.744215, 4.823569),
        new google.maps.LatLng(45.744631, 4.822628),
        new google.maps.LatLng(45.744988, 4.822968),
        new google.maps.LatLng(45.744963, 4.823142),
        new google.maps.LatLng(45.745068, 4.823292),
        new google.maps.LatLng(45.744952, 4.823641) //Eglise Lyon Centre
    ];

    // --------------- Boutons d'action ---------------

    var buttonFamily = document.getElementById("btn_famille");
    buttonFamily.addEventListener('click', function(){
        waitForNextAnimation(buttons);
        destructActiveMarkers();
        clear(itineraireSportif);
        clear(itineraireCulturel);
        constructOnglet(markerFamille, carte);
        itineraireFamille = traceItineraire(itineraireFamille, pointsItineraireFamille, carte);
    });

    var buttonSport = document.getElementById("btn_sportif");
    buttonSport.addEventListener('click', function(){
        waitForNextAnimation(buttons);
        destructActiveMarkers();
        clear(itineraireFamille);
        clear(itineraireCulturel);
        constructOnglet(markerSportif, carte);
        itineraireSportif = traceItineraire(itineraireSportif, pointsItineraireSportif, carte);
    });

    var buttonCulture = document.getElementById("btn_culturel");
    buttonCulture.addEventListener('click', function(){
        waitForNextAnimation(buttons);
        destructActiveMarkers();
        clear(itineraireSportif);
        clear(itineraireFamille);
        constructOnglet(markerCulturel, carte);
        itineraireCulturel = traceItineraire(itineraireCulturel, pointsItineraireCulturel, carte);
    });

    // Tableau contenant les 3 boutons
    var buttons = [buttonCulture, buttonFamily, buttonSport];

    //On termine la fonction par l'appel des fonctions qui vont initialiser les marqueurs et l'itinéraire de l'onglet Famille
    // Peut être déplacé pour être appelé lorsqu'on clique sur l'onglet accessibilité !
    constructOnglet(markerFamille, carte);
    itineraireFamille = traceItineraire(itineraireFamille, pointsItineraireFamille, carte);
}


// -------------------------------------------------- Les Fonctions --------------------------------------------------

// Fonctions de constructions et d'animation des marqueurs
function constructOnglet(markers, carte) {
    for (var i = 0, c = markers.length; i < c; i++) {
        interval(markers[i], i, carte); // Appel d'une fonction boomerang pour pouvoir placer un timeout entre chaque création de marqueur
    }
}
function interval(marker, i, carte) {
    window.setTimeout(function() {
        activeMarkers.push(createMarker(marker.lat, marker.lng, marker.desc, carte));
    }, (i+1) * 300);
}

// Fonction de création de marqueur puis d'ajout des événements liés à celui-ci pour l'affichaqe des info bulles
function createMarker(lat, lng, desc, carte) {
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        animation: google.maps.Animation.DROP,
        map: carte
    });
    var info = new google.maps.InfoWindow({content: desc});
    marker.addListener('mouseover', function() {
        info.open(carte, marker);
    });
    marker.addListener('mouseout', function() {
        window.setTimeout(function() {
            info.close();
        }, 200);
    });
    return marker;
}

// Fonctions de nettoyage des markeurs actifs
function destructActiveMarkers() {
    for (var i = 0, c = activeMarkers.length; i < c; i++) {
        activeMarkers[i].setMap(null);
    }
    activeMarkers = [];
}

// --------------------------------- Itinéraires ---------------------------------

// Utiliser les timeout pour faire une contruction des polyline en temps réél avec apparition des markers.


function traceItineraire(itineraire, points, carte) {
    itineraire.setMap(carte);
    for (var i = 0, c = points.length; i < c; i++) {
        constructPath(itineraire, points[i], i, carte);
    }
    return itineraire;
}

function constructPath(itineraire, point, i) {
    window.setTimeout(function() {
        itineraire.getPath().push(point);
    }, (i+1) * 100);
}

function clear(itineraire) {
    itineraire.setMap(null);
    var path = [];
    itineraire.setPath(path);
}


function waitForNextAnimation(buttons) {
    for (var i = 0, c = buttons.length; i < c; i++) {
        buttons[i].disabled = true;
        wait(buttons[i]);
    }
}

function wait(button) {
    window.setTimeout(function() {
        button.disabled = false;
    }, 5000);
}
