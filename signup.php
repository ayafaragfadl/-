<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل</title>
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


      <header>تسجيل</header>
      <hr>

      <form method="POST">


        <div class="form-box">

          <?php

          session_start();

          include "connection.php";

          if (isset($_POST['register'])) {

            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];


            $check = "select * from users where email='{$email}'";

            $res = mysqli_query($conn, $check);

            $passwd = password_hash($pass, PASSWORD_DEFAULT);
            $key = bin2hex(random_bytes(12));




            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
        <p>هذا البريد الالكتروني مستخدم من قبل</p>
        </div><br>";

              echo "<a href='javascript:self.history.back()'><button class='btn'>الرجوع للخلف</button></a>";


            } else {

              if ($pass === $cpass) {

                $sql = "insert into users(username,email,password) values('$name','$email','$passwd')";

                $result = mysqli_query($conn, $sql);

                if ($result) {

                  echo "<div class='message'>
      <p>تم التسجيل بنجاح</p>
      </div><br>";

                  echo "<a href='login.php'><button href='login.php' class='btn'>تسجيل دخول</button></a>";

                } else {
                  echo "<div class='message'>
        <p>هذا البريد الالكتروني مستخدم من قبل </p>
        </div><br>";

                  echo "<a href='javascript:self.history.back()'><button class='btn'>الرجوع</button></a>";
                }

              } else {
                echo "<div class='message'>
      <p>كلمة المرور غير متطابقه</p>
      </div><br>";

                echo "<a href='signup.php'><button class='btn'>الرجوع</button></a>";
              }
            }
          } else {

            ?>

            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="الاسم" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="البريد الالكتروني" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="text" placeholder="كلمة المرور" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="تاكيد كلمة المرور" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>

          </div>


          <center><input type="submit" name="register" id="submit" value="تسجيل" class="btn"></center>


          <div class="links">
            بالفعل لدي حساب؟ <a href="login.php">تسجيل دخول</a>
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