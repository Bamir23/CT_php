function loadConversations() {
    const user = JSON.parse(sessionStorage.getItem('user'));
    fetch(`api/chat/get-conversations.php?user_id=${user.id}`)
    .then(response => response.json())
    .then(users => {
        let html = '';
        users.forEach(u => {
            html += `
                <div class="conversations">
                    <img src="${u.photo_profile}" alt="avatar">
                    <h3>${u.nom} ${u.prenom}</h3>
                    <button class="btn-open-chat" data-id="${u.id}">Ouvrir</button>
                </div>
            `;
        });
        document.getElementById('conversations-container').innerHTML = html;
    });
}

function loadMessages(receiver_id) {
    const user = JSON.parse(sessionStorage.getItem('user'));
    fetch(`api/chat/get-messages.php?user_id=${user.id}&receiver_id=${receiver_id}`)
    .then(response => response.json())
    .then(messages => {
        let html = '';
        messages.forEach(m => {
            html += `<div class="message"><p>${m.content}</p></div>`;
        });
        document.getElementById('messages-container').innerHTML = html;
    });
}

let currentChat = null;

function initChat() {
    loadConversations();
    
    setInterval(() => {
        if (currentChat) loadMessages(currentChat);
    }, 3000);

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-open-chat')) {
            currentChat = e.target.dataset.id;
            loadMessages(currentChat);
        }
    });

    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const user = JSON.parse(sessionStorage.getItem('user'));
        const content = document.getElementById('message-input').value;
        fetch('api/chat/send-message.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sender_id: user.id, receiver_id: currentChat, content: content, image_path: null })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('message-input').value = '';
                loadMessages(currentChat);
            }
        });
    });
}