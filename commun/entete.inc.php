<?php
    // Langue par défaut
    $langue = "fr";

    // Si l'utilisateur a déjà choisi une langue dans le passé :
    if(isset($_COOKIE["langue_choisie"])) {
        $langue = $_COOKIE["langue_choisie"];
    }

    // Si l'utilisateur sélection explicitement une langue :
    if(isset($_GET["lan"])) {
        $langue = $_GET["lan"];
        // RETENIR CE CHOIX DANS UN COOKIE!
        setcookie("langue_choisie", $langue, time() + 365*24*3600);
    }

    // Étape 1 : Lire le contenu du fichier des textes statiques.
    $textesJson = file_get_contents("i18n/$langue.json");

    // Étape 2 : Convertir la chaîne JSON obtenue en 1 en un tableau PHP
    $textes = json_decode($textesJson);

    // Étape 3 : Définir des raccourcis pour accéder aux textes des différentes parties de la page
    $_ent = $textes->entete;
    $_pp = $textes->pied2page;
    $_ = $textes->$page;
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teeTIM // fibre naturelle ... conception artificielle</title>
    <meta name="description" content="Page d'accueil du concepteur de vêtements 100% fait au Québec, conçus par les étudiants du TIM à l'aide de designs produits par intelligence artificielle, et fabriqués avec des fibres 100% naturelles et biologiques.">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/png" href="images/favicon.png" />
</head>
<body>
    <div class="conteneur">
        <header>
            <nav class="barre-haut">
                <!-- 
                    Envoi de paramètres de requête HTTP dans l'URL
                    et donc par la méthode HTTP GET (et non pas POST)
                -->
                <a href="?lan=en">en</a>
                <a href="?lan=fr">fr</a>
            </nav>
            <nav class="barre-logo">
                <label for="cc-btn-responsive" class="material-icons burger">menu</label>
                <a class="logo" href="index.php"><img src="images/logo.png" alt="<?= $_ent->logoAlt; ?>"></a>
                <a class="material-icons panier" href="panier.php">shopping_cart</a>
                <input class="recherche" type="search" name="motscles" placeholder="<?= $_ent->recherchePlaceholder; ?>">
            </nav>
            <input type="checkbox" id="cc-btn-responsive">
            <nav class="principale">
                <label for="cc-btn-responsive" class="menu-controle material-icons">close</label>
                <a <?= ($page=="teeshirts") ? ' class="actif" ' : '' ?> href="teeshirts.php"><?= $_ent->menuTeeshirts; ?></a>
                <a <?= ($page=="casquettes") ? ' class="actif" ' : '' ?> href="casquettes.php"><?= $_ent->menuCasquettes; ?></a>
                <a href="hoodies.php"><?= $_ent->menuHoodies; ?></a>
                <span class="separateur"></span>
                <a href="aide.php"><?= $_ent->menuAide; ?></a>
                <a href="apropos.php"><?= $_ent->menuNous; ?></a>
            </nav>
        </header>
