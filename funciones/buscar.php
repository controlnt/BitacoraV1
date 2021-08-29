<?php

include('../bd.php');

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['buscar_tarea'])) {
    $tarea_buscar = $_POST['tarea_buscar'];
    $query = "SELECT title FROM task WHERE title like '$tarea_buscar%'";
    $result = mysqli_query($conectarbd, $query);
    $fila = mysqli_fetch_array($result);
    $_SESSION['t_buscada'] = $fila['title'];
    header("Location: ../index.php");
}

?>