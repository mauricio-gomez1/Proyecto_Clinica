<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['appid'])) {
$appid=$_GET['appid'];
}
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
JOIN appointment b
On a.icPatient = b.patientIc
JOIN doctorschedule c
On b.scheduleId=c.scheduleId
WHERE b.appId  =".$appid);

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/img/logo.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td>
                                    #: <?php echo $userRow['appId'];?><br>
                                    Creada: <?php echo date("d-m-Y");?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <h2>Direccion de tu empresa</h2>
                                </td>
                                
                                <td><?php echo $userRow['patientIc'];?><br>
                                    <?php echo $userRow['patientFirstName'];?> <?php echo $userRow['patientLastName'];?><br>
                                    <?php echo $userRow['patientEmail'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td>
                        Detalles de la cita
                    </td>
                    
                    <td>
                        #
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        Costo
                    </td>
                    
                    <td>
                       $ 300
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Dia de la cita
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDay'];?>
                    </td>
                </tr>
        
                 <tr class="item">
                    <td>
                        Fecha de la cita
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Hora de la cita
                    </td>
                    
                    <td>
                        <?php echo $userRow['startTime'];?> a <?php echo $userRow['endTime'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Sintomas
                    </td>
                    
                    <td>
                        <?php echo $userRow['appSymptom'];?> 
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Comentarios 
                    </td>
                    
                    <td>
                        <?php echo $userRow['appComment'];?>
                    </td>
                </tr>
                
                
                
            </table>
        </div>
        <div class="print">
        <button onclick="myFunction()">Imprimir esta pagina</button>
</div>
<script>
function myFunction() {
    window.print();
}
</script>
    </body>
</html>