function loadView(page) {
    fetch(`vues/clients/${page}.html`)
    .then(response => response.text())
    .then(html => {
        document.getElementById('app').innerHTML = html;
    });
}
loadView('login');
document.addEventListener('click', function(e) {
    if (e.target.dataset.page) {
        loadView(e.target.dataset.page);
    }
});