<?php

/**
 * Description of votos
 * Objetivo: Desarrollar aplicaciones web en PHP con acceso a base de datos 
 * MySQL (MariaDB).
 * @author WCcorp
 */
require_once('modeloDB.php');

class citaAgenda extends modeloCredencialesBD
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_citas_hoy($fecha)
    {
        /** 
         * *Se crea una consulta para recuperar todos los datos de las citas con fecha del dia en curso.
         * *La consulta de seleccion se crea de tal modo que ordene las citas por la hora.
         * */

        $instruccion = "CALL sp_listar_citas('" . $fecha . "')";
        $consulta = $this->_db->query($instruccion);       //* Se ejecuta la consulta de seleccion.
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$resultado) {
            //echo "fallo al consultar las Citas en la BD";
            echo ("<script>alert('Para el día de hoy no hay citas.');</script>");
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function mostrar_cita_seleccionada($idCita)
    {
        $instruccion = "CALL sp_listar_una_cita('" . $idCita . "')";
        $consulta = $this->_db->query($instruccion);       //* Se ejecuta la consulta de seleccion.
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$resultado) {
            echo ("<script>alert('Error, no se encuentra la cita seleccionada.');</script>");
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function grabar_nueva_cita($diaCita, $horaCita, $asuntoCita)
    {
        // var_dump($diaCita);
        // var_dump($horaCita);
        // var_dump($asuntoCita);
        $instruccion = "CALL sp_grabar_nuevas_citas('" . $diaCita . "','" . $horaCita . "','" . $asuntoCita . "')";
        $consulta = $this->_db->query($instruccion);       //* Se ejecuta la consulta de seleccion.
        //$resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$consulta) {
            echo ("<script>alert('Error, no se ha podido grabar la cita.');</script>");
        } else {
            return $consulta;
            $consulta->close();
            $this->_db->close();
        }
    }

    public function eliminar_cita_seleccionada($idCita)
    {
        $instruccion = "CALL sp_eliminar_cita('" . $idCita . "')";
        $consulta = $this->_db->query($instruccion);       //* Se ejecuta la consulta de seleccion.
        if (!$consulta) {
            echo ("<script>alert('Error, no se ha eliminado la cita.');</script>");
        } else {
            return $consulta;
            $consulta->close();
            $this->_db->close();
        }
    }

    public function modificar_cita_seleccionada($newFecha, $newHora, $newAsunto, $idCita)
    {
        $instruccion = "CALL sp_modificar_una_cita('" . $newFecha . "','" . $newHora . "','" . $newAsunto . "','" . $idCita . "')";
        $consulta = $this->_db->query($instruccion);       //* Se ejecuta la consulta de seleccion.
        //$resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$consulta) {
            echo ("<script>alert('Error, no se ha modificado la cita.');</script>");
        } else {
            return $consulta;
            $consulta->close();
            $this->_db->close();
        }
    }

    // public function actualizar_votos($voto1, $voto2)
    // {
    //     $instruccion = "CALL sp_actualizar_votos('" . $voto1 . "','" . $voto2 . "')";
    //     $actualiza = $this->_db->query($instruccion);
    //     if ($actualiza) {
    //         return $actualiza;
    //         $actualiza->close();
    //         $this->_db->close();
    //     }
    // }
}
