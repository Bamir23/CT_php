function loadProfile() {
    const user = JSON.parse(sessionStorage.getItem('user'));
    fetch(`../../api/profile/get-profile.php?user_id=${user.id}`)
    .then(response => response.json())
    .then(profile => {
        document.getElementById('nom').value = profile.nom;
        document.getElementById('prenom').value = profile.prenom;
        document.getElementById('email').value = profile.email;
    });
}
loadProfile();
document.getElementById('profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const user = JSON.parse(sessionStorage.getItem('user'));
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;
    const email = document.getElementById('email').value;
    
    fetch('../../api/profile/update-profile.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: user.id, nom, prenom, email, photo_profile: null })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
});