<?php
    if (!empty($_POST)) {
        $alert='';
        if (empty($_POST['COD_NIVEL_EDUCATIVO']) || empty($_POST['COD_TAREA']) || empty($_POST['COD_ASIGNATURA']) || empty($_POST['COD_PERIODO_LECTIVO']) || empty($_POST['COD_DOCENTE']) || empty($_POST['COD_PARALELO']) || empty($_POST['DETALLE_TAREA'])) {
            $alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
        }else {
            include '../sql_connection/conexion.php';

            $niveleducativo = $_POST['COD_NIVEL_EDUCATIVO'];
            $tarea = $_POST['COD_TAREA'];
            $asignatura = $_POST['COD_ASIGNATURA'];
            $periodo = $_POST['COD_PERIODO_LECTIVO'];
            $paralelo = $_POST['COD_PARALELO'];
            $docente = $_POST['COD_DOCENTE'];
            $detalle = $_POST['DETALLE_TAREA'];
            
            // echo "SELECT * FROM tarea_asignatura WHERE COD_TAREA = '$tarea'";
            $query = mysqli_query($connection, "SELECT * FROM tarea_asignatura WHERE COD_TAREA = '$tarea'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert ='<p class="msg_error">Tarea ya existente</p>';
            }else {
                $query_insert = mysqli_query($connection, "INSERT INTO tarea_asignatura(COD_TAREA,COD_ASIGNATURA,COD_NIVEL_EDUCATIVO,COD_PERIODO_LECTIVO,COD_DOCENTE,COD_PARALELO,DETALLE_TAREA) 
                                                            VALUES ('$tarea','$asignatura', '$niveleducativo', '$periodo', '$docente', '$paralelo', '$detalle')");
                
                if ($query_insert) {
                    $alert ='<p class="msg_save">Tarea asignada</p>';
                }else {
                    $alert ='<p class="msg_save">No se pudo crear la taraea </p>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Asignacion de Tareas</title>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php include "menu/sidebar.php" ?>
    <section class="full-box dashboard-contentPage">
        <?php include "../includes/navbar.php" ?>
        <!-- A PARTIR DE AQUI CREAR CONTENIDO DE LA PAGINA-->

        <div class="container-fluid">

            <div class="form_register">
                <h1>Asignación de Tareas</h1>
                <hr>
                <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>
                
                <form action="" method="post">
                    <label for="COD_NIVEL_EDUCATIVO">Código del Nivel Educativo</label>
                    <input type="text" name="COD_NIVEL_EDUCATIVO" id=COD_NIVEL_EDUCATIVO" placeholder="Nivel Educativo">
                    <label for="COD_TAREA">Código de Tarea</label>
                    <input type="text" name="COD_TAREA" id="COD_TAREA" placeholder="Codigo de Tarea">
                    <label for="COD_ASIGNATURA">Código de Asignatura</label>
                    <input type="text" name="COD_ASIGNATURA" id="COD_ASIGNATURA" placeholder="Codigo de Asignatura">
                    <label for="COD_PERIODO_LECTIVO">Código del Periodo Electivo</label>
                    <input type="text" name="COD_PERIODO_LECTIVO" id="COD_PERIODO_LECTIVO" placeholder="Periodo Electivo">
                    <label for="COD_PARALELO">Código del Paralelo</label>
                    <input type="text" name="COD_PARALELO" id="COD_PARALELO" placeholder="Código de Paralelo">
                    <label for="COD_DOCENTE">Código de Docente</label>
                    <input type="text" name="COD_DOCENTE" id="COD_DOCENTE" placeholder="Código Docento">
                    <label for="DETALLE_TAREA">Descripcion de Tarea</label>
                    <input type="text" name="DETALLE_TAREA" id="DETALLE_TAREA" placeholder="Descripcion de Tarea">

                    <input type="submit" value="Registrar Tarea" class="btn_save">

                </form>
            </div>

        </div>
    </section>
</body>

</html>