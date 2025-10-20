<?php
$page = "teeshirts";
include("commun/entete.inc.php");
// Inclure la librairie qui gère le catalogue
include("lib/catalogue.lib.php");

// Intégrer le fichier JSON contenant les produits
$catalogue = json_decode(file_get_contents("data/teeshirts.json"));

// On crée deux tableaux pour stocker les thèmes et les produits
$themes = [];
$produits = [];

// On parcourt le catalogue pour sortir les thèmes et fusionner les produits
foreach ($catalogue as $codeTheme => $detailTheme) {
    $themes[$codeTheme] = $detailTheme->theme->$langue;

    // Fusionner avec le tableau $produits
    $produits = array_merge($produits, $detailTheme->produits);
}

// print_r($produits);

// Détecter si un tri est demandé
if(isset($_GET["tri"]) && $_GET["tri"] != "aleatoire") {
    $tri = $_GET["tri"];
    // Appliquer le tri demandé
    // REMARQUEZ que la valeur de la variable $tri est LA MÊME que le nom de la
    // fonction de comparaison correspondante.

    // Tester si cette valeur ($tri) correspond à une fonction avant de l'utiliser
    usort($produits, $tri);
}
else {
    $tri = "aleatoire";
    // Trier les produits aléatoirement
    shuffle($produits);
}

?>
<main class="page-produits page-teeshirts">
    <article class="amorce">
        <h1><?= $_->titrePage; ?></h1>
        <form class="controle" action="">
            <div class="filtre">
                <label for="filtre">Filtrer par thème : </label>
                <select name="filtre" id="filtre">
                    <option value="tous">Tous les produits</option>
                    <!-- Générer les options des thèmes dynamiquement -->
                    <?php foreach ($themes as $codeTheme => $nomTheme) : ?>
                        <option value="<?= $codeTheme; ?>"><?= $nomTheme; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="tri">
                <label for="tri"><?= $_cat->etiquetteTri; ?></label>
                <select name="tri" id="tri">
                    <option <?= ($tri=="aleatoire") ? "selected" : ""; ?> value="aleatoire"><?= $_cat->aleatoire; ?></option>
                    <option <?= ($tri=="dacDesc") ? "selected" : ""; ?> value="dacDesc"><?= $_cat->dacDesc; ?></option>
                    <option <?= ($tri=="prixAsc") ? "selected" : ""; ?> value="prixAsc"><?= $_cat->prixAsc; ?></option>
                    <option <?= ($tri=="prixDesc") ? "selected" : ""; ?> value="prixDesc"><?= $_cat->prixDesc; ?></option>
                    <option <?= ($tri=="nomAsc") ? "selected" : ""; ?> value="nomAsc"><?= $_cat->nomAsc; ?></option>
                    <option <?= ($tri=="nomDesc") ? "selected" : ""; ?> value="nomDesc"><?= $_cat->nomDesc; ?></option>
                    <option <?= ($tri=="ventesDesc") ? "selected" : ""; ?> value="ventesDesc"><?= $_cat->ventesDesc; ?></option>
                </select>
            </div>
        </form>
    </article>
    <article class="principal">
        <!-- Gabarit -->
        <?php foreach ($produits as $prd) : ?>
            <div class="produit">
                <span class="image">
                    <img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom->$langue; ?>">
                </span>
                <span class="nom"><?= $prd->nom->$langue; ?></span>
                <span class="prix"><?= number_format($prd->prix, 2, ',', ' '); ?> $</span>
                <span>Nombre de ventes : <?= $prd->ventes; ?></span>
            </div>
        <?php endforeach; ?>
    </article>
</main>
<?php
include("commun/pied2page.inc.php");
?>