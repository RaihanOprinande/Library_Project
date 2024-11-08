<?php
session_start();
require 'koneksitugas.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    // $valid_email = "andi@gmail.com";
    // $valid_passw = "123";

    //query ke database
    $sql = "SELECT * FROM staff WHERE email='$email' AND password='$password'";

    $result = $db->query($sql);
    $data=$result->fetch_assoc();
    //$data=$mysqli_fetch_assoc($result);

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $data['level'];
        $_SESSION['loginmhs'] = TRUE;
        header("Location: index.php");
    }else{
        echo "Login Gagal!";
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>

   <div class="container col-lg-4 mx-auto mt-4">
        <h1>Login Form</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email"
                aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Log In">
        </form>
   </div> 

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
