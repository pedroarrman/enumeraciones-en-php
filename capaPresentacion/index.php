<?php
/** Incluye la clase Registro. */
include '../capaNegocio/registro.php';
?>
<!--
    * index.php
    * Módulo de gestión de los registros.
-->
<!DOCTYPE html>

<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de Registros</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">

    </head>
    <body>

        <?php
        /** @var Registro Instancia un objeto de la clase. */
        $registro = new Registro();
        if (isset($_POST['añadir'])) {
            ?> 
            <h4>Gestión de Registros ©  <?php echo date("Y"); ?></h4>
            <div class="container mt-5">
                <div class="row">
                    <!-- Formulario de Registro -->
                    <div class="col-md-6">
                        <form action="añadeRegistro.php" method="post">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nombre:</label>
                                <div class="col-sm-9">                            
                                    <input type="text" name="nombre" size="10">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">apellidos:</label>
                                <input type="text" name="apellidos" size="40">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Estado:</label>
                        <div class="col-sm-9">
                            <select name="estado" class="form-control">
                                <option value="solter@">solter@</option>
                                <option value="casad@">casad@</option>
                                <option value="divorciad@">divorciad@</option>
                            </select>       
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Fecha de Nacimiento*:</label>
                        <div class="col-sm-9">
                            <input type="text" name="fechaNacimiento" class="form-control" size="50">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">sexo:</label>
                        <div class="col-sm-9">
                            <select name="estado" class="form-control">
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                                <option value="O">Otro</option>
                            </select>       
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <input class="boton" type="submit" 
                                   value="Registrar">
                            <input class="boton" type="button"
                                   value="Volver"
                                   onClick="javascript:window.history.back()">
                        </div>
                    </div>
                    </form>
                    <?php
                }

                if (isset($_POST['modificar'])) {
                    /** Inicializa los atributos del objeto. */
                    $registro->setIdUsuario($_POST['idUsuario']);
                    $registro->setApellidos($_POST['apellidos']);
                    $registro->setEstado($_POST['estado']);
                    /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                    $fechaNacimiento = explode('/', $_POST['fechaNacimiento']);
                    $registro->setFechaNacimiento(new DateTime($fechaNacimiento[2] . '-' .
                                    $fechaNacimiento[1] . '-' . $fechaNacimiento[0]));
                    $registro->setSexo($_POST['sexo']);
                    /** Modifica los datos del registro. */
                    if ($registro->modificaRegistro()) {
                        /** Datos del registro modificados correctamente. */
                        echo '<h4>El registro ha sido modificado con éxito</h4>';
                    } else {
                        /** Error al modificar los datos del registro. */
                        echo '<h5>Error al modificar los datos del registro</h5>';
                    }
                    ?>
                    <!-- Muestra el botón de volver. -->
                    <form action="index.php" method="post">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <input class="boton" type="submit"
                                       value="Volver">
                            </div>
                        </div>    
                    </form>
                    <?php
                }

                if (isset($_POST['eliminar'])) {
                    /** Inicializa los atributos del objeto. */
                    $registro->setIdUsuario($_POST['idUsuario']);
                    $registro->setApellidos($_POST['apellidos']);
                    $registro->setEstado($_POST['estado']);
                    /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                    $fechaNacimiento = explode('/', $_POST['fechaNacimiento']);
                    $registro->setFechaNacimiento(new DateTime($fechaNacimiento[2] . '-' .
                                    $fechaNacimiento[1] . '-' . $fechaNacimiento[0]));
                    $registro->setSexo($_POST['sexo']);

                    $registro->leeRegistro();
                    echo '<h4>El registro está siendo elimado</h4>';
                    /** Muestra un formulario de confirmación. */
                    ?>
                    <form action="eliminaTarea.php" method="post">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <label class="col-sm-3 col-form-label">¿Estás seguro de eliminar el registro que pertenece a 
                                    <?php echo $registro->getNombre() . '' . $registro->getApellidos(); ?>?</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <input type="text" name="idTarea"
                                       value="<?php echo $_POST['idTarea']; ?>">
                                <input class="boton" type="submit" 
                                       name="eliminar"
                                       value="Eliminar">
                                <input class="boton" type="button"
                                       value="Cancelar"
                                       onClick="javascript:window.history.back();">                                
                            </div>                                
                        </div>                        
                    </form>
                    <?php
                }
                ?>    
    </body>
</html>


