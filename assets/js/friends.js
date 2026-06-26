function loadUsers() {
    const user = JSON.parse(sessionStorage.getItem('user'));
    fetch(`../../api/friends/get-users.php?user_id=${user.id}`)
    .then(response => response.json())
    .then(users => {
        let html = '';
        users.forEach(u => {
            html += `
                <div class="users">
                    <img src="${u.photo_profile}" alt="avatar">
                    <h3>${u.nom} ${u.prenom}</h3>
                    <button class="btn-send-friend-request" data-id="${u.id}">Ajouter ami(e)</button>
                </div>
            `;
        });
        document.getElementById('users-container').innerHTML = html;
    });
}
loadUsers();
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-send-friend-request')) {
        const user = JSON.parse(sessionStorage.getItem('user'));
        const receiver_id = e.target.dataset.id;
        
        fetch('../../api/friends/send-request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sender_id: user.id, receiver_id: receiver_id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        });
    }
});