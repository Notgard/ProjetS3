// Fonction appelée au chargement complet de la page
window.onload = function() {
	document.getElementById("formSearch").onsubmit = searchFunction;
	document.getElementById("searchIcon").onclick = searchFunction;
	
	function searchFunction(sport) {
		search = document.getElementById("header-searchbar").value;
		var newUrl = ".";
		if (search != "")
			newUrl = "index.php?search="+search;
		if (document.getElementById("listePublications") == null)
			window.location.href = newUrl;
		else {
			history.pushState({}, null, newUrl);
			ajax = new AjaxRequest({
				url: "index.php",
				method: 'get',
				parameters: { search: search },
				onSuccess: function(res) {
					var html = document.createElement("html");
					html.innerHTML = res;
					document.getElementById("listePublications").innerHTML = html.getElementsByClassName("main-post")[0].innerHTML;
					document.getElementById("header-searchbar").value = search;	
					ajax = null;
				},
				onError: function(status, message) {
					window.alert('Error ' + status + ': ' + message);
				}
			});
		}
		return false;
	}
}
