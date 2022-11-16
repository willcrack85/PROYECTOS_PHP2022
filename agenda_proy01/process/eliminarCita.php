<?php
//* Si se intenta acceder sin haber seleccionado una cita, se regresa al index. */
if (!isset($_POST["citaSeleccionada"])) header("Location: ../index.php");
?>
<html>
</head>
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