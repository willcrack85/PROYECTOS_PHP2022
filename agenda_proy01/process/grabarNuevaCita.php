<html>

<head>
    <script language="javascript" type="text/javascript">
        function volver() {
            document.retorno.submit();
        }
    </script>
</head>

<body onLoad="javascript:volver();">
    <?php
    //* Se incluye el miniscript de tratamiento de fechas
    include("../class/fechas.php");
    //* Se incluye el miniscript que abre la base de datos.
    require_once("../class/citasDB.php");
    $objCitas = new citaAgenda();
    //* Se crea la hora, a partir de las horas y minutos establecidos en el formulario de nueva cita.
    $horaDeCita = $_POST['hora'] . ":" . $_POST['minutos'];
    //* Se monta la consulta para grabar una nueva cita.
    $hacerConsulta = $objCitas->grabar_nueva_cita($fechaEnCurso, $horaDeCita, $_POST['asunto']);
    if ($hacerConsulta) {
        echo ("<script>alert('Se grabó la información.');</script>");
    }
    //* Se ejecuta la consulta.
    ?>
    <form action="../index.php" name="retorno" id="retorno" method="post">
        <input type="hidden" name="fechaEnCurso" id="fechaEnCurso" value="<?php echo ($fechaEnCurso); ?>">
    </form>
</body>

</html>