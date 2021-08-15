<?php

include ("../bd.php");

if (isset($_POST['guardar_tarea'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $query = "INSERT INTO task(title, description, estado) VALUES ('$titulo', '$descripcion', '$estado')";
    $result = mysqli_query($conectarbd, $query);
    if (!$result) {
        die("Fallo en query");
    }

    $_SESSION['mensaje'] = "Tarea Guardada Con Exito";
    $_SESSION['tipo-mensaje'] = 'success';
    mysqli_close($conectarbd);

    header("Location: ../index.php");
}

?>