<?php
include_once 'assets/conn/dbconnect.php';


session_start();
if (isset($_SESSION['doctorSession'])) {
    header("Location: doctor/doctordashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $doctorId = mysqli_real_escape_string($con, $_POST['doctorId']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM doctor WHERE doctorId = '$doctorId'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['doctorSession'] = $row['doctorId'];
        ?>
        <script type="text/javascript">
            alert('Login Success');
        </script>
<?php
        header("Location: /doctor/doctordashboard.php");
        exit();
    } else {
?>
        <script type="text/javascript">
            alert("Wrong input");
        </script>
<?php
    }
}
?>