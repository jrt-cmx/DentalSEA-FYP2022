<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!--------------------- Head --------------------->
  <?php include "../includes/head.php" ?>
  <title> Dashboard </title>
</head>

<body class="body">

  <!--------------------- Header --------------------->
  <?php include "../includes/header.php"; ?>
  <!--------------------- Side Bar --------------------->
  <?php include "../includes/navBar/navBar.php"; ?>
  <?php include "../includes/sideBar.php"; ?>

  <!--------------------- Dashboard --------------------->
  <section class="home-section">
    <!-- <h2 class="page-title">Dashboard</h2> -->
    <div class="dashboard--grid--section">

      <div class="dashboard-shortcuts">
        <a class="shortcut-link" href="../assistant/addAppointment.php"><i class="fa-solid fa-square-plus"></i><span>Appointment</span></a>
        <a class="shortcut-link" href="../assistant/addNewPatient.php"><i class="fa-solid fa-square-plus"></i><span>Patient</span></a>
        <a class="shortcut-link" href="../assistant/addMedicine.php"><i class="fa-solid fa-square-plus"></i><span>Stock</span></a>
      </div>

      <div class="dashboard-welcome">
        <h3 class="welcome-message" id='welcome--message'></h3>
        <p>Have a pleasant day at work today.</p>
        <p>Do not forget to wash your hands and brush your teeth.</p>
      </div>

      <div class="dashboard-appointments">
        <a class="appointment-shortcut" href="../assistant/appointment.php">
          <div class="appointments-top">
            <div class="appointments-logo">
              <i class="fa-solid fa-file-medical fa-xl"></i>
            </div>
            <?php
            include "../connection/db.php";
            $sql = "SELECT * FROM appointment";
            $result = $link->query($sql);
            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);
            echo "<h3 class='appointments-output'> $rowcount</h3>";
            $link->close();
            ?>
          </div>
          <div class="appointments-bottom">
            <h4 class="dashboard-part-title">APPOINTMENTS</h4>
            <p class="dashboard-appointments-description">Number of appointments today.</p>
          </div>
        </a>
      </div>

      <div class="dashboard-patients">

        <a class="patient-shortcut" href="../assistant/patient.php">
          <div class="patients-top">
            <div class="patients-logo">
              <i class="fa-solid fa-user-injured fa-xl"></i>
            </div>
            <?php
            include "../connection/db.php";
            $sql = "SELECT * FROM patient";
            $result = $link->query($sql);
            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);
            echo "<h3 class='patients-output'> $rowcount</h3>";
            $link->close();
            ?>
          </div>
          <div class="patients-bottom">
            <h4 class="dashboard-part-title">PATIENTS</h4>
            <p class="dashboard-patients-description">Total patients registered.</p>
          </div>
        </a>
      </div>

      <div class="dashboard-staff">
        <h2 class="dashboard-staff-title">Clinic staff</h2>
        <div class="staff-dentists">
          <h4 class="staff-title">Dentist: </h4>
          <?php
          include "../connection/db.php";
          $sql = "SELECT * FROM useraccount WHERE userType = 'Dentist'";
          $result = $link->query($sql);
          // Return the number of rows in result set
          $rowcount = mysqli_num_rows($result);
          echo "<p class='staff-count'> $rowcount</p>";
          $link->close();
          ?>
        </div>
        <div class="staff-assistants">
          <h4 class="staff-title">Assistants: </h4>
          <?php
          include "../connection/db.php";
          $sql = "SELECT * FROM useraccount WHERE userType = 'Assistant'";
          $result = $link->query($sql);
          // Return the number of rows in result set
          $rowcount = mysqli_num_rows($result);
          echo "<p class='staff-count'> $rowcount</p>";
          $link->close();
          ?>
        </div>
        <div class="staff-admins">
          <h4 class="staff-title">Admins: </h4>
          <?php
          include "../connection/db.php";
          $sql = "SELECT * FROM useraccount WHERE userType = 'Admin'";
          $result = $link->query($sql);
          // Return the number of rows in result set
          $rowcount = mysqli_num_rows($result);
          echo "<p class='staff-count'> $rowcount</p>";
          $link->close();
          ?>
        </div>
      </div>

      <div class="dashboard-profile">
        <div class="profile-image"><i class="fa-solid fa-id-card-clip"></i></div>
        <?php
        echo "<h4 class='profile-role'> $name</h4>";
        ?>
        <?php
        include "../connection/db.php";
        $id = $_SESSION['username'];
        $sql = "(SELECT fName, lName FROM dentist WHERE loginID = '" . $id . "')
              UNION        
              (SELECT fName, lName FROM admin WHERE loginID = '" . $id . "')
              UNION                
              (SELECT fName, lName FROM dentalassistant WHERE loginID = '" . $id . "')";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $fname = $row['fName'];
        $lname = $row['lName'];
        $sql2 = "(SELECT userType FROM useraccount WHERE loginID = '" . $id . "')";
        $result2 = $link->query($sql2);
        $row2 = $result2->fetch_assoc();
        $userType = $row2['userType'];
        if ($userType === "Dentist") {
          echo "<p class='profile-name'>Dr. $fname $lname</p>";
        } else
          echo "<p class='profile-name'> $fname $lname</p>";
        $link->close();
        ?>
      </div>

      <div class="dashboard-appointment-list">
        <h3 class="dashboard-grid-title">Appointment List</h3>
        <div class="table-part">
          <p class="table-column-header">Type</p>
          <p class="table-column-header">Patient</p>
          <p class="table-column-header">Dentist</p>
          <p class="table-column-header column-right">Start Time</p>
        </div>

        <?php

        require('../connection/db.php');
        $return = '';
        if (isset($_POST["query"])) {
          $search = mysqli_real_escape_string($link, $_POST["query"]);
          $query = "SELECT appointmentID, ICorPassportNo, dentistID, assistantID, startTime, endTime, type, remarks FROM appointment
	WHERE appointmentID  LIKE '%" . $search . "%'
	OR dentistID LIKE '%" . $search . "%' 
	OR ICorPassportNo LIKE '%" . $search . "%' 
	OR assistantID LIKE '%" . $search . "%' 
    OR startTime LIKE '%" . $search . "%'
    OR endTime LIKE '%" . $search . "%'  
	OR type LIKE '%" . $search . "%' 
	OR remarks LIKE '%" . $search . "%' 
	";
        } else {
          $query = "SELECT appointmentID, ICorPassportNo, dentistID, assistantID, startTime, endTime, type, remarks FROM appointment";
        }
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row1 = mysqli_fetch_array($result)) {
            $return .= '
		    <div class="table-row">
                <p class="table-column-input ">' . $row1['type'] . '</p>
                <p class="table-column-input">' . $row1['ICorPassportNo'] . '</p>
                <p class="table-column-input">' . $row1['dentistID'] . '</p>
                <p class="table-column-input column-right">' . $row1['startTime'] . '</p>
		    </div>';
          }
          echo $return;
        } else {
          echo 'No results containing all your search terms were found.';
        }

        ?>
      </div>
      <!--------------------- WELCOME --------------------->
      <!-- <div class="grid--parts welcome grid--col--span--4" id="grid--top"> -->
      <?php
      // include "../connection/db.php";
      // $id = $_SESSION['username'];
      // $sql = "(SELECT fName, lName FROM dentist WHERE loginID = '" . $id . "')
      //         UNION        
      //         (SELECT fName, lName FROM admin WHERE loginID = '" . $id . "')
      //         UNION                
      //         (SELECT fName, lName FROM dentalassistant WHERE loginID = '" . $id . "')";
      // $result = $link->query($sql);
      // $row = $result->fetch_assoc();
      // $name = $row['fName'];
      // // $userType = $row['useraccount.userType'];
      // // echo "<p>$userType</p>";
      // $sql2 = "(SELECT userType FROM useraccount WHERE loginID = '" . $id . "')";
      // $result2 = $link->query($sql2);
      // $row2 = $result2->fetch_assoc();
      // $userType = $row2['userType'];
      // if ($userType === "Dentist") {
      //   echo "<h3 id='welcome--message'></h3><span class=\"user\"> $name</span>";
      // } else
      //   echo "<h3 id='welcome--message'></h3><span class=\"user\"> $name</span>";
      // $link->close();
      ?>

      <!-- <p class="grid--parts--text">Do not forget to wash your hands.</p> -->
      <!-- </div> -->

      <!--------------------- APPOINTMENTS --------------------->
      <!-- <a class="grid--parts appointments">
        <div class="appointments--number">
          <div class="appointments--logo">
            <i class="fa-solid fa-file-medical fa-xl"></i>
          </div>
          <h3 class="appointments--output">1</h3>
        </div>
        <h4>APPOINTMENTS</h4>
        <p class="grid--parts--text">Number of appointments today.</p>
      </a> -->

      <!--------------------- PATIENTS --------------------->
      <!-- <a class="grid--parts patients" href="../assistant/patient.php">
        <div class="patients--number">
          <div class="patients--logo">
            <i class="fa-solid fa-user-injured fa-xl"></i>
          </div>
          <?php

          // include "../connection/db.php";
          // $sql = "SELECT * FROM patient";
          // $result = $link->query($sql);
          // // Return the number of rows in result set
          // $rowcount = mysqli_num_rows($result);
          // echo "<h3 class='patients--output'> $rowcount</h3>";
          // $link->close();
          ?>
        </div>
        <h4>PATIENTS</h4>
        <p class="grid--parts--text">Number of patients registered under clinic.</p>
      </a> -->

      <!--------------------- STAFFS --------------------->
      <!-- <div class="grid--parts staffs">
        <div class="staffs--number">
          <div class="staffs--logo">
            <i class="fa-solid fa-user-tie fa-xl"></i>
          </div>
          include "../connection/db.php";
          $sql = "SELECT * FROM useraccount";
          $result = $link->query($sql);
          // Return the number of rows in result set
          $rowcount = mysqli_num_rows($result);
          echo "<h3 class='staffs--output'> $rowcount</h3>";
          $link->close();
        </div>
        <h4>STAFFS</h4>
        <p class="grid--parts--text">Clinic staff headcount.</p>
      </div> -->


      <!--------------------- REVENUE --------------------->
      <!-- <div class="grid--parts revenue">
        <div class="revenue--number">
          <div class="revenue--logo">
            <i class="fa-solid fa-money-bill-trend-up fa-xl"></i>
          </div>
          <h3 class="revenue--output">$0</h3>
        </div>
        <h4>REVENUE</h4>
        <p class="grid--parts--text">Total revenue today.</p>
      </div> -->

      <!--------------------- CALENDAR --------------------->
      <!-- <div id="calendar" class="grid--parts calendar grid--col--span--4">
        <h4>CALENDAR</h4>
      </div> -->

      <!--------------------- RIGHT BAR --------------------->
      <!-- <div class="grid--parts right--bar">
        <h4>ANNOUNCEMENTS</h4>
        <ul class="announcements--list">
          <li class="list--items">Server Maintainence</li>
          <li class="list--items">National Tooth Fairy Day 22 Aug</li>
          <li class="list--items">Upcoming appointment</li>
          <li class="list--items">Upcoming appointment</li>

        </ul>
      </div> -->
    </div>
    <?php include "../includes/footer/footer.php"; ?>
  </section>

  <!--------------------- Scripts --------------------->
  <?php include "../includes/scripts.php"; ?>
  <script src="../includes/dashBoard.js"></script>

</body>

</html>