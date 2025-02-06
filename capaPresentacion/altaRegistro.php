<?php
/** Incluye la clase. */
include '../capaNegocio/registro.php';
?>
<!--
        * eliminaRegistro.php
        * Modulo secundario que elimina un registro.
-->
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminacion de Registros</title>
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

        <h4>Eliminación de Registros ©  <?php echo date("Y"); ?></h4>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    /** Si todos los campos del formulario tienen algun valor... */
                    if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) &&
                            !empty($_POST['estado']) &&
                            !empty($_POST['fechaNacimiento']) &&
                            !empty($_POST['sexo'])) {

                        /** @var Registro Instancia un objeto de la clase. */
                        $registro = new Registro();
                        /** Inicializa los atributos del objeto. */
                        $registro->setIdUsuario($_POST['idUsuario']);
                        $registro->setNombre($_POST['nombre']);
                        $registro->setApellidos($_POST['apellidos']);
                        $registro->setEstado($_POST['estado']);
                        /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                        $fechaNacimiento = explode('/', $_POST['fechaNacimiento']);
                        $registro->setFechaNacimiento(new DateTime($fechaNacimiento[2] . '-' . $fechaNacimiento[1] . '-' . $fechaNacimiento[0]));
                        $registro->setSexo($_POST['sexo']);

                        /** Almacena el registro y comprueba error. */
                        if ($registro->almacenaregistro()) {

                            /** La registro se ha registrado correctamente. */
                            echo '<h4>El registro ha sido añadido con exito</h4>';
                        } else {
                            /** Se ha producido un error al registrar la registro. */
                            echo '<h5>Error al añadir el registro</h5>';
                        }
                    } else {
                        /** Se ha producido un error al añadir el registro. */
                        echo "<h5>Error al añadir el registro
                      <br>Todos los campos son obligatorios</h5>";
                    }
                    ?>
                    <!-- Muestra el boton de volver. -->
                    <form action="index.php" method="post">

                        <input class="boton" type="submit" value="Volver">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
