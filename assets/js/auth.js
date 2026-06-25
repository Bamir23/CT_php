document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email=document.getElementById('email').value;
    const mot_de_passe=document.getElementById('mot_de_passe').value;
    fetch('../../api/auth/login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email: email, mot_de_passe: mot_de_passe })
    })
    .then(response=>response.json())
    .then(data=>{
        if (data.success) {
            sessionStorage.setItem('user', JSON.stringify(data.user));
            window.location.href = '../../index.html';
        } else {
            alert(data.message);
        }
    })
    
});
document.getElementById('register-form').addEventListener('submit', function(f) {
    f.preventDefault();
    const nom=document.getElementById('nom').value;
    const prenom=document.getElementById('prenom').value;
    const email=document.getElementById('email').value;
    const mot_de_passe=document.getElementById('mot_de_passe').value;
    const confirmer_mot_de_passe=document.getElementById('confirmer_mot_de_passe').value;
    if (mot_de_passe !== confirmer_mot_de_passe) {
        alert("Les mots de passe ne correspondent pas");
        return;
    }
    fetch('../../api/auth/register.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nom:nom, prenom:prenom, email: email, mot_de_passe: mot_de_passe })
    })
    .then(response=>response.json())
    .then(data=>{
        if (data.success) {
            alert(data.message);
            // rediriger vers login
            window.location.href = '../../index.html#login';
        }else{
            alert(data.message)
        }
    })
    
});
