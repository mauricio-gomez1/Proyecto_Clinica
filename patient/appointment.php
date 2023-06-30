<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session = $_SESSION['patientSession'];
$appid = null;
$appdate = null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
    $appdate = $_GET['scheduleDate'];
    $appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con, "SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.icPatient=$session");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);


//INSERT
if (isset($_POST['appointment'])) {
    $patientIc = mysqli_real_escape_string($con, $userRow['icPatient']);
    $scheduleid = mysqli_real_escape_string($con, $appid);
    $symptom = mysqli_real_escape_string($con, $_POST['symptom']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    $avail = "no disponible";


    $query = "INSERT INTO appointment (patientIc, scheduleId, appSymptom, appComment)
VALUES ('$patientIc', '$scheduleid', '$symptom', '$comment') ";

    //update table appointment schedule
    $sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid";
    $scheduleres = mysqli_query($con, $sql);
    if ($scheduleres) {
        $btn = "disable";
    }


    $result = mysqli_query($con, $query);
    if ($result) {
        ?>
        <script type="text/javascript">
            alert('Cita realizada con éxito.');
        </script>
        <?php
        header("Location: patient.php");
        exit;
    } else {
        echo mysqli_error($con);
        ?>
        <script type="text/javascript">
            alert('Hubo un error. Por favor inténtalo de nuevo.');
        </script>
        <?php
        header("Location: patient/patient.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>PsychoTech</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/default/style.css" rel="stylesheet">
    <link href="assets/css/default/blocks.css" rel="stylesheet">


    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
</head>
<body>
<!-- navigation -->
<nav class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo.png" height="40px"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <ul class="nav navbar-nav">
                    <li><a href="patient.php">Inicio</a></li>
                    <li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Mis Citas</a>
                    </li>
                </ul>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?>
                        <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i
                                        class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i
                                        class="glyphicon glyphicon-file"></i> Mis Citas</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- navigation -->
<div class="container">
    <section style="padding-bottom: 50px; padding-top: 50px;">
        <div class="row">
            <!-- start -->
            <!-- USER PROFILE ROW STARTS-->
            <div class="row">
                <div class="col-md-3 col-sm-3">

                    <div class="user-wrapper">
                        <img src="https://w7.pngwing.com/pngs/741/68/png-transparent-user-computer-icons-user-miscellaneous-cdr-rectangle-thumbnail.png"
                             class="img-responsive"/>
                        <div class="description">
                            <h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
                            <p>
                                Ya estás en el último paso para agendar tu cita. Por favor, rellena el formulario de la derecha para completar tu cita.
                            </p>
                            <hr/>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal">Actualizar Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9  user-wrapper">
                    <div class="description">


                        <div class="panel panel-default">
                            <div class="panel-body">


                                <form class="form" role="form" method="POST" accept-charset="UTF-8">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Informacion del paciente</div>
                                        <div class="panel-body">

                                            Nombre del Paciente: <?php echo $userRow['patientFirstName'] ?>
                                            <?php echo $userRow['patientLastName'] ?><br>
                                            Cuenta: <?php echo $userRow['icPatient'] ?><br>
                                            Numero de telefono: <?php echo $userRow['patientPhone'] ?><br>
                                            Email: <?php echo $userRow['patientEmail'] ?><br>
                                            Direccion: <?php echo $userRow['patientAddress'] ?><br>

                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Informacion de la cita</div>
                                        <div class="panel-body">

                                            Fecha: <?php echo $userRow['scheduleDate'] ?><br>
                                            Hora: <?php echo $userRow['scheduleTime'] ?><br>
                                            Doctor: <?php echo $userRow['doctorFirstName'] ?>
                                            <?php echo $userRow['doctorLastName'] ?><br>
                                            Especialidad: <?php echo $userRow['doctorSpecialization'] ?><br>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">

                                        <div class="form-group">
                                            <input type="text" name="symptom" id="symptom" class="form-control input-sm"
                                                   placeholder="Síntomas" required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="comment" id="comment" class="form-control input-sm"
                                                      placeholder="Comentario" required></textarea>
                                        </div>

                                        <input type="submit" name="appointment" value="Confirmar Cita"
                                               class="btn btn-info btn-block">

                                    </div>


                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- USER PROFILE ROW END-->
        </div>
        <!-- /.container -->

        <script src="assets/js/jquery-1.11.1.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
