<?php
//* Si se intenta acceder sin haber seleccionado una cita, se regresa al index. */
if (!isset($_POST["citaSeleccionada"])) header("Location: ../index.php");
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
    <title>Mini-Agenda DS7 - Eliminar Nota</title>
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
    <?php
    //* Se incluye el miniscript de tratamiento de fechas
    include("../class/fechas.php");
    //* Se incluye el miniscript que abre la base de datos.
    require_once("../class/citasDB.php");
    $objCitas = new citaAgenda();
    ?>
    <script language="javascript" type="text/javascript">
        function volver() {
            document.retorno.submit();
        }
    </script>
</head>

<body onLoad="javascript:volver();">
    <?php
    /** 
     * *Se crea una consulta para eliminar la cita que se haya seleccionado en la pagina principal.
     * *La cita se designa a traves del campo 'idCita', cuyo valor queda asignado a los botones de
     * *radio de la pagina index.php (ver codigo).
     * */
    $hacerConsulta = $objCitas->eliminar_cita_seleccionada($_POST['citaSeleccionada']);
    if ($hacerConsulta) {
        echo ("<script>alert('Se Eliminó la información seleccionada.');</script>");
    }
    ?>
    <form action="../index.php" method="post" name="retorno" id="retorno">
        <input type="hidden" name="fechaEnCurso" id="fechaEnCurso" value="<?php echo ($fechaEnCurso); ?>">
    </form>
</body>

</html>