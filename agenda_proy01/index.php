<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- <meta charset='UTF-8'> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Template con PHP en Proyecto #01">
    <meta name="keywords" content="HTML5, CSS, Javascript" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="WillCrack Solution Corp.">
    <meta name="generator" content="WC 01.23.1985">
    <title>Mini-Agenda DS7 - 2022</title>
    <!-- Icono de la página WEB -->
    <link rel="shortcut icon" type="image/x-ico" href="assets/ico/favicon.ico" />
    <!-- ESTILO Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- ESTILO Custom PARA LA PAGINA WEB -->
    <link rel="stylesheet" type="text/css" href="assets/css/wcStyle2022.css">
    <!-- ESTILO PARA ALERTAS CON SWEET ALERT 2 -->
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
    <!-- ESTILO FONT AWESOME VERSION 6.2.1 -->
    <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">
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
        //? Las siguiente función de JavaScript envía el formulario a la página que corresponda al botón pulsado.
        function saltar(pagina) {
            document.frmCitasInicio.action = "/codephp/DSVII/PROYECTOS_ds7_PHP2022/agenda_proy01/process/" + pagina;
            document.frmCitasInicio.submit();
        }
        //? Aquí termina la función de envío del formulario.
    </script>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark mx-bg-top-linear">
            <a class="navbar-brand text-uppercase" rel="nofollow" target="_blank" href="#">
                <img src="assets/ico/favicon.ico" width="32" height="32" class="d-inline-block align-top" alt="Logo">
                Dev Software VII - 2022
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">REPORTES<span class="sr-only">(current)</span></a>
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
                <h1 class="display-3">DS7 - Proyecto No. 01</h1>
                <p class="lead">Aplicaciones web en PHP con integración a base de datos MySQL (MariaDB).</p>
                <hr class="my-4">
            </div>
        </div>
        <div class="container-fluid px-4 my-4">
            <div class="row m-1">
                <div class='jumbotron-wc1 border border-white col-md-12'>
                    <div class="text-left shadow-lg p-4 mx-2 my-2 bg-light rounded">
                        <?php
                        require_once("class/citasDB.php");
                        include("class/fechas.php");                                    //* Se incluye el miniscript de tratamiento de fechas
                        $objCitas = new citaAgenda();
                        $listaCitas = $objCitas->listar_citas_hoy($fechaEnCurso);       //* Se ejecuta la consulta de seleccion.
                        /** 
                         * *Se determina el numero de registros recuperados por el cursor, 
                         * *porque si es 0 el diseno de la pagina (parte HTML) es diferente
                         * * que si hay registros.
                         * */
                        if (!is_null($listaCitas)) {
                            $numeroDeCitasDelDia = count($listaCitas);
                        } else {
                            $numeroDeCitasDelDia = 0;
                        }
                        printf("<p class='lead text-left'>Citas del d&iacute;a: %02s</p>", $numeroDeCitasDelDia);
                        ?>
                        <!-- Se muestra la fecha del día. -->
                        <h1 class="text-white bg-dark">AGENDA DEL D&Iacute;A: <?php echo ($diaActual . " del " . $mesActual . " de " . $annioActual); ?></h1>
                        <p class="lead text-left">¿Cree ud. que el precio de la vivienda seguir&aacute; subiendo al ritmo actual?</p>
                        <!-- El formulario no tiene valor en el parámetro action porque se le asigna por una función javascript antes de enviarlo. La función que se ejecute y,por tanto, el valor de este parámetro, depende del botón pulsado por el usuario.-->
                        <form action="" method="post" name="frmCitasInicio" id="frmCitasInicio">
                            <!-- El siguiente campo oculto almacena la fecha en curso, obtenida desde PHP. Este dato se enviará a otros formularios y, a su vez, se rcuperará desde la página de cambio de fecha actual. -->
                            <input type="hidden" name="fechaEnCurso" id="fechaEnCurso" value="<?php echo ($fechaEnCurso); ?>">
                            <div class='shadow-lg px-3 my-1 bg-light rounded'>
                                <div class='table-responsive'>
                                    <table class='table table-striped table-dark'>
                                        <tr>
                                            <th>AGENDA DIGITAL 2022</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                            /** 
                             * *Se comprueba si hay citas en el cursor. Si es así, se dibujará una
                             * *tabla en la que se mostrarán las citas y unos botones de selección. 
                             * */
                            if ($numeroDeCitasDelDia > 0) {
                                echo ("<div class='shadow-lg p-3 mb-3 bg-light rounded'>");
                                echo ("<div class='table-responsive'>");
                                echo ("<table class='table table-striped table-dark'>");
                                echo ("<thead>");
                                echo ("<tr>");
                                echo ("<th scope='col' class='p-3 mb-2 text-center'>WC</th>");
                                echo ("<th scope='col' class='p-3 mb-2 text-center'>HORA</th>");
                                echo ("<th scope='col' class='p-3 mb-2 text-center'>DETALLES</th>");
                                echo ("<th scope='col' class='p-3 mb-2 text-center'>SELECC&Iacute;N</th>");
                                echo ("</tr>");
                                echo ("</thead>");
                                echo ("<tbody>");
                                $Cont = 1;
                                foreach ($listaCitas as $cita) {
                                    echo ("<tr>");
                                    echo ("<th scope='row' class='bg-info text-white' width='15'>$Cont</th>");
                                    print("<td class='text-center' width='100'>" .  $cita["horacita"] . "</td>");
                                    print("<td>" .  $cita["asuntocita"] . "</td>");
                                    /** 
                                     * *Cada cita tiene asociado un botón de selección para si el usuario quiere
                                     * *modificarla o borrarla. El valor del botón es el identificativo de la cita,
                                     * *de modo que se usará en las correspondientes consultas de actualización o
                                     * *eliminación en las páginas que proceda.
                                     * */
                                    print("<td class='text-center' width='100'><input type='radio' id='citaSeleccionada' name='citaSeleccionada' value='" . $cita['idcita'] . "'></td>");
                                    $Cont++;
                                    print("</tr>");
                                }
                                print("</tbody>");
                                print("</table>");
                                echo ("</div>");
                                echo ("</div>");
                            }

                            echo ("<div class='btn-group' role='group' aria-label='BotonesCRUD'>");
                            //* En todo caso se mostrarán los botones de agregar cita y cambiar la fecha en curso. */
                            if ($numeroDeCitasDelDia > 0) {
                                //* Si existen citas se mostrarán los botones de borrar y modificar. */
                                echo ("<button type='button' class='btn btn-outline-danger btn-lg' name='borrarCita' id='borrarCita' onClick='javascript:saltar(\"eliminarCita.php\");'>Eliminar Cita</button>");
                                echo ("<button type='button' class='btn btn-outline-warning btn-lg' name='cambiarCita' id='cambiarCita' onClick='javascript:saltar(\"cambiarCita.php\");'>Modificar Cita</button>");
                            }
                            echo ("<button type='button' class='btn btn-outline-success btn-lg' name='nuevaCita' id='nuevaCita' onClick='javascript:saltar(\"agregarCita.php\");'>Agregar Cita</button>");
                            echo ("<button type='button' class='btn btn-outline-secondary btn-lg' name='cambiarFecha' id='cambiarFecha' onClick='javascript:saltar(\"cambiarFecha.php\");'>Buscar por D&iacute;a</button>");
                            echo ("</div>");
                            ?>
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
                <!--Font Awesome v6.2.1 -->
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