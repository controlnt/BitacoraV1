<?php

    set_include_path('\xampp\htdocs\bitacora');
    include("bd.php");
    $cerrar_session = "mostrar";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id = $id";
        $result = mysqli_query($conectarbd, $query);

        if (mysqli_num_rows($result) == 1) {
            $fila = mysqli_fetch_array($result);
            $titulo = $fila['title'];
            $descripcion = $fila['description'];
        }
    }

    if (isset($_POST['actualizar'])) {
        $id = $_GET['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];

        $query = "UPDATE task set title = '$titulo', description = '$descripcion' WHERE id = '$id'";
        $result = mysqli_query($conectarbd, $query);

        $_SESSION['mensaje'] = "Actualizado Correctamente";
        $_SESSION['tipo-mensaje'] = "warning";

        header("Location: ../index.php");
    }

?>
    <?php include("../includes/header.php")?>

<div class="containner p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar.php?id=<?php echo $_GET["id"];?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="titulo" value="<?php echo $titulo;?>" class="form-control" placeholder="Actualizar Titulo">
                    </div>
                    <hr>
                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Editar Descripcion"><?php echo $descripcion;?>
                    </textarea>
                    </div>
                    <hr>
                    <button class="btn btn-success" name="actualizar">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php include("../includes/footer.php")?>