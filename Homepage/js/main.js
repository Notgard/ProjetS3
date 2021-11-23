//Peut-etre le récup sur données de session?
const user = "Manuel210992";
var commentInput = document.getElementById("input");
var commentButton = document.getElementById("btnn")
var postsInput = document.querySelectorAll('.comment-input');
var postsBtn = document.querySelectorAll('.post-comment');
var commentsBoxs = document.querySelectorAll('.comments');

$(document).ready(function () {

});

for (var inputField of postsInput) {
    let id4 = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    inputField.setAttribute("id", id4().toString());

    inputField.addEventListener("keypress", function (evt) {
        if (evt.key == 'Enter') {
            console.log(document.getElementById(evt.target.id).value);
            addComment(evt);
        }
    });
}
for (var button of postsBtn) {
    let id4 = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    button.setAttribute("id", id4().toString());
    commentButton.addEventListener('click', function (evt) {
        addComment(evt);
    });
}
for (var commentsBox of commentsBoxs) {
    let id4 = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    commentsBox.setAttribute("id", id4().toString());
    var commentSpan = document.createElement("div");
    commentSpan.setAttribute("id", id4().toString());
    commentSpan.className = 'comments-span';
    commentSpan.style.display = 'none';
    commentsBox.append(commentSpan);
    var span = document.createElement('span');
    span.setAttribute("id", id4().toString());
}

/*----------------------------------------------------------------------------------------------------------------
Fonction qui rajoute des commentaires sur un post 
*/

function addComment(evt) {
    var commentBoxId = "";
    var input = '';
    if (evt.target.className == "comment-input") {
        input = document.getElementById(evt.target.id);
        commentBoxId = $("#" + evt.target.id).prev().attr("id");
        console.log(input);
    }
    else if (evt.target.className == "post-comment") {
        let inputId = $("#" + evt.target.id).prev().attr("id");
        input = document.getElementById(inputId);
        commentBoxId = $("#" + inputId).prev().attr("id");
        console.log(evt.target.className);
        console.log(commentBoxId);
    }
    console.log(input);
    let comments = document.getElementById(commentBoxId);
    var commentText = input.value;
    let comment = document.createElement('div');
    let spanCommentsId = $("#" + commentBoxId).children(".comments-span").attr("id");
    console.log(spanCommentsId);
    let spanComments = document.getElementById(spanCommentsId);
    input.value = '';
    if (commentText.length > 0) {
        commentText = commentText.length > 60 ? commentText.substring(0, 60) + "..." : commentText;
        comment.innerHTML = '<strong style="color:black">' + user + "&nbsp;&nbsp;" + '</strong>' + commentText;
        comments.appendChild(comment);
        console.log('Comment successfully send!')
        if (comments.childElementCount >= 6) {
            let countSpan = spanComments.childElementCount;
            span.innerHTML = '';
            let text = comments.childElementCount == 6 ? "Afficher plus..." : "Afficher les " + countSpan + " commentaires...";
            span.innerHTML = text;
            comments.appendChild(span);
            spanComments.appendChild(comment);
            if (spanComments.childElementCount > 1) {
                span.style.cursor = "pointer";
                span.addEventListener("click", function (e) {
                    openOverlay(e);
                });
            }
        }
    }
    else {
        console.log("Not comments to be send(empty comment)");
    }
}

