<?php if(!isset($_SESSION))
{
    session_start();
}  ?>
<!-- ---------- HEADER ---------- -->
<header class="header" id="header">
  <!-- <div class="page-title">
        <h2>Patients</h2>
      </div> --> <?php
                  include "../connection/db.php";

                  $id = $_SESSION['username'];
                  $sql = "(SELECT userType FROM useraccount WHERE loginID = '" . $id . "')";

                  $result = $link->query($sql);
                  $row = $result->fetch_assoc();
                  $name = $row['userType'];
                  echo "<h4 id='header--userType'> $name</h4>";
                  $link->close(); ?>
  <div class="header_img">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-circle-user fa-xl"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      <!-- <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider" /></li> -->
      <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
    </ul>
  </div>
</header>
