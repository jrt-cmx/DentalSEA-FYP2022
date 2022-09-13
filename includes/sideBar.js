let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
});

// searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
//     sidebar.classList.toggle("open");
//     menuBtnChange(); //calling the function(optional)
// });

// following are the code to change sidebar button(optional)
function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("fa-teeth", "fa-teeth-open");//replacing the iocns class
    } else {
        closeBtn.classList.replace("fa-teeth-open", "fa-teeth");//replacing the iocns class
    }
}



document.addEventListener("DOMContentLoaded", function (event) {
    var element = document.querySelector('.sidebar');

    function fixSideBar() {
        if(window.innerWidth >= 1000) {
            element.classList.add('open')
        }
    }
    fixSideBar()
    function resize() {
        if (window.innerWidth > 1000) {
            element.classList.add('open');
        } else {
            element.classList.remove('open');
        }
    }
    window.onresize = resize;
});

// window.onload = function() {
//     if(localStorage.getItem(sidebar)
// }