function loadStats() {
    fetch('../../api/admin/stats.php')
    .then(response => response.json())
    .then(stats => {
        document.getElementById('stats-container').innerHTML = `
            <p>Utilisateurs : ${stats.users}</p>
            <p>Posts : ${stats.posts}</p>
            <p>Commentaires : ${stats.comments}</p>
            <p>Messages : ${stats.messages}</p>
        `;
    });
}
loadStats();
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-delete-user')) {
        const id = e.target.dataset.id;
        fetch('../../api/admin/manage-users.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadStats();
        });
    }
    if (e.target.classList.contains('btn-delete-post')) {
        const id = e.target.dataset.id;
        fetch('../../api/admin/manage-posts.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadStats();
        });
    }
});