function loadPosts() {
    fetch('api/feed/get-posts.php')
    .then(response => response.json())
    .then(posts => {
        let html = '';
        posts.forEach(post => {
            html += `
                <div class="post">
                    <img src="${post.photo_profile}" alt="avatar">
                    <h3>${post.nom} ${post.prenom}</h3>
                    <p>${post.content}</p>
                    <button class="btn-like" data-id="${post.id}">👍 Like</button>
                    <button class="btn-comment" data-id="${post.id}">💬 Commenter</button>
                </div>
            `;
        });
        document.getElementById('posts-container').innerHTML = html;
    });
}

function initFeed() {
    loadPosts();
    document.getElementById('btn-post').addEventListener('click', function() {
        const content = document.getElementById('post-content').value;
        const user = JSON.parse(sessionStorage.getItem('user'));
        fetch('api/feed/create-post.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: user.id, content: content, image_path: null })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('post-content').value = '';
                loadPosts();
            } else {
                alert(data.message);
            }
        });
    });
}