function openOverlay(e) {
    var overlay = document.getElementById("overlay");
    var closeBtn = document.querySelector('.close-overlay');
    var btnIcon = document.querySelector('button > img');

    overlay.classList.add("overlay-transition");
    overlay.style.display = "block";
    closeBtn.style.display = "block";
    btnIcon.style.display = "block";
    document.body.style.overflow = 'hidden';

    let test = document.querySelectorAll(".overlay-post-wrapper");

    for (const post of test) {
        post.remove();
    }

    console.log(e.target.id);

    var current = $("#" + e.target.id);
    console.log(current);

    let commentsBox = current.parent();
    console.log(commentsBox);

    var commentsSpan = $("#" + commentsBox.children(".comments-span").attr("id"));
    console.log(commentsSpan);

    var username = commentsBox.prev().children(".card-header").children(".username-post").text();
    console.log(username);

    var imgSrc = commentsBox.prev().children(".card-img-bottom").attr("src");
    var imgPost = document.createElement('img');

    imgPost.setAttribute("src", imgSrc);
    imgPost.className = "overlay-img-post";
    console.log(imgPost);

    var pfpSrc = commentsBox.prev().children(".card-header").children(".card-avatar").attr("src");
    var pfpPost = document.createElement('img');

    pfpPost.setAttribute("src", pfpSrc);
    pfpPost.className = "overlay-avatar";
    console.log(pfpPost);

    let createOverlayPost = () => {

        let container = document.createElement('div');
        container.className = "overlay-post-wrapper";

        let card = document.createElement('div');
        card.className = 'd-flex flex-row  overlay-post';
        card.style.zIndex = "1000000000000";

        let cardHeaderImg = document.createElement('div');
        cardHeaderImg.className = 'd-flex flex-column img-container';
        cardHeaderImg.appendChild(imgPost);

        let cardSideContent = document.createElement('div');
        cardSideContent.className = 'd-flex flex-column overlay-side-content'

        let cardSideHeader = document.createElement('div');
        cardSideHeader.className = 'd-flex flex-row align-items overlay-header'
        cardSideHeader.appendChild(pfpPost);
        let usernameSpan = document.createElement('span');
        usernameSpan.innerHTML = username;
        cardSideHeader.appendChild(usernameSpan);

        let seperator = document.createElement('hr');
        seperator.className = "sep hr2";

        let cardSideComments = document.createElement('div');
        cardSideComments.className = 'overlay-comments';
        let spanCommentId = commentsBox.children(".comments-span").attr("id");
        let spanComment = document.getElementById(spanCommentId).childNodes;

        for (var commentOverlay of spanComment) {
            cardSideComments.innerHTML += commentOverlay.innerHTML + '<br>';
        }

        console.log(spanComment);

        cardSideContent.appendChild(cardSideHeader);
        cardSideContent.appendChild(seperator);
        cardSideContent.appendChild(cardSideComments);

        card.appendChild(cardHeaderImg);
        card.appendChild(cardSideContent);
        container.appendChild(card);
        return container;
    }
    var createPost = createOverlayPost();
    overlay.appendChild(createPost);
    overlay.addEventListener("click", function (evt) {
        if (overlay !== evt.target) return;
        overlay.classList.add("overlay-transition");
        overlay.style.display = "none";
        closeBtn.style.display = "none";
        document.body.style.overflow = 'scroll';
        document.querySelector(".overlay-post-wrapper").remove();
    });
    closeBtn.addEventListener("click", function () {
        overlay.classList.add("overlay-transition");
        overlay.style.display = "none";
        closeBtn.style.display = "none";
        document.body.style.overflow = 'scroll';
        document.querySelector(".overlay-post-wrapper").remove();
    });
}


document.getElementById("drop-item-newPost").addEventListener("click", function () {
    newPost();
})


