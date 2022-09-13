<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <?php include '/demtist/includes/head.php'; ?>
  <body>
    <!-- ---------- HEADER ---------- -->
    <header class="header" id="header">
      <div class="page-title">
        <h2>Patients</h2>
      </div>
      <div class="header_img">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <i class="fa-solid fa-circle-user fa-xl"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
      </div>
    </header>

    <!-- ---------- SIDE BAR ---------- -->
    <div class="sidebar">
      <div class="logo-details">
        <i class="fa-solid fa-tooth"></i>
        <div class="logo_name">DentalSEA</div>
        <i class="fa-solid fa-teeth" id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
          <a href="#">
            <i class="bi bi-grid-fill"></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <!-- <li>
          <a href="#">
            <i class="fa-solid fa-calendar-days"></i>
            <span class="links_name">Appointments</span>
          </a>
          <span class="tooltip">Appointments</span>
        </li> -->
        <li>
          <a href="#">
            <i class="fa-solid fa-address-book"></i>
            <span class="links_name">Patients</span>
          </a>
          <span class="tooltip">Patients</span>
        </li>
      </ul>
    </div>

    <section class="home-section">
      <div class="text"></div>
    </section>

    <script src="../dentist/sideBarJS.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
      integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>