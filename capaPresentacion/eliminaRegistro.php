<?php
/** Incluye la clase. */
include '../capaNegocio/registro.php';
?>
<!--
        * eliminaRegistro.php
        * Módulo secundario que elimina un registro.
-->
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminación de Registros</title>
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
                    /** Si todos los campos del formulario tienen algún valor... */
                    if (!empty($_POST['eliminar'])) {
                        /** @var Registro Instancia un objeto de la clase Registro. */
                        $registro = new Registro();
                        /** Inicializa los atributos del objeto. */
                        $registro->setIdUsuario($_POST['idUsuario']);
                        /** Comprueba la eliminación... */
                        if ($registro->eliminaRegistro()) {
                            /** Registro eliminado correctamente. */
                            echo '<h4>El registro ha sido eliminado con éxito</h4>';
                        } else {
                            /** Error al eliminar el registro. */
                            echo '<h5>Error al eliminar el registro</h5>';
                        }
                    } else {
                        /** El registro debe estar seleccionado. */
                        echo "<h5>Debes seleccionar un registro válido</h5>";
                    }
                    ?>
                    <!-- Muestra el botón de volver. -->
                    <form action="index.php" method="post">

                        <input class="boton" type="submit" value="Volver">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
