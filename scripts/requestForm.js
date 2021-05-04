//Disable Date Before Today in Date Picker
window.onload = function(){
var today = new Date().toISOString().split("T")[0];
document.getElementsByName('date')[0].setAttribute('min', today);
}
//End
