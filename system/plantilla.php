<!DOCTYPE html>
<html lang="es">

<head>
    <title>Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php include "menu_plantilla/sidebar.php" ?>
    <section class="full-box dashboard-contentPage">
        <?php include "includes/navbar.php" ?>
        <!-- A PARTIR DE AQUI CREAR CONTENIDO DE LA PAGINA-->
        <h1>Tabla para registros ejemplo</h1>
        <div class="container-fluid">  <!-- TODO EL CONTENIDO POR SECCIONES DEBE ESTAR DENTRO DE ESTE DIV CON ESA CLASS CONTAINER-->
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Actualizar</th>
                        <th class="text-center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Carlos</td>
                        <td>Alfaro</td>
                        <td>El Salvador</td>
                        <td>carlos@gmail.com</td>
                        <td>+50312345678</td>
                        <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                        <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alicia</td>
                        <td>Melendez</td>
                        <td>El Salvador</td>
                        <td>alicia@gmail.com</td>
                        <td>+50312345678</td>
                        <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                        <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sarai</td>
                        <td>Lopez</td>
                        <td>El Salvador</td>
                        <td>sarai@gmail.com</td>
                        <td>+50312345678</td>
                        <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                        <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Alba</td>
                        <td>Bonilla</td>
                        <td>El Salvador</td>
                        <td>alba@gmail.com</td>
                        <td>+50312345678</td>
                        <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                        <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h1>Formularios ejemplo</h1>
        <div class="container-fluid">
            <form action="">
                <div class="form-group label-floating">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Apellido</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Dirección</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Teléfono</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">Imagen</label>
                    <div>
                        <input type="text" readonly="" class="form-control" placeholder="Browse...">
                        <input type="file">
                    </div>
                </div>
                <p class="text-center">
                    <button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
            </form>
        </div>

    </section>
</body>

</html>