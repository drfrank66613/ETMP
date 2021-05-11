window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}

var requestButtons = document.querySelectorAll(".button-training-request");
var itineraryButtons = document.querySelectorAll(".button-training-itinerary");

for (var i = 0; i < requestButtons.length; i++) {
    requestButtons[i].addEventListener("click",  function() {
        location.href = "request_page.php";
        document.cookie = "request_id=" + this.getAttribute("value") + "; path=/";
    });
}

for (var i = 0; i <itineraryButtons.length; i++) {
    itineraryButtons[i].addEventListener("click", function() {
        location.href = "admin_itinerary_management_page.php";
        document.cookie = "itinerary_id=" + this.getAttribute("value") + "; path=/";
    });
}
