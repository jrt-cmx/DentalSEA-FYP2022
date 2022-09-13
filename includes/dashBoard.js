const date = new Date();


function timeOfDay() {
    let tOD = date.getHours();
    if (12 > tOD > 05) {
        document.getElementById("welcome--message").innerHTML = "Good Morning"
    } else if (19 > tOD > 12) {
        document.getElementById("welcome--message").innerHTML = "Good Afternoon"
    } else {
        document.getElementById("welcome--message").innerHTML = "Good Evening"
    }
}

timeOfDay();