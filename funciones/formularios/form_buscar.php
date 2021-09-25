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
                if (isset($_POST['buscar_tarea'])) {
                    $fecha_i = $_POST['fecha_i'];
                    $fecha_f = $_POST['fecha_f'];
                    $query = "SELECT * FROM task WHERE date_t BETWEEN '". $fecha_i. "' AND '".$fecha_f."'";
                    $result = mysqli_query($conectarbd, $query);
                    while ($fila = mysqli_fetch_array($result)) {
            ?>
                <tbody>
                    <td><?= $fila['title']; ?></td>
                    <td><?= $fila['description']; ?></td>
                    <td><?= $fila['date_t']; ?></td>
                    <td><?= $fila['estado']; ?></td>
                    <td></td>
                </tbody>
            <?php
            } }
            ?>
        </table>
</div>



<?php include("../../includes/footer.php") ?>