<?php

$cerrar_session = "mostrar";

include("../../bd.php");
include("../../includes/header.php");

if (!isset($_SESSION)) {
    session_start();
}

?>

<div class="container p-4">
    <h1>Consular Tareas</h1>
        <hr>
            <form class="container" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="row align-items-center">
                    <div class="col-1">
                        <label for="desde">Desde</label>
                    </div>
                    <div class="col-4">
                        <input type="datetime-local" name="fecha_i" class="form-control">
                    </div>
                    <div class="col-1">
                        <label for="hasta">Hasta</label>
                    </div>
                    <div class="col-4">
                        <input type="datetime-local" name="fecha_f" class="form-control">
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Buscar" class="btn btn-success" name="buscar_tarea">
                    </div>
                </div>
            </form class="container">
        <table class="table table-hover">
            <thead>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </thead>
            <?php
                if (!isset($_POST['buscar_tarea'])) {
                    $_POST['buscar_tarea'] = NULL;
                }
                if ($_POST['buscar_tarea'] != NULL) {
                    $fecha_i = $_POST['fecha_i'];
                    $fecha_f = $_POST['fecha_f'];
                    $query = "SELECT title, description, estado, date_t FROM task WHERE date_t BETWEEN ? AND ? /*'". $fecha_i. "' AND '".$fecha_f."'*/";
                    $result = mysqli_prepare($conectarbd, $query);
                    $exito = mysqli_stmt_bind_param($result, "ss", $fecha_i, $fecha_f);
                    $exito = mysqli_stmt_execute($result);
                    if ($exito==false) {
                        echo "Error en la consulta";
                    }else {
                        $exito = mysqli_stmt_bind_result($result, $titulo, $descripcion, $estado, $fecha);
                        while ($fila = mysqli_stmt_fetch($result)) {
            ?>
                <tbody>
                    <td><?= $titulo; ?></td>
                    <td><?= $descripcion; ?></td>
                    <td><?= $fecha; ?></td>
                    <td><?= $estado; ?></td>
                    <td></td>
                </tbody>
            <?php
            }
            mysqli_stmt_close($result);
        }
    }
            ?>
        </table>
</div>

<?php include("../../includes/footer.php") ?>