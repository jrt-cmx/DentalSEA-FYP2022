<?php
session_start();

if (isset($_SESSION['loginid'])) {
    echo "<script>
                    alert('You have already logged in');
                    window.location.href='../index.php';
                </script>";
} else { //user is not logged in
    //check whether form input 'username' contains value
    if (isset($_POST['loginid'])) {

        //retrieve form data
        $entered_username = $_POST['loginid'];
        $entered_password = $_POST['password'];
        $_SESSION['dbSelection'] = $dbSelection = $_POST['dbSelection'];

        //connect to database
        include "../connection/db.php";

      
        //match the username and password entered with database record
        $query = "SELECT clinicloginID FROM clinicaccount 
                  WHERE clinicloginID='$entered_username' AND 
                  password = SHA1('$entered_password')";

        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        //if record is found, store id and username into session
        if (mysqli_num_rows($result) == 1)
        {
            header("Location: ../login.php");
        }
        else
        {
            echo 
            "<script>
                    alert('Username or password incorrect');
                    window.location.href='../index.php';
                </script>";
        }
    }
}
?>