<?php
    include '../sql_connection/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tareas Pendientes</title>
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
            <section id="container">
                <div class="form_register">
                    <h1>Tareas por Realizar</h1>
                    <hr>
                    <form action="" method="post">
                        <label for="rol">Materia</label>
                        <input type="text" name="rol" id="rol">
                        <input type="submit" value="Consultar">
                       
                    </form>
                    
                    <hr>
                    <table>
                        <tr>
                            <TH>Codigo</TH>
                            <th>Materia</th>
                            <th>Detalles</th>
                        </tr>
                        
                        <?php
                        $valor = 5;
                        $mate = 'Lenguaje';
                                $query = mysqli_query($connection, "SELECT  a.COD_ASIGNATURA, a.NOMBRE, ta.DETALLE_TAREA 
                                FROM tarea_asignatura ta, alumno_asignatura_periodo aap, usuario u, asignatura a
                                WHERE a.NOMBRE = '$mate'
                                AND aap.COD_ALUMNO = '$valor'
                                AND u.COD_PERSONA = '$valor'");

                            $resul = mysqli_num_rows($query);

                            if ($resul > 0) {
                                while ($data = mysqli_fetch_array($query)) {
                                    ?>
                        <tr>
                            <td><?php echo $data["COD_ASIGNATURA"] ?></td>
                            <td><?php echo $data["NOMBRE"] ?></td>
                            <td><?php echo $data["DETALLE_TAREA"] ?></td>
                        </tr>
                        <?php 
                                }
                            }

                        ?>
                    </table>
                </div>
            </section>

        </div>
    </section>
</body>

</html>