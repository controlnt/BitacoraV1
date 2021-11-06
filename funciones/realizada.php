<?php
include("../bd.php");

if (!isset($_SESSION)) {

    session_start();

}

if (isset($_GET)) {

    $id_t = $_GET['id'];

    $query = "UPDATE task set estado='realizada' WHERE id=?";
    $stmt = $bd->prepare($query);

    $exito = $stmt->bind_param("i", $id_t);

    if ($exito == false) {

        echo " No funciono";

    }else {

        $exito = $stmt->execute();

        if ($exito == false) {

            echo "Error";

        }else {

            $stmt->close();

            $_SESSION['mensaje'] = "Estado De Tarea Cambiado Correctamente";
            $_SESSION['tipo-mensaje'] = "success";

            header("Location: ../index.php");

        }

    }


    /*$result = mysqli_query($conectarbd, $query);
    if (!$result) {
        die("Error a Cambiar Estado");
    }else {
        header("Location: ../index.php");
    }*/

}

?>