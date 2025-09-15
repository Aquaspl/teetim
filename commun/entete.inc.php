<?php
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

    /************** Interactivité de changement de langue *********/
    // Langue par défaut
    $langue = "fr";

    // Si l'utilisateur a déjà choisi une langue dans le passé :
    // Remarquez la deuxième condition pour se défendre d'une valeur illégitime plantée dans un témoin HTTP (cookie)
    if(isset($_COOKIE["choixLangue"]) && in_array($_COOKIE["choixLangue"], $languesDisponibles)) {
        $langue = $_COOKIE["choixLangue"];
    }

    // Si l'utilisateur sélection explicitement une langue
    // Remarquez la deuxième condition pour se défendre d'une valeur illégitime envoyée dans un paramètre d'URL
    if(isset($_GET["lan"]) && in_array($_GET["lan"], $languesDisponibles)) {
        $langue = $_GET["lan"];
        // RETENIR CE CHOIX DANS UN COOKIE!
        setcookie("choixLangue", $langue, time() + 365*24*3600);
    }

    /************** Intégration des textes (externalisation) *********/
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
            <!-- Navigation barre des langues -->
            <nav class="barre-haut">
                <!-- 
                    Envoi de paramètres de requête HTTP dans l'URL
                    et donc par la méthode HTTP GET (et non pas POST)
                -->
                
                <!-- Solution 1 : pas désirable (trop de mélange PHP/HTML/PHP) -->
                <?php
                    // foreach ($languesDisponibles as $codeLangue) {
                    //     echo "<a ".(($langue==$codeLangue)?"class='actif'":"")." href='?lan=$codeLangue'>$codeLangue</a>";
                    // }
                ?>

                <!-- Solution 2 : plus souhaitable -->
                <?php foreach($languesDisponibles as $codeLangue) : ?>

                <a 
                    <?= ($langue==$codeLangue) ? ' class="actif" ' : '' ?> 
                    href="?lan=<?= $codeLangue; ?>"
                >
                    <?= $codeLangue; ?>
                </a>

                <?php endforeach ?>
            </nav>
            <nav class="barre-logo">
                <label for="cc-btn-responsive" class="material-icons burger">menu</label>
                <a class="logo" href="index.php"><img src="images/logo.png" alt="<?= $_ent->logoAlt; ?>"></a>
                <a 
                    class="material-icons panier" 
                    href="panier.php"
                >
                    shopping_cart
                </a>
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
