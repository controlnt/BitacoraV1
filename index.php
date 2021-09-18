<?php
include("bd.php");
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM users WHERE usuario = '$usuario'";
$resultados_id = mysqli_query($conectarbd, $query);
$fila = mysqli_fetch_array($resultados_id);
$_SESSION['id_usu'] = $fila['id'];

$cerrar_session = "mostrar";

include("includes/header.php");

if (!isset($_SESSION['ver_login'])) {
    header('Location: login/form_login.php');
}
?>

<div class="container p-4">
    <h1>Bienvenido <?= $_SESSION['usuario']?></h1>
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="alert alert-<?= $_SESSION['tipo-mensaje']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php 
            unset ($_SESSION['mensaje']); 
            unset ($_SESSION['tipo-mensaje']);
            } ?>

            <div class="card card-body">
                <form action="funciones/crear.php" method="POST">
                    <div class="form-gropup">
                        <input type="text" name="titulo" class="form-control" placeholder="Titulo Tarea" autofocus>
                    </div>
                    <hr>
                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Describir Tarea"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="datetime-local" name="fecha" class="form-control" placeholder="Fecha">
                    </div>
                    <hr>
                    <div>
                        <select name="estado" id="estado" class="form-control">
                            <option selected value="realizada" class="success">Realizada</option>
                            <option value="pendiente" class="warning">Pendiente</option>
                            <option value="imprevista" class="danger">Imprevista</option>
                        </select>
                    </div>
                    <hr>
                    <div>
                        <input type="submit" class="btn btn-success btn-block" name="guardar_tarea" value="Guardar Tarea">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered"> 
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
                    $id = $_SESSION['id_usu'];
                    date_default_timezone_set('America/Bogota');
                    $hoy_i = date("Y-m-d 00:00:00");
                    $hoy_f = date("Y-m-d 23:59:59");
                    $query = "SELECT * FROM task WHERE date_t BETWEEN '". $hoy_i. "' AND '".$hoy_f."'";
                    $resultados_tareas = mysqli_query($conectarbd, $query);
                    while ($fila = mysqli_fetch_array($resultados_tareas)) {?>
                        <tr>
                            <td><?php echo $fila['title']; ?></td>
                            <td><?php echo $fila['description']; ?></td>
                            <td><?php echo $fila['date_t']; ?></td>
                            <td><?php echo $fila['estado'] ?></td>
                            <td>
                                <a href="funciones/eliminar.php?id=<?php echo $fila['id']?>" class="btn btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                                <a href="funciones/editar.php?id=<?php echo $fila['id']?>" class="btn btn-secondary">
                                    <i class="fa fa-marker"></i>
                                </a>
                                <a href="funciones/realizada.php?id=<?php echo $fila['id']?>" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>

        <hr class="y m-2">
        
            <form class="container" action="funciones/buscar.php" method="POST">
            <div class="row">
                <div class="col-5">
                    <label for="desde">Desde</label>
                    <input type="datetime-local" name="fecha_i" class="form-control">
                </div>
                <div class="col-5">
                    <label for="hasta">Hasta</label>
                    <input type="datetime-local" name="fecha_f" class="form-control">
                </div>
                <div class="col-2">
                    <input type="submit" class="btn btn-outline-success" name="buscar_tarea" value="Buscar">
                </div>
            </div>
            </form>
        <div>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                    if (!isset($_SESSION['t_buscada'])) {
                        $_SESSION['t_buscada'] = NULL;
                    }
                    $t_buscada = $_SESSION['t_buscada'];
                    if ($t_buscada != NULL) {
                    ?>
                    <tr>
                        <td><?php echo $t_buscada['title']?></td>
                        <td><?php echo $t_buscada['description']?></td>
                        <td><?php echo $t_buscada['date_t']?></td>
                        <td><?php echo $t_buscada['estado']?></td>
                        <td>
                                <a href="funciones/eliminar.php?id=<?php echo $t_buscada['id']?>" class="btn btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                                <a href="funciones/editar.php?id=<?php echo $t_buscada['id']?>" class="btn btn-secondary">
                                    <i class="fa fa-marker"></i>
                                </a>
                                <a href="funciones/realizada.php?id=<?php echo $t_buscada['id']?>" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                </a>
                        </td>
                    </tr>
                    <?php
                    }
                    if(isset($_SESSION['t_buscada'])) {
                    unset ($_SESSION['t_buscada']);
                    } ?>
                </tbody>
            </table>
        </div><!--TABLE-->
    </div><!--ROW-->
</div><!--CONTAINER-->

<?php include("includes/footer.php")?>