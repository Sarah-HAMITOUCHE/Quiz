document.addEventListener('DOMContentLoaded', (event) => {
    const element = document.querySelector('.short-animation');
    if (element) {
        element.addEventListener('animationend', () => {
            window.location.href = '/index.php';// Redirection vers la page index
        });
    }
});
