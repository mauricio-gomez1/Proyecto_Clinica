<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (isset($_GET['appid'])) {
    $appId = $_GET['appid'];

    // Obtén la información de la cita antes de eliminarla
    $query = "SELECT * FROM appointment WHERE appId = $appId";
    $result = mysqli_query($con, $query);
    $appointment = mysqli_fetch_array($result);

    // Elimina la cita de la tabla appointment
    $deleteQuery = "DELETE FROM appointment WHERE appId = $appId";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        // Actualiza el campo bookAvail en la tabla doctorschedule
        $scheduleId = $appointment['scheduleId'];
        $updateQuery = "UPDATE doctorschedule SET bookAvail = 'available' WHERE scheduleId = $scheduleId";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            // La cita se canceló correctamente y el campo bookAvail se actualizó, redirecciona al usuario a la página de citas
            header("Location: patientapplist.php?patientId=".$_SESSION['patientSession']);
        } else {
            // Ocurrió un error al actualizar el campo bookAvail, puedes mostrar un mensaje de error o realizar alguna otra acción
            echo "Error al actualizar el campo bookAvail.";
        }
    } else {
        // Ocurrió un error al eliminar la cita, puedes mostrar un mensaje de error o realizar alguna otra acción
        echo "Error al cancelar la cita.";
    }
}
?>
