<?php
//* Se incluye el miniscript que abre la base de datos.
require_once("../class/citasDB.php");
$objCitas = new citaAgenda();
//* Se toman todos los datos necesarios del formulario de modificaciones.
$nuevaHora = $_POST['hora'] . ":" . $_POST['minutos'];
$nuevaFecha = $_POST['annio'] . "-" . $_POST['mes'] . "-" . $_POST['dia'];
//* Se monta y ejecuta la consulta de actualización.
$hacerConsulta = $objCitas->modificar_cita_seleccionada($nuevaFecha, $nuevaHora, $_POST['asunto'], $_POST['citaSeleccionada']);
if ($hacerConsulta) {
    echo ("<script>alert('Se Guardó la información que ha sido cambiada.');</script>");
}
?>
<html>

<head>
    <script language="javascript" type="text/javascript">
        /** 
         * *Cuando se ha cargado la p�gina (ya se ha hecho la actualizaci�n) se vuelve a
         * *index, pasando la fecha en curso como un campo oculto.
         * */
        function volver() {
            document.retorno.submit();
        }
    </script>
</head>

<body onLoad="javascript:volver();">
    <!-- El siguiente formulario es para volver a index xon la fecha en curso. -->
    <form action="../index.php" method="post" name="retorno" id="retorno">
        <input type="hidden" name="fechaEnCurso" id="fechaEnCurso" value="<?php echo ($_POST['fechaEnCurso']); ?>">
    </form>
</body>

</html>