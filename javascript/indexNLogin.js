const loginid = document.getElementById("loginid");
const password = document.getElementById("password");
const clinic = document.getElementById("dbSelection");
const toggle = document.getElementById("password--toggle");
const eyecon = document.getElementById("password");

(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

const modal = document.querySelector("#modal");

function displayModal() {
    modal.showModal();
}
displayModal()

function displayPassword() {

    if (eyecon.type === "password") {
        toggle.classList.replace("fa-eye", "fa-eye-slash");
        eyecon.type = "text";
    } else {
        toggle.classList.replace("fa-eye-slash", "fa-eye");
        eyecon.type = "password";
    }
}

function validateForm() {
    let loop = [loginid, password, clinic];

    for (let i = 0; loop.length; i++) {
        if (loop[i].value == "") {
            document.getElementsByTagName("span")[i].innerHTML = "Required";
        } else {
        }
    }
}

function displayShowPasswordIcon() {
    if(password.value.length > 0) {
        toggle.style.display = "block"
    }
    else {
        toggle.style.display = "none"
    }
    // else if(password.value.length > 1) {
    //     toggle.style.display = "block"
    // }
}

