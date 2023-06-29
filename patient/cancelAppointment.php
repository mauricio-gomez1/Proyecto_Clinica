<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (isset($_GET['appid'])) {
    $appId = $_GET['appid'];

    // Realiza la lógica para cancelar la cita y hacerla disponible nuevamente
    // Por ejemplo, puedes ejecutar una consulta SQL para actualizar el estado de la cita

    $query = "UPDATE appointment SET status = 'Disponible' WHERE appId = $appId";
    $result = mysqli_query($con, $query);

    if ($result) {
        // La cita se canceló correctamente, redirecciona al usuario a la página de citas
        header("Location: patientapplist.php?patientId=".$_SESSION['patientSession']);
    } else {
        // Ocurrió un error al cancelar la cita, puedes mostrar un mensaje de error o realizar alguna otra acción
        echo "Error al cancelar la cita.";
    }
}
?>
