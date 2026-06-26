function loadView(page) {
    fetch(`vues/clients/${page}.html`)
    .then(response => response.text())
    .then(html => {
        document.getElementById('app').innerHTML = html;
        initPage(page);
    });
}

function initPage(page) {
    if (page === 'login') initLogin();
    if (page === 'register') initRegister();
    if (page === 'feed') initFeed();
    if (page === 'friends') initFriends();
    if (page === 'profile') initProfile();
    if (page === 'chat') initChat();
    if (page === 'dashboard') initAdmin();
}
loadView('login');
document.addEventListener('click', function(e) {
    if (e.target.dataset.page) {
        loadView(e.target.dataset.page);
    }
});
document.getElementById('btn-logout').addEventListener('click', function() {
    sessionStorage.removeItem('user');
    loadView('login');
});