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
document.addEventListener('DOMContentLoaded', function() {
    const correctAnswers = document.querySelectorAll('.correct-answer');
    correctAnswers.forEach(answer => {
        answer.classList.add('correct');
    });
});

function soumettreQuiz() {
    const modalContent = document.querySelector('.modal-content');
    modalContent.classList.add('submit-animation');
    setTimeout(() => {
        modalContent.classList.remove('submit-animation');
    }, 500);
}