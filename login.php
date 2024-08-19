<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل دخول</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200..1000&family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
      *{
        font-family: 'cairo';
      }
      </style>
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <?php
      include "connection.php";

      if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "select * from users where email='$email'";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {

          $row = mysqli_fetch_assoc($res);

          $password = $row['password'];

          $decrypt = password_verify($pass, $password);


          if ($decrypt) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location: /web/site/index.php");

          } else {
            echo "<div class='message'>
                    <p>خطأ في كلمة المرور</p>
                    </div><br>";

            echo "<a href='login.php'><button class='btn'>الرجوع</button></a>";
          }

        } else {
          echo "<div class='message'>
                    <p>خطأ في البريد الالكتروني او كلمة المرور</p>
                    </div><br>";

          echo "<a href='login.php'><button class='btn'>الرجوع</button></a>";

        }


      } else {


        ?>

        <header>تسجيل دخول</header>
        <hr>
        <form method="POST">

          <div class="form-box">


            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="البريد الالكتروني" name="email">
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="كلمة المرور" name="password">
              <i class="fa fa-eye toggle icon"></i>
            </div>

  

          </div>


          <center><input type="submit" name="login" id="submit" value="تسجيل دخول" class="btn"></center>

          <div class="links">
            ليس لدي حساب؟ <a href="signup.php">سجل الأن</a>
          </div>

          <div class="links">
             <a href="./admin/changepass/">نسيت كلمة المرور</a>
          </div>

        </form>
      </div>
      <?php
      }
      ?>
  </div>
  <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
      }
    })
  </script>
</body>

</html>