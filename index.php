<?php include("includes/header.php");


?>

<div class="container p-4">

<h1>Bienvenido</h1>

    <div class="row">

        <div class="col-md-4">

            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="alert alert-<? $_SESSION['tipo-mensaje']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?>

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
                    <input type="submit" class="btn btn-success btn-block" name="guardar_tarea" value="Guardar Tarea">
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include ("bd.php");
                    $query = "SELECT * FROM task";
                    $resultados_tareas = mysqli_query($conectarbd, $query);
                    while ($fila = mysqli_fetch_array($resultados_tareas)) {?>
                        <tr>
                            <td><?php echo $fila['title']; ?></td>
                            <td><?php echo $fila['description']; ?></td>
                            <td><?php echo $fila['date']; ?></td>
                            <td>
                                <a href="funciones/editar.php?id=<?php echo $fila['id']?>" class="btn btn-secondary">
                                    <i class="fa fa-marker"></i>
                                </a>
                                <a href="funciones/realizada.php?id=<?php echo $fila['id']?>" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                        </tr>

                    <?php }
                    mysqli_close($conectarbd); ?>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php")?>
