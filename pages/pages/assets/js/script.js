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
