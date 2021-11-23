<?php

//INCLUIMOS LOS ARCHIVOS DE LA VASE DE DATOS Y EL HEADER
include("../bd.php");
include("../includes/header.php");

//VERIFICAR SI EXISTE UNA SESSION
if (!isset($_SESSION)) {
    session_start();
}

?>

<div class="container p-4">

    <div class="row">
        <div class="col">
            <h1>Consular Tareas</h1>
        </div>
    </div>

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

    </form>

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

        //TRAER DATOS A CONSULTAR
        $fecha_i = $_POST['fecha_i'];
        $fecha_f = $_POST['fecha_f'];
        $id_u = $_SESSION['id'];

        //CREAR Y PREPARAR EL QUERY
        $query = "SELECT id, title, description, estado, date_t FROM task WHERE date_t BETWEEN ? AND ? AND id_users=?";
        $stmt = $bd->prepare($query);

        //ASOSAR DATOS AL QUERY
        $exito = $stmt->bind_param("sss", $fecha_i, $fecha_f, $id_u);

        //EJECUTAMOS EL QUERY
        $exito = $stmt->execute();

        //VERIFICAMOS QUE NO AYA ERRORES
        if ($exito==false) {

            echo "Error en la consulta";

        }else {

            //ASOCIAMOS LOS DATOS DEBUELTOS CON VARIABLES
            $exito = $stmt->bind_result($id, $titulo, $descripcion, $estado, $fecha);

            //IMPRIMIMOS LOS DATOS
            while ($stmt->fetch()) {

?>
        <tbody>

            <tr>

                <td><?= $titulo ?></td>
                <td><?= $descripcion ?></td>
                <td><?= $fecha ?></td>
                <td><?= $estado ?></td>
                <td>
                    <a href="eliminar.php?id=<?= $id ?>" class="btn btn-danger">
                        <i class="fa fa-trash-alt"></i>
                    </a>
                    <a href="editar.php?id=<?= $id ?>" class="btn btn-secondary">
                        <i class="fa fa-marker"></i>
                    </a>
                        <a href="realizada.php?id=<?= $id ?>" class="btn btn-success">
                            <i class="fas fa-check"></i>
                    </a>
                </td>

            </tr>

        </tbody>

<?php

            }
            //CERRAMOS LA SENTENCIA
            $stmt->close();
        }
    }

?>

    </table>

</div>


<?php

//INCLUR EL PIE DE PAGINA
include("../includes/footer.php")

?>