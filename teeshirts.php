<?php
    $page = "teeshirts";
    include("commun/entete.inc.php");
?>
        <main class="page-teeshirts">
            <article class="amorce">
                <h1><?= $_->titrePage; ?></h1>
            </article>
            <article class="principal">
                <?= $_->enConstruction; ?>
            </article>
        </main>
<?php
    include("commun/pied2page.inc.php");
?>