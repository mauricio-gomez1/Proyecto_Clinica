<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession'])) {
    header("Location: doctor/doctordashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $doctorId = mysqli_real_escape_string($con, $_POST['doctorId']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM doctor WHERE doctorId = '$doctorId'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($row['password'] == $password) {
        $_SESSION['patientSession'] = $row['doctorId'];
        header("Location: /doctor/doctordashboard.php");
        exit;
    } else {
        echo '<script>';
        echo 'alert("Wrong input");';
        echo '</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Psicologia</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- start -->
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form class="form" role="form" method="POST" accept-charset="UTF-8">
                <input name="doctorId" type="text" placeholder="Doctor ID" required>
                <input name="password" type="password" placeholder="Password" required>
                <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
    <!-- end -->
</div>

<script src="assets/js/jquery.js"></script>

<!-- js start -->

<!-- js end -->
</body>
</html>
