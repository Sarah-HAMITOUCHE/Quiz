function ouvrirModal() {
    document.getElementById("modal").style.display = "block";
}

function fermerModal() {
    document.getElementById("modal").style.display = "none";
}

// Fermer le modal si l'utilisateur clique en dehors du contenu du modal
window.onclick = function(event) {
    var modal = document.getElementById("modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.addEventListener("resize", function () {
    let logo = document.querySelector(".logo-container img");
    if (window.innerWidth < 768) {
        logo.style.width = "50px"; // Réduit la taille sur petits écrans
    } else {
        logo.style.width = "100px"; // Taille normale sur grands écrans
    }
});
