window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}

var buttons = document.querySelectorAll(".button-training-request");

for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click",  function() {
        location.href = "request_page.php";
        document.cookie = "request_id=" + this.getAttribute("value") + "; path=/";
    });
}
