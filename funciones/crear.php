<?php

//INCLUIR LA CONENCION A LA BAS DE DATOS
include ("../bd.php");

//VERIFICAR QUE SE ALLA ENVIADO LA TAREA
if (isset($_POST['guardar_tarea'])) {

    //DATOS PARA INSERTAR
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $id_u = $_SESSION['id'];

    //CREAR Y PREPARAR EL QUERY
    $query = "INSERT INTO task(title, description, estado, date_t, id_users) VALUES (?, ?, ?, ?, ?)";
    $stmt = $bd->prepare($query);

    /*$result = mysqli_query($conectarbd, $query);*/

    //ASOCIAR VARIABLES CON EL QUERY
    $exito = $stmt->bind_param("sssss", $titulo, $descripcion, $estado, $fecha, $id_u);

    if ($exito == false) {

        echo "Error en asociar las varibles";

    }else {

        $exito = $stmt->execute();

        if ($exito == true) {

            //ENVIAR PARA QUE APARESCA UN MENSAJE EN INDEX
            $_SESSION['mensaje'] = "Tarea Guardada Con Exito";
            $_SESSION['tipo-mensaje'] = 'success';

            //CERRAMOS LA SENTENCIA
            $stmt->close();

            //REDIRECIONAMOS AL LOGIN
            header("Location: ../index.php");

        }else {
            echo "No funciono";
        }

    }

}

?>