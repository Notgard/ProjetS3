function clickConversation(myThis) {
    selections = document.getElementsByClassName("selection");
    for (let i = 0; i < selections.length; i++)
        selections[i].classList.remove("selection");
    myThis.classList.add("selection");

    function boutonMessage() {
        var messageForm = document.getElementById("messageForm");
        messageForm.onsubmit = function() {
            if (R != null) R.cancel();
            var message = messageForm.elements['message'];
            R = new AjaxRequest({
                url: 'ajax_message.php',
                method: 'post',
                parameters: {
                    conversation: conversation,
                    message: message.value
                },
                onSuccess: function(res) {
                    afficheMessages();
                    message.value = "";
                },
                onError: function(status, message) {
                    window.alert('Error : ' + status + ":" + message)
                }
            });
            return false;
        }
    }

    function afficheMessages() {
        if (R != null)
            R.cancel();
        R = new AjaxRequest({
            url: 'ajax_afficheMessages.php',
            method: 'post',
            parameters: {
                idConversation: myThis.id
            },
            onSuccess: function(res) {
                section.innerHTML = res;
				section.scrollTop = section.scrollHeight;
                boutonMessage();
            },
            onError: function(status, message) {
                window.alert('Error : ' + status + ":" + message)
            }
        });
    }
    var conversation = myThis.id;
    var section = document.getElementById("section");
    document.getElementById("inputText").style.visibility = "visible";
    document.getElementById("mySubmit").style.visibility = "visible";
    var R = null;
    afficheMessages();
}

var AJAX = null;

function nouvelleConversation() {
    if (AJAX != null)
        AJAX.cancel();
    AJAX = new AjaxRequest({
        url: 'ajax_nouvelleConversation.php',
        method: 'post',
        parameters: {},
        onSuccess: function(res) {
            document.getElementById("div1").innerHTML = res;
        },
        onError: function(status, message) {
            window.alert('Error : ' + status + ":" + message)
        }
    });
}

function addFriend(myThis) {
    var selectFriend = document.getElementsByClassName("addFriend");
    var myBool = true;
    for (let i = 0; i < selectFriend.length; i++)
        if (selectFriend[i] == myThis) {
            myBool = false;
            selectFriend[i].classList.remove("addFriend");
        }
    if (myBool)
        myThis.classList.add("addFriend");
}


function validerConv() {
    var selectFriend = document.getElementsByClassName("addFriend");
    var selections = [];
    for (let i = 0; i < selectFriend.length; i++)
        selections[i] = selectFriend[i].id;
	if (selections.length != 0) {
		if (AJAX != null)
			AJAX.cancel();
		AJAX = new AjaxRequest({
			url: 'ajax_nouvelleConversation.php',
			method: 'post',
			parameters: {
				selection: selections,
				nomConv: document.getElementById('nomConv').value,
			},
			onSuccess: function(res) {
				window.location.href = 'message.php';
			},
			onError: function(status, message) {
				window.alert('Error : ' + status + ":" + message)
			}
		});
	}
}