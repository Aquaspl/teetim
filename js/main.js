// S'il y a un formulaire de tri et de filtre, alors le soumettre
// Quand un des deux select change de valeur
document.querySelectorAll("form.controle select").forEach(
    eltSelect => eltSelect.addEventListener("change", 
        evt => evt.target.form.submit()
    )
);