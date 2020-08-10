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
                <div class="alert"></div>
                <form action="">
                    <label for="cod_nivel">Código del Nivel Educativo</label>
                    <input type="text" name="cod_nivel" id="cod_nivel" placeholder="Nivel Educativo">
                    <label for="cod_asignatura">Código de Asignatura</label>
                    <input type="text" name="cod_asignatura" id="cod_asignatura" placeholder="Codigo de Asignatura">
                    <label for="cod_periodo">Código del Periodo Electivo</label>
                    <input type="text" name="cod_periodo" id="cod_periodo" placeholder="Periodo Electivo">
                    <label for="cod_paralelo">Código del Paralelo</label>
                    <input type="text" name="cod_paralelo" id="cod_paralelo" placeholder="Código de Paralelo">
                    <label for="cod_docente">Código de Docente</label>
                    <input type="text" name="cod_docente" id="cod_docente" placeholder="Código Docento">
                    <label for="cod_tarea">Descripcion de Tarea</label>
                    <input type="text" name="cod_tarea" id="cod_tarea" placeholder="Descripcion de Tarea">

                    <input type="submit" value="Registrar Tarea" class="btn_save">
                    
                </form>
            </div>

        </div>
    </section>
</body>

</html>