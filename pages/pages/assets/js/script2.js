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
document.addEventListener('DOMContentLoaded', function() {
    const correctAnswers = document.querySelectorAll('.correct-answer');
    correctAnswers.forEach(answer => {
        answer.classList.add('correct');
    });

    // Ajouter l'animation de joie si le score est supérieur à 2
    const resultElement = document.querySelector('.result');
    if (resultElement && parseInt(resultElement.textContent.split(':')[1].trim()) > 2) {
        resultElement.classList.add('joy-animation');
        document.querySelector('.fireworks').style.display = 'block';
    }
});

function soumettreQuiz() {
    const modalContent = document.querySelector('.modal-content');
    modalContent.classList.add('submit-animation');
    setTimeout(() => {
        modalContent.classList.remove('submit-animation');
    }, 500);
}