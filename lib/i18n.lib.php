<?php
/**
 * obtiens la liste des langues disponibles
 * 
 * @return array tableau des codes de langues disponibles (ex. ["fr","en","es"])
 */
function obtenirlanguedisonible() {
    /************** Tableau des langues disponibles *********/
    $languesDisponibles = [];
    // Obtenir dynamquement un tableau des langues disponibles
    $contenuI18n = scandir("i18n");
    // Parcourir le tableau pour ne garder que les fichiers JSON
    foreach ($contenuI18n as $nomFichier) {
        if($nomFichier != "." && $nomFichier != "..") {
            $languesDisponibles[] = substr($nomFichier, 0, 2);
        }
    }
    return $languesDisponibles;
}
/**
 * determiner la langue d'affichage du site
 * 
 * @param array $languesDisponibles tableau des codes de langues disponibles (ex. ["fr","en","es"])
 * @return string code de la langue choisie (ex. "fr")
 */
function determinerlangue($languespermises) {
    // Langue par défaut
    $langue = "fr";

    // Étape 1 : Vérifier si l'utilisateur a déjà fait un choix de langue
    if(isset($_COOKIE["choixLangue"]) && in_array($_COOKIE["choixLangue"], $languespermises)) {
        $langue = $_COOKIE["choixLangue"];
    }

    // Étape 2 : Vérifier si l'utilisateur vient de faire un choix de langue
    if(isset($_GET["lan"]) && in_array($_GET["lan"], $languespermises)) {
        $langue = $_GET["lan"];
        // RETENIR CE CHOIX DANS UN COOKIE!
        setcookie("choixLangue", $langue, time() + 365*24*3600);
    }

    return $langue;
}

/**
 * cherche les textes statiques
 * @param string $codelangue code de la langue choisie (ex. "fr")
 * @return array tableau des textes
 * @param string $page nom de la page courante (ex. "accueil", "teeshirts", "casquettes", etc.)
 */
function cherchertextes($codelangue, $page) {
    // Étape 1 : Lire le contenu du fichier des textes statiques.
    $textesJson = file_get_contents("i18n/$codelangue.json");

    // Étape 2 : Convertir la chaîne JSON obtenue en 1 en un tableau PHP
    $textes = json_decode($textesJson, true);
     // Étape 3 : Définir des raccourcis pour accéder aux textes des différentes parties de la page
    $_ent = $textes->entete;
    $_pp = $textes->pied2page;
    $_ = $textes->$page;

    return [$_ent, $_pp, $_];
}
?>