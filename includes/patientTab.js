



let tabs = document.querySelectorAll('.tab-link'),
    contents = document.querySelectorAll('.tab-content');

tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        contents.forEach((content) => {
            content.classList.remove("active")
        });
        tabs.forEach((tab) => {
            tab.classList.remove("active")
        });

        contents[index].classList.add("active")
        tabs[index].classList.add("active")
    });
});

// $(document).ready(function() {
//     $('a[data-toggle="tab"]').on()
// })

// $(function () {
//     $(".patient-page").tabs({
//         activate: function (event, ui) {

//             localStorage.setItem("lastTab", ui.newTab.index());
//         },
//         active: localStorage.getItem("lastTab") || 0
//     });
// });