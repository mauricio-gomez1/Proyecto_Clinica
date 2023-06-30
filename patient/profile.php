<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (!isset($_SESSION['patientSession'])) {
    header("Location: ../index.php");
}

$res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=" . $_SESSION['patientSession']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $patientMaritialStatus = $_POST['patientMaritialStatus'];
    $patientDOB = $_POST['patientDOB'];
    $patientGender = $_POST['patientGender'];
    $patientAddress = $_POST['patientAddress'];
    $patientPhone = $_POST['patientPhone'];
    $patientEmail = $_POST['patientEmail'];

    $query = "UPDATE patient SET patientMaritialStatus='$patientMaritialStatus', patientDOB='$patientDOB', patientGender='$patientGender', patientAddress='$patientAddress', patientPhone='$patientPhone', patientEmail='$patientEmail' WHERE icPatient=" . $_SESSION['patientSession'];

    $res = mysqli_query($con, $query);

    if ($res) {
        header('Location: profile.php');
    } else {
        echo "Error en la actualización de datos: " . mysqli_error($con);
    }
}

$male = "";
$female = "";
if ($userRow['patientGender'] == 'male') {
    $male = "checked";
} elseif ($userRow['patientGender'] == 'female') {
    $female = "checked";
}

$single = "";
$married = "";
$separated = "";
$divorced = "";
$widowed = "";
if ($userRow['patientMaritialStatus'] == 'single') {
    $single = "checked";
} elseif ($userRow['patientMaritialStatus'] == 'married') {
    $married = "checked";
} elseif ($userRow['patientMaritialStatus'] == 'separated') {
    $separated = "checked";
} elseif ($userRow['patientMaritialStatus'] == 'divorced') {
    $divorced = "checked";
} elseif ($userRow['patientMaritialStatus'] == 'widowed') {
    $widowed = "checked";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>PsychoTech</title>
		<!-- Bootstrap -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
	</head>
	<body>
		
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logoddd.png" height="40px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">Inicio</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Mis Citas</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> Citas</a>
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
								<img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" class="img-responsive" />
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									<p>
										Bienvenido a tu perfil.
									</p>
									<hr />
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Actualizar Perfil</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?> </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
												
												<tr>
													<td>Estado Civil</td>
													<td><?php echo $userRow['patientMaritialStatus']; ?></td>
												</tr>
												<tr>
													<td>Fecha de nacimiento</td>
													<td><?php echo $userRow['patientDOB']; ?></td>
												</tr>
												<tr>
													<td>Genero</td>
													<td><?php echo $userRow['patientGender']; ?></td>
												</tr>
												<tr>
													<td>Direccion</td>
													<td><?php echo $userRow['patientAddress']; ?>
													</td>
												</tr>
												<tr>
													<td>Numero</td>
													<td><?php echo $userRow['patientPhone']; ?>
													</td>
												</tr>
												<tr>
													<td>Email</td>
													<td><?php echo $userRow['patientEmail']; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Actualizar datos personales</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>Cuenta: </td>
														<td><?php echo $userRow['icPatient']; ?></td>
													</tr>
													<tr>
														<td>Nombre: </td>
														<td><?php echo $userRow['patientFirstName']; ?></td>
													</tr>
													<tr>
														<td>Apellido: </td>
														<td><?php echo $userRow['patientLastName']; ?></td>
													</tr>
													
													<!-- radio button -->
													<tr>
														<td>Estado Civil:</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="single" <?php echo $single; ?>>Soltero</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="married" <?php echo $married; ?>>Casado</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="separated" <?php echo $separated; ?>>Separado</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="divorced" <?php echo $divorced; ?>>Divorciado</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="widowed" <?php echo $widowed; ?>>Viudo</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													<tr>
														<td>Fecha de nacimiento</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?> "  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="patientDOB" name="patientDOB" placeholder="YYYY/MM/DD" type="text" value="<?php echo $userRow['patientDOB']; ?>"disabled/>
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td>Genero</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="male" <?php echo $male; ?> disabled>Hombre</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="female" <?php echo $female; ?> disabled>Mujer</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td>Numero de telefono</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>Direccion</td>
														<td><textarea class="form-control" name="patientAddress"  ><?php echo $userRow['patientAddress']; ?></textarea></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Actualizar Informacion"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			
			<script type="text/javascript">
														$(function () {
														$('#patientDOB').datetimepicker();
														});
														</script>
		</body>
	</html>