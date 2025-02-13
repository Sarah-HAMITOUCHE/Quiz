function ouvrirModal() {
    document.getElementById('modal').style.display = 'block';
}
function fermerModal() {
    document.getElementById('modal').style.display = 'none';
}
window.onclick = function(event) {
    if (event.target == document.getElementById('modal')) {
        fermerModal();
    }
}
function ouvrirModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'block';

    // Afficher les réponses sélectionnées
    const reponsesSelectionnees = document.getElementById('reponses-selectionnees');
    reponsesSelectionnees.innerHTML = '';

    document.querySelectorAll('.question-card').forEach((questionCard) => {
        const questionText = questionCard.querySelector('h3').innerText;
        const selectedReponse = questionCard.querySelector('input[type="radio"]:checked');

        if (selectedReponse) {
            const reponseText = selectedReponse.parentElement.innerText;
            reponsesSelectionnees.innerHTML += `<p><strong>${questionText}</strong><br>${reponseText}</p>`;
        } else {
            reponsesSelectionnees.innerHTML += `<p><strong>${questionText}</strong><br>Aucune réponse sélectionnée.</p>`;
        }
    });
}

function fermerModal() {
    document.getElementById('modal').style.display = 'none';
}

function soumettreQuiz() {
    alert('Quiz soumis !');
    fermerModal();
}

window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target == modal) {
        fermerModal();
    }
}