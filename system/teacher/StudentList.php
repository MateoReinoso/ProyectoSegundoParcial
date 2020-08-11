<?php 
include '../sql_connection/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Lista de Estudiantes</title>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php include "menu/sidebar.php" ?>
    <section class="full-box dashboard-contentPage">
        <?php include "../includes/navbar.php" ?>
        <div class="container-fluid">
            <h1>Lista de Estudiantes</h1>
            <hr>
            <table>
                <tr>
                    <th>Periodo Electivo</th>
                    <th>Numero de Aula</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                </tr>

                <?php
                    $valor = 1920;
            
                   
                    $query = mysqli_query($connection, "SELECT aap.COD_PERIODO_LECTIVO, ap.COD_AULA, p.APELLIDO, p.NOMBRE FROM alumno_asignatura_periodo aap, asignatura_periodo ap, persona p
                    WHERE ap.COD_DOCENTE = aap.COD_DOCENTE
                    AND p.COD_PERSONA = aap.COD_ALUMNO
                    AND aap.COD_PERIODO_LECTIVO = '$valor'
                    ORDER BY APELLIDO ASC");

                    $result = mysqli_num_rows($query);

                    if ($result > 0) {
                        
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                <tr>
                    <td> <?php echo $data["COD_PERIODO_LECTIVO"] ?> </td>
                    <td> <?php echo $data["COD_AULA"] ?> </td>
                    <td> <?php echo $data["APELLIDO"] ?> </td>
                    <td> <?php echo $data["NOMBRE"] ?> </td>
                </tr>
                <?php
                        }
                    }
                ?>


            </table>
        </div>
    </section>
</body>

</html>