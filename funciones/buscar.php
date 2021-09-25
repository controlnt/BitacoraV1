<?php

include('../bd.php');

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['buscar_tarea'])) {
    $fecha_i = $_POST['fecha_i'];
    $fecha_f = $_POST['fecha_f'];
    //$query = "SELECT * FROM task WHERE /*title like '$tarea_buscar' OR*/ date_t BETWEEN '". $fecha_i. "' AND '".$fecha_f."'";
    $query = "SELECT * FROM task WHERE date_t BETWEEN '". $fecha_i. "' AND '".$fecha_f."'";
    $result = mysqli_query($conectarbd, $query);
    $_SESSION['t_buscadas'] = $result;
    header("Location: formularios/form_buscar.php");
}

?>