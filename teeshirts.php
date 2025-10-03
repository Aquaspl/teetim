<?php
$page = "teeshirts";
include("commun/entete.inc.php");
// Intégrer le fichier JSON contenant les produits
$produits = json_decode(file_get_contents("data/teeshirts.json"));
?>
<main class="page-produits page-teeshirts">
    <article class="amorce">
        <h1><?= $_->titrePage; ?></h1>
        <form class="controle">
  <div class="filtre">
      <label for="filtre">Filtrer par thème : </label>
      <select name="filtre" id="filtre">
          <option value="tous">Tous les produits</option>
          <option value="animaux">Animaux</option>
          <option value="nature">Nature</option>
          <option value="jeux">Jeux vidéo</option>
          <option value="inusite">Inusité</option>
          <option value="sport">Sport</option>
      </select>
  </div>
  <div class="tri">
      <label for="tri">Trier par : </label>
      <select name="tri" id="tri">
          <option value="tous">Meilleur vendeur</option>
          <option value="prix-asc">Prix / ascendant</option>
          <option value="prix-desc">Prix / descendant</option>
          <option value="nom-asc">Alpha / ascendant</option>
          <option value="nom-desc">Alpha / descendant</option>
          <option value="date_jout">Nouveauté</option>
      </select>
  </div>
</form>
    </article>
    <article class="principal">
        <!-- Gabarit -->
        <?php foreach ($produits as $prd) : ?>
            <div class="produit">
                <span class="image">
                    <img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom; ?>">
                </span>
                <span class="nom"><?= $prd->nom; ?></span>
                <span class="prix"><?= number_format($prd->prix, 2, ',', ' '); ?> $</span>
            </div>
        <?php endforeach; ?>
    </article>
</main>
<?php
include("commun/pied2page.inc.php");
?>