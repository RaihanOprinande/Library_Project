<?php 

    require_once 'koneksitugas.php';

    session_start();
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        
        // $valid_email = "orry123@gmail.com";
        // $valid_password = "password";

        //query ke database
        $sql = "SELECT * FROM member WHERE email='$email' AND password='$password'";

        $result = $db->query($sql);
        $data = $result->fetch_assoc();
        //$data = mysqli_fetch_assoc($result);
        if ($result->num_rows == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['level'] = $data['level'];
            $_SESSION['login'] = true;

            header("Location: ../index.php");
        } else {
            echo '<script type="text/javascript">alert("Email dan Password Anda Salah");</script>';
            
        }
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../assets/css/style-login.css">
  <title>PERPUSTAKAAN</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me  <a href="#">Forget Password</a></label>
                      
                    </div>
                    <button type="submit" name="submit">Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="#">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>