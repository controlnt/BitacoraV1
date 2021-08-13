<?php

include ("../bd.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($conectarbd, $query);
        if(!$result) {
            die("Error al eliminar");
        }

        $_SESSION['mensaje'] = 'tarea eliminada satisfactoriamente';
        $_SESSION['tipo-mensaje'] = 'danger';
        header("Location: ../index.php");
    }

?>