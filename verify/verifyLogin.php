<?php
session_start();

if (isset($_SESSION['userId'])) {
    echo "<script>
                    alert('You will already logged in');
                    window.location.href='../login.php';
                </script>";
} else { //user is not logged in
    //check whether form input 'username' contains value
    if (isset($_POST['userId'])) {

        //retrieve form data
        $entered_username = $_POST['userId'];
        $entered_password = $_POST['passId'];

        //connect to database
        include "../connection/db.php";

        //match the username and password entered with database record
        $query = "SELECT loginID, password, userType FROM useraccount 
                  WHERE loginID='$entered_username' AND 
                  password = SHA1('$entered_password')";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        //if record is found, store id and username into session
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            if ($row['userType'] == "Admin") {
                $_SESSION['username'] = $row['loginID'];
                header("Location: ../dentist/dashBoard.php");
            } elseif ($row['userType'] == "Dentist") {
                $_SESSION['username'] = $row['loginID'];
                header("Location: ../dentist/dashBoard.php");
            } elseif ($row['userType'] == "Assistant") {
                $_SESSION['username'] = $row['loginID'];
                header("Location: ../dentist/dashBoard.php");
            }
        } else {
            echo "<script>
                    alert('Username or password incorrect');
                    window.location.href='../login.php';
                </script>";
        }
    }
}