function newPost() {
    document.body.style.overflow = 'hidden';
    var overlay = document.getElementById("overlay");
    var closeBtn = document.querySelector('.close-overlay');
    closeBtn.style.display = "block";
    overlay.style.display = "block";
    overlay.style.overflowY = "scroll";
    var postHtml = '<div class="post-form"> <div class="card card-formPost"> <form id="formTest" name="formtest" method="GET"> <div class="card-header"> <img src="img/pfp/avatar.jpg" class="card-avatar" placeholder="Avatar user" /> <span class="username-post">Manuel210992</span> <div class="post-info"></div> </div> <label><h2>Titre de votre poste</h2>  </label> <div class="input-form-wrapper"> <input type="text" name="post-headline" /> </div> <div id="drop-region"> <h2 id="drop-file-text">Click here to upload your files</h2> <div class="drop-message m-5"> <svg version="1.1" id="add-image" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="56.513px" height="56.513px" viewBox="0 0 316.513 316.513" style="enable-background: new 0 0 316.513 316.513" xml:space="preserve" > <defs> <linearGradient id="gradient"> <stop offset="0%" stop-color="rgba(255,162,109,1)" /> <stop offset="10%" stop-color="rgba(255,162,109,1)" /> <stop offset="37%" stop-color="rgba(223,211,34,1)" /> <stop offset="102%" stop-color="rgba(226,161,31,1)" /> </linearGradient> </defs> <g> <path fill="url(#gradient)" d="M158.253,0C71,0,0.012,71.001,0.012,158.263c0,87.256,70.989,158.25,158.241,158.25 c87.259,0,158.248-70.994,158.248-158.25C316.501,71.001,245.518,0,158.253,0z M230.891,177.982h-57.748v52.914 c0,7.428-4.864,13.438-12.301,13.438c-7.422,0-12.298-6.017-12.298-13.438v-52.914H85.634c-7.44,0-13.454-4.864-13.454-12.298 s6.014-12.301,13.454-12.301h62.909V85.616c0-7.434,4.876-13.453,12.298-13.453c7.437,0,12.301,6.02,12.301,13.453v67.768h57.748 c7.439,0,13.456,4.867,13.456,12.301S238.33,177.982,230.891,177.982z" /> </g> </svg> </div> <div id="image-preview"></div> </div> <hr class="sep sep-form"> <h4 class="text-post-form">  <label class="blanc button px-2"> Date de l&#039évènement <div class="input-form-wrapper"> <input id="birth" type="date" required> </div> </label> </h2> <button class="btn p-1" type="submit" id="submit-post">Submit</button> </form> </div> </div>';
    //Append post form into overlay
    $('#overlay').append(postHtml);
    document.forms['formtest'].onsubmit = function () { return createPost() }


    //Manage Image post with html drag & drop API
    var dropRegion = document.getElementById("drop-region");
    var imagePreview = document.getElementById("image-preview");

    var fileManager = document.createElement("input");
    fileManager.type = "file";
    fileManager.accept = "image/*";
    fileManager.multiple = true;
    dropRegion.addEventListener("click", function (e) {
        fileManager.click();
    });
    fileManager.addEventListener("change", function (e) {
        var files = fileManager.files;
        handleFiles(files);
    });

    dropRegion.addEventListener('drop', function (e) {
        var data = e.dataTransfer,
            files = data.files;
        handleFiles(files);
    }, false);

    function preventDefault(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    dropRegion.addEventListener('dragenter', preventDefault, false);
    dropRegion.addEventListener('dragleave', preventDefault, false);
    dropRegion.addEventListener('dragover', preventDefault, false);
    dropRegion.addEventListener('drop', preventDefault, false);

    function handleFiles(files) {
        for (var file of files) {
            const types = ["image/jpeg", "image/png", "image/gif"];
            if (types.indexOf(file.type)) {
                previewImg(file);
            }
        }
    }
    function previewImg(image) {
        document.getElementById("drop-file-text").style.display = "none";
        document.getElementById("add-image").style.display = "none";
        var imgView = document.createElement("div");
        imgView.className = "image-view";
        imagePreview.appendChild(imgView);

        // previewing image
        var img = document.createElement("img");
        imgView.appendChild(img);

        // read the image...
        var reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(image);

        var formData = new FormData();
        formData.append('image', image);

        var ajax = new AjaxRequest(
            {
                url: "images.php",
                method: 'get',
                parameters: {
                    wait: true,
                    q: image
                },
                onSuccess: function (res) {
                    var span = document.createElement('span');
                    span.innerHTML = res;
                    document.getElementById("overlay").appendChild(span);
                },
                onError: function (status, message) {
                    window.alert('Error ' + status + ': ' + message);
                }
            });
        if (ajax != null) {
            ajax.cancel();
        } 
    }
    //closing the overlay when clicking outside of the post form box
    overlay.addEventListener("click", function (evt) {
        if (overlay !== evt.target) return;
        closeOverlay();
        $(".post-form").remove();
        $('#new-post').click();
    });
    closeBtn.addEventListener("click", function () {
        closeOverlay();
        $(".post-form").remove();
        $('#new-post').click();
    });
}
function closeOverlay() {
    let overlay = document.getElementById("overlay");
    let closeBtn = document.querySelector('.close-overlay');
    overlay.classList.add("overlay-transition");
    overlay.style.display = "none";
    closeBtn.style.display = "none";
    document.body.style.overflowY = 'scroll';
}

/* The code for creation of the actual post*/

function createPost() {
    let form = document.forms['formtest'];
    let postheadline = form.element['post-headline'];
    let image = "";
    let bottomtext = form.element[''];
    /* Création de la requête AJAX
    new AjaxRequest(
        {
            url: "create_post.php",
            method: 'post',
            parameters: {
                headline: postheadline,
                image: image,
                bottomText: bottomtext
            },
            onSuccess: function (res) {

            },
            onError: function (status, message) {

            }
        });
*/
    return false;
}