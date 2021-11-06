<?php

include ("../bd.php");

if (isset($_GET['id'])) {

    $id_u = $_GET['id'];

    $query = "DELETE FROM task WHERE id = ?";
    $stmt = $bd->prepare($query);

    $exito = $stmt->bind_param("i", $id_u);

    if ($exito == false) {

       echo "Error Ex001";

    }else {

        $stmt->execute();

        $_SESSION['mensaje'] = 'Tarea Eliminada';
        $_SESSION['tipo-mensaje'] = 'danger';

        header("Location: ../index.php");

    }

    /*$result = mysqli_query($conectarbd, $query);

    if(!$result) {
        die("Error al eliminar");
    }*/


}

?>