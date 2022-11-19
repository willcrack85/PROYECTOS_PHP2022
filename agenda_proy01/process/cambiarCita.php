<?php
//* Si se intenta acceder sin haber seleccionado una cita, se regresa al index. */
if (!isset($_POST["citaSeleccionada"])) header("Location: ../index.php");
//* Se incluye el miniscript de tratamiento de fechas
include("../class/fechas.php");
//* Se incluye el miniscript que abre la base de datos.
require_once("../class/citasDB.php");
$objCitas = new citaAgenda();
//* Se leen los datos de la cita, en la tabla "citas".
$datosDeLaCita = $objCitas->mostrar_cita_seleccionada($_POST['citaSeleccionada']);
/** 
 * *La lectura anterior devuelve un cursor con un registro y solo uno, dada la cualidad de
 * *clave primaria del campo empleado en la selección.
 * */
//* Se asignan los datos actuales de la cita a variables de memoria, se libera el cursor y se cierrqa la BBDD. */
foreach ($datosDeLaCita as $value) {
    $horaActual = substr($value['horacita'], 0, 2);
    $minutoActual = substr($value['horacita'], 3, 2);
    $asuntoActual = $value['asuntocita'];
}
//* var_dump($horaActual);  //-->Usado a menudo para verificar errores en el codigo al depurar.
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Template con PHP en Proyecto #01">
    <meta name="keywords" content="HTML5, CSS, Javascript" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="WillCrack Solution Corp.">
    <meta name="generator" content="WC 01.23.1985">
    <title>Mini-Agenda DS7 - Modificar Nota</title>
    <!-- Icono de la página WEB -->
    <link rel="shortcut icon" type="image/x-ico" href="../assets/ico/favicon.ico" />
    <!-- ESTILO Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <!-- ESTILO Custom PARA LA PAGINA WEB -->
    <link rel="stylesheet" type="text/css" href="../assets/css/wcStyle2022.css">
    <!-- ESTILO PARA ALERTAS CON SWEET ALERT 2 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <!-- ESTILO FONT AWESOME VERSION 6.2.1 -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <script language="javascript" type="text/javascript">
        //* La siguiente función coloca los datos de la cita actual en los campos del formulario.*/
        function mostrarDatos() {
            document.getElementById("dia").value = "<?php echo ($diaActual); ?>";
            document.getElementById("mes").value = "<?php echo ($mesActual); ?>";
            document.getElementById("annio").value = "<?php echo ($annioActual); ?>";
            document.getElementById("hora").value = "<?php echo ($horaActual); ?>";
            document.getElementById("minutos").value = "<?php echo ($minutoActual); ?>";
            document.getElementById("asunto").value = "<?php echo ($asuntoActual); ?>";
        }
        //* La siguiente función envía el formulario a donde proceda.*/
        function mandar(resultado) {
            if (resultado) {
                document.frmNuevaCita.action = "grabarCambios.php";
            } else {
                document.frmNuevaCita.action = "../index.php";
            }
            document.frmNuevaCita.submit();
        }
    </script>
</head>

