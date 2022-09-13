<section class="home-section">
    <h2 class="page-title">DASHBOARD</h2>
    <div class="dashboard--grid--section">


      <!--------------------- WELCOME --------------------->
      <div class="grid--parts welcome grid--col--span--4" id="grid--top">
        <!-- 
        session_start();
        include "../connection/db.php";
        // $id = ;
        $sql = "SELECT fName, lName FROM dentist WHERE loginID = '" . $_SESSION['username'] . "'";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        echo "<h3 id='welcome--message'></h3> <span class='user'>$row[fName]<span>";
        $link->close();
         -->
        <p class="grid--parts--text">Do not forget to wash your hands.</p>
        <img src="../image/dentist.png" alt="Dentist" class="welcome--npc"/>
      </div>

      <!--------------------- APPOINTMENTS --------------------->
      <div class="grid--parts appointments">
        <div class="appointments--number">
          <div class="appointments--logo">
            <i class="fa-solid fa-file-medical fa-xl"></i>
          </div>
          <h3 class="appointments--output">0</h3>
        </div>
        <h4>APPOINTMENTS</h4>
        <p class="grid--parts--text">Number of appointments today.</p>
      </div>

      <!--------------------- PATIENTS --------------------->
      <div class="grid--parts patient">
        <div class="patients--number">
          <div class="patients--logo">
            <i class="fa-solid fa-user-injured fa-xl"></i>
          </div>
          <?php

          include "../connection/db.php";
          $sql = "SELECT * FROM patient";
          $result = $link->query($sql);
          // Return the number of rows in result set
          $rowcount = mysqli_num_rows($result);
          echo "<h3 class='patients--output'> $rowcount</h3>";
          $link->close();
          ?>
        </div>
        <h4>PATIENTS</h4>
        <p class="grid--parts--text">Number of patients registered under clinic.</p>
      </div>

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
      <div class="grid--parts calendar grid--col--span--4">
        <h4>CALENDAR</h4>
        <img src="../image/maintanence.svg" alt="Coming Soon!" class="coming--soon--img" />
      </div>

      <!--------------------- RIGHT BAR --------------------->
      <div class="grid--parts right--bar">
        <h4>ANNOUNCEMENTS</h4>
      </div>
    </div>
  </section>