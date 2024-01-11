const getNavListe = document.querySelector(".content-menu");
const listeContenaire = document.querySelector(".content-menu__liste");
console.log(listeContenaire);

document.addEventListener("mouseover", (e) => {
    // Vérifiez si la souris n'est pas sur l'élément getNavListe

    if (getNavListe.contains(e.target)) {
        listeContenaire.classList.remove('visibleNav');
    } else {
        setTimeout(() => {
            listeContenaire.classList.add('visibleNav');
        }, 5000)
    }
});