<body class="d-flex flex-column h-100" onLoad="javascript:mostrarDatos();">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark mx-bg-top-linear">
            <a class="navbar-brand text-uppercase" rel="nofollow" href="../index.php">
                <img src="../assets/ico/favicon.ico" width="32" height="32" class="d-inline-block align-top" alt="WC">
                Dev Software VII - 2022
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Reportes<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Hacer una busqueda" aria-label="Search" id="wc-center">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </nav>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">DS7 - Modificar Nota Existente</h1>
                <p class="lead">Aplicaciones web en PHP con integración a base de datos MySQL (MariaDB).</p>
                <hr class="my-4">
            </div>
        </div>
        <div class="container my-4">
            <div class="row m-1">
                <div class='jumbotron-wc1 border border-white col-md-12'>
                    <div class="text-left shadow-lg p-4 mx-2 my-2 bg-light rounded">
                        <?php
                        //* Se muestra la fecha en curso.
                        echo ("<p class='lead text-left'>NOTAS PARA EL D&Iacute;A: " . $diaActual . " del " . $mesActual . " de " . $annioActual . "</p>");
                        ?>
                        <form action="" method="post" name="frmNuevaCita" id="frmNuevaCita">
                            <input type="hidden" name="fechaEnCurso" id="fechaEnCurso" value="<?php echo ($fechaEnCurso); ?>">
                            <input type="hidden" name="citaSeleccionada" id="citaSeleccionada" value="<?php echo ($_POST['citaSeleccionada']); ?>">
                            <div class='shadow-lg px-3 my-1 bg-light rounded'>
                                <div class='table-responsive'>
                                    <table class='table table-striped table-dark'>
                                        <tr>
                                            <th>AGENDA DIGITAL 2022</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class='shadow-lg px-3 my-1 bg-light rounded'>
                                <div class="container px-2 my-4">
                                    <div class="row mb-3 px-2 my-2">
                                        <div class="col-7">
                                            <fieldset>
                                                <legend>Registro Fecha:</legend>
                                                <div class="row my-2 px-4">
                                                    <div class="input-group mb-3 px-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="igpFecha" name="fecha" id="fecha">Fecha:</label>
                                                        </div>
                                                        <select class="custom-select text-center" name="dia" id="dia">
                                                            <option selected>D&iacute;a</option>
                                                            <?php
                                                            for ($i = 1; $i <= 31; $i++) {
                                                                echo ("<option value='");
                                                                printf("%02s", $i);
                                                                echo ("'>");
                                                                printf("%02s", $i);
                                                                echo ("</option>");
                                                            }

                                                            ?>
                                                        </select>
                                                        <span class="h4 align-botton">&nbsp;/&nbsp;</span>
                                                        <select class="custom-select text-center" name="mes" id="mes"">
                                                            <option selected>Mes</option>
                                                            <option value=" 01">Enero</option>
                                                            <option value="02">Febrero</option>
                                                            <option value="03">Marzo</option>
                                                            <option value="04">Abril</option>
                                                            <option value="05">Mayo</option>
                                                            <option value="06">Junio</option>
                                                            <option value="07">Julio</option>
                                                            <option value="08">Agosto</option>
                                                            <option value="09">Septiembre</option>
                                                            <option value="10">Octubre</option>
                                                            <option value="11">Noviembre</option>
                                                            <option value="12">Diciembre</option>
                                                        </select>
                                                        <span class="h4 align-botton">&nbsp;/&nbsp;</span>
                                                        <select class="custom-select text-center" name="annio" id="annio">
                                                            <option selected>A&ntilde;o</option>
                                                            <?php
                                                            for ($i = 2000; $i <= 2030; $i++) {
                                                                echo ("<option value='");
                                                                printf("%02s", $i);
                                                                echo ("'>");
                                                                printf("%02s", $i);
                                                                echo ("</option>");
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset>
                                                <legend>Registro Fecha:</legend>
                                                <div class="row my-2 px-3">
                                                    <div class="input-group mb-3 px-3 mx-5">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="igpHora" name="igpHora" id="igpHora">Hora:</label>
                                                        </div>
                                                        <select class="custom-select text-center" name="hora" id="hora">
                                                            <option selected>HH</option>
                                                            <?php
                                                            for ($i = 0; $i < 24; $i++) {
                                                                echo ("<option value='");
                                                                printf("%02s", $i);
                                                                echo ("'>");
                                                                printf("%02s", $i);
                                                                echo ("</option>");
                                                            }

                                                            ?>
                                                        </select>
                                                        <span class="h4 align-botton">&nbsp;:&nbsp;</span>
                                                        <select class="custom-select text-center" name="minutos" id="minutos">
                                                            <option selected>MM</option>
                                                            <?php
                                                            for ($i = 0; $i < 60; $i++) {
                                                                echo ("<option value='");
                                                                printf("%02s", $i);
                                                                echo ("'>");
                                                                printf("%02s", $i);
                                                                echo ("</option>");
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm px-3 my-4">
                                            <fieldset>
                                                <legend>Asunto de la Nota:</legend>
                                                <textarea width="700px" class="form-control" name="asunto" cols="50" rows="5" id="asunto"></textarea>
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class='btn-group' role='group' aria-label='BotonesCRUD'>
                                <!-- En todo caso se mostrarán los botones de agregar una cita nueva en la agenda o cancelar proceso. -->
                                <button type="button" class="btn btn-outline-success btn-lg" name="grabarCita" id="grabarCita" onClick="javascript:mandar(true);">Grabar Cambios</button>
                                <button type="button" class="btn btn-outline-secondary btn-lg" name="anularCita" id="anularCita" onClick="javascript:mandar(false);">Descartar Cambios</button>
                            </div>
                        </form>
                    </div>
                    <hr class="my-4">
                    <blockquote class="blockquote text-center">
                        <footer class="display-4 blockquote-footer text-white">Edicion Limitada</footer>
                    </blockquote>
                </div>
            </div>
        </div> <!-- /container -->
    </main>
    <footer class="wcfooter mt-auto py-3 mx-bg-top-linear">
        <div class="container text-center">
            <span class="text-muted">
                <b>Dise&ntilde;ado por <a href="https://willcrackcorp.w3spaces.com/" title="WillCrack Solutions Corp., Panam&aacute;" target="_blank">WC Solutions Corp.</a> Copyright &copy; DS 7 - 2022 | William Miranda</b>
            </span>
        </div>
        <!-- Back to top -->
        <div id="back-to-top" class="back-to-top">
            <button class="btn btn-dark" title="Ir al Comienzo" style="display: block;">
                <i class="fa-solid fa-angle-up"></i>
            </button>
        </div>
    </footer>
</body>
<!-- CARGAR ENLACES A JAVASCRIPT -->
<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
    const wcMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    window.addEventListener('load', (event) => {
        wcMixin.fire({
            animation: true,
            title: 'Conexi&oacute;n Iniciada...',
        });
    });
    //=====================================================================//
    window.jQuery || document.write('<script src="assets/js/jquery-3.5.1.min.js"><\/script>')
</script>

</html>