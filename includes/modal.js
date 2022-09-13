// function test() {
//     alert("Hello! I am an alert box!");

// }
// test()

var updateBtn = document.getElementById("btn--update");
var modal = document.getElementById("modal--update");

updateBtn.onclick = function () {
    // alert("Hello! I am an alert box!");
    modal.style.display = "block";
}

document.getElementById("submit").addEventListener("click", function () {
    document.getElementById("modal--update").style.display = "none";
})