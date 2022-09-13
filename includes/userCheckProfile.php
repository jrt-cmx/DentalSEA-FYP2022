<?php
        include "../connection/db.php";
        $id = $_SESSION['username'];
        $sql2 = "(SELECT userType FROM useraccount WHERE loginID = '" . $id . "')";
        $result2 = $link->query($sql2);
        $row2 = $result2->fetch_assoc();
        $userType = $row2['userType'];
        if ($userType === "Admin") {
          echo "<script>
          window.location.href='../admin/userProfile.php?';
          </script>";
        } else
          echo "<script type='text/javascript'>
          alert('You are unauthorized to view this page');
          window.location = document.referrer;
          </script>";
        $link->close();
?>