<?php
// Code pour implémenter les fonctionnalités du catalogue des produits.

/**
 * Détermine le critère de tri.
 * @return string : valeur du critère de tri.
 */
function determinerCritereTri() {
    if(isset($_GET["tri"])) {
        $critere = $_GET["tri"];
    }
    else {
        $critere = "aleatoire";
    }
    return $critere;
}


/**
 * Trie les produits.
 * @param array $produits : tableau des produits à trier.
 * @param string $critereTri : critère du tri à utiliser.
 * @return array : même tableau mais trié par le critère demandé dans le 
 *                 paramètre de la requête HTTP ($_GET["tri"])
 */
function trierProduits($produits, $critereTri) {
    if($critereTri != "aleatoire") {
        usort($produits, $critereTri);
    }
    else {
        shuffle($produits);
    }
    return $produits;
}


/*************** Fonctions de comparaison pour le tri *************/

/**
 * Compare par prix ascendant.
 * @param object $elt1 : un élément du tableau à trier.
 * @param object $elt2 : un autre élément du tableau à trier.
 * @return integer : un nombre négatif (si elt1 est avant elt2), 
 *                             positif (si elt2 est avant elt1)
 *                             ou 0 sinon.
 */
function prixAsc($elt1, $elt2) {
    return $elt1->prix - $elt2->prix;
}

/**
 * Compare par prix descendant.
 * @param object $elt1 : un élément du tableau à trier.
 * @param object $elt2 : un autre élément du tableau à trier.
 * @return integer : un nombre négatif (si elt1 est avant elt2), 
 *                             positif (si elt2 est avant elt1)
 *                             ou 0 sinon.
 */
function prixDesc($elt1, $elt2) {
    return $elt2->prix - $elt1->prix;
}

/**
 * Compare par ventes descendant ("meilleur vendeur").
 * @param object $elt1 : un élément du tableau à trier.
 * @param object $elt2 : un autre élément du tableau à trier.
 * @return integer : un nombre négatif (si elt1 est avant elt2), 
 *                             positif (si elt2 est avant elt1)
 *                             ou 0 sinon.
 */
function ventesDesc($elt1, $elt2) {
    return $elt2->ventes - $elt1->ventes;
}

/**
 * Compare par nom ascendant ("alphabétique ascendant").
 * @param object $elt1 : un élément du tableau à trier.
 * @param object $elt2 : un autre élément du tableau à trier.
 * @return integer : un nombre négatif (si elt1 est avant elt2), 
 *                             positif (si elt2 est avant elt1)
 *                             ou 0 sinon.
 */
function nomAsc($elt1, $elt2) {
    return 0; // ne fait rien
}

function nomDesc($elt1, $elt2) {
    return 0; // ne fait rien
}

function dacDesc($elt1, $elt2) {
    return 0; // ne fait rien
}
?>

