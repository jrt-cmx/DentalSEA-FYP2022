<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="author" content="Kodinger" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>DENTALSEA | Select location</title>
  <link rel="stylesheet" href="css/loginCSS.css" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <dialog class="modal" id="modal">
    <h3 class="modal--logo">
      <i class="fa-solid fa-tooth"></i>DentalSEA
    </h3>
    <h2 class="modal--title">Clinic Selection</h2>
    <form method="POST" name="log--in--form" class="modal--form needs-validation" novalidate="" autocomplete="off" onsubmit="return validateForm()" action="verify/verifyIndex.php">
      <div class="modal--form--section">
        <div class="form--label--section">
          <label class="form--label" for="loginid">Username</label>
          <span id="loginid--error--message"></span>
        </div>
        <input id="loginid" class="form--input--text" name="loginid" value="" placeholder="Username" required />
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="modal--form--section">
        <div class="form--label--section">
          <label class="form--label" for="password">Password</label>
          <span id="password--error--message"></span>
        </div>
        <input oninput="displayShowPasswordIcon();" id="password" type="password" class="form--input--text" name="password" placeholder="Password" required />
        <i class="fa-solid fa-lock"></i>
        <i onclick="displayPassword()" class="fa-solid fa-eye" id="password--toggle"></i>
      </div>
      <div class="modal--form--section">
        <div class="form--label--section">
          <label class="form--label" for="dbSelection">Clinic</label>
          <span id="clinic--error--message"></span>
        </div>
        <input id="dbSelection" type="text" class="form--input--text" name="dbSelection" placeholder="Clinic" required />
        <i class="fa-solid fa-house-medical"></i>
      </div>
      <button type="submit" class="form--btn--access">Sign in</button>
    </form>
  </dialog>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <script src="javascript/indexNLogin.js"></script>
</body>

</html>