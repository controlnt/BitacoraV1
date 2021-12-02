<?php

//INCLUIR LA BD Y EL HEADER
include("bd.php");
include("includes/header.php");
include("includes/ver_login.php");

//PONEMOS LA ZONA HORARIA
date_default_timezone_set('America/Bogota');

//VERIFICAR SI EXISTE UNA SESSION
if (!isset($_SESSION)) {
    session_start();
}

//TRAER EL USUARIO LOGEADO
$usuario = $_SESSION['usuario'];
$id_u = $_SESSION['id']

/*TRAER EL USUARIO DE LA BD
$query = "SELECT * FROM users WHERE usuario = '$usuario'";
$resultados_id = mysqli_query($conectarbd, $query);
$fila = mysqli_fetch_array($resultados_id);
$_SESSION['id_usu'] = $fila['id'];*/

?>

<div class="container p-4">

    <div class="row">

        <div class="col">
            <h1>Bienvenido <?= $_SESSION['usuario']?> </h1>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

<?php

if (isset($_SESSION['mensaje'])) {

?>

    <div class="alert alert-<?= $_SESSION['tipo-mensaje']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensaje'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php

    unset ($_SESSION['mensaje']);
    unset ($_SESSION['tipo-mensaje']);

}

?>

            <div class="card card-body">

                <form action="funciones/crear.php" method="POST">

                    <div class="form-group my-1">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo Tarea" autofocus>
                    </div>

                    <div class="form-group my-1">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Describir Tarea"></textarea>
                    </div>

                    <div class="form-group my-1">
                        <input type="datetime-local" name="fecha" class="form-control" placeholder="Fecha">
                    </div>

                    <div>
                        <select name="estado" id="estado" class="form-control my-1">
                            <option selected value="realizada" class="bg-success">Realizada</option>
                            <option value="pendiente" class="bg-warning">Pendiente</option>
                            <option value="imprevista" class="bg-danger">Imprevista</option>
                        </select>
                    </div>

                    <div>
                        <input type="submit" class="btn btn-success btn-block" name="guardar_tarea" value="Guardar Tarea">
                    </div>

                </form>

            </div>

        </div>

        <div class="col-md-8">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

<?php

//VARIABLES A CONSULTAR
$hoy_i = date("Y-m-d 00:00:00");
$hoy_f = date("Y-m-d 23:59:59");

//HACEMOS EL QUERY
$query = "SELECT id, title, description, estado, date_t FROM task WHERE date_t BETWEEN ? AND ? AND id_users=?";

//PREPARAMOS EL QUERY
$stmt = $bd->prepare($query);

//ASOCIAR LAS VARIABLES CON LOS ?
$exito = $stmt->bind_param("ssi", $hoy_i, $hoy_f, $id_u);

//CONSULTAR SI LA PREPARACION ES CORRECTA
if ($exito == false) {

?>

    <div class="row ">
        <div class="col">
            <div class="alert alert-danger text-center">
                NO SE ENCUENTRA NUNGUNA TAREA
            </div>
        </div>
    </div>

<?php

}else {

//EJECUTAMOS LA SENTENCIA
$exito = $stmt->execute();

//VERIFICAR SI LA EJECUCION DE LA CONSULTA SALIO BIEN
if ($exito == false) {
    echo "Error en la consulta";
}else {

    //VUNCULAS LOS DATOS DEVUELTOS
    $stmt->bind_result($id_t,$titulo, $descripcion, $estado, $fecha);

    /*$exito = mysqli_stmt_bind_result($result, $id, $titulo, $descripcion, $estado, $fecha);*/

    while ($stmt->fetch()) {

?>

                    <tr>

                        <td><?= $titulo ?></td>
                        <td><?= $descripcion ?></td>
                        <td><?= $fecha ?></td>
                        <td><?= $estado ?></td>
                        <td>
                            <a href="funciones/eliminar.php?id=<?= $id_t ?>" class="btn btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <a href="funciones/editar.php?id=<?= $id_t ?>" class="btn btn-secondary">
                                <i class="fa fa-marker"></i>
                            </a>
                            <a href="funciones/realizada.php?id=<?= $id_t ?>" class="btn btn-success">
                                <i class="fas fa-check"></i>
                            </a>
                        </td>

                    </tr>
<?php

                        }

                    }

                    }

?>
                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

include("includes/footer.php")

?>

