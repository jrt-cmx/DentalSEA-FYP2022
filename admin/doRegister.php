<?php
    session_start();
    include "../connection/db.php";

    $loginId = $_POST['loginId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $userType = $_POST['roles'];

$check_loginId = mysqli_query($link, "SELECT loginID FROM useraccount where loginID = '$loginId' ");
if(mysqli_num_rows($check_loginId) > 0){
    echo "<script>
                    alert('Username exist, please choose another one');
                    window.location.href='javascript:history.go(-1)';
                </script>";
}
else
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($userType)
        {
            case "Admin":
                $result = mysqli_query($link, "INSERT INTO useraccount (loginID, password, userType) VALUES ('$loginId', SHA1('$password'), '$userType')");
                $result1 = mysqli_query($link, "INSERT INTO admin (loginID, fName, lName) VALUES ('$loginId', '$fname', '$lname')");
                echo "<script>
                    alert('Admin account, register completed');
                    window.location.href='userAccount.php';
                </script>";
                break;

            case "Assistant":
                $result = mysqli_query($link, "INSERT INTO useraccount (loginID, password, userType) VALUES ('$loginId', SHA1('$password'), '$userType')");
                $result1 = mysqli_query($link, "INSERT INTO dentalassistant (loginID, fName, lName) VALUES ('$loginId', '$fname', '$lname')");
                echo "<script>
                    alert('Assistant account, register completed');
                    window.location.href='userAccount.php';
                </script>";
                break;

            case "Dentist":
                $result = mysqli_query($link, "INSERT INTO useraccount (loginID, password, userType) VALUES ('$loginId', SHA1('$password'), '$userType')");
                $result1 = mysqli_query($link, "INSERT INTO dentist (loginID, fName, lName) VALUES ('$loginId', '$fname', '$lname')");
                echo "<script>
                    alert('Dentist account, register completed');
                    window.location.href='userAccount.php';
                </script>";
                break;

            default:
                echo "<script>
                    alert('Error, try again');
                    window.location.href='javascript:history.go(-1)';
                </script>";
        }
    }
}
