// Fonction appelée au chargement complet de la page
window.onload = function() {
	// Fonction appelée lors d'une modification de l'envoi du formulaire
	document.forms["Inscription"].onsubmit = function() {
		ajax = new AjaxRequest({
			url: "ajax_inscription.php",
			method: 'post',
			parameters: {
				login: document.getElementById('login').value,
				firstname: document.getElementById('firstname').value,
				lastname: document.getElementById('lastname').value,
				email: document.getElementById('email').value,
				phone: document.getElementById('phone').value,
				password: CryptoJS.SHA512(document.getElementById('password').value),
				passwordConf: CryptoJS.SHA512(document.getElementById('passwordConf').value),
				genre: document.querySelector('#genre:checked').value,
				birth: document.getElementById('birth').value
			},
			onSuccess: function(res) {
				if (res == "Inscription bien effectuée") {
					window.location.href = "index.php";
					return false;
				}
				else if (res == "Certaines infos sont déjà utilisées" || res == "Le mot de passe ne correspond pas au mot de passe répété")
					document.getElementById('registerConfirmation').innerText = res;
				else
					document.getElementById('registerConfirmation').innerText = "Erreur : Cette page est bloquée par votre Antivirus Web";
				ajax = null;
			},
			onError: function(status, message) {
				window.alert('Error ' + status + ': ' + message);
			}
		});
		return false;
	}
}
