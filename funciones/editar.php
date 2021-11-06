<?php

//INCLUIR LA BASE DE DATOS
include("../bd.php");
include("../includes/header.php");

//VERIFICAR QUE SE ALLA ENVIADO EL ID DE LAS TAREAS
if(isset($_GET['id'])) {

    //TRAER VARIABLES
    $id_t = $_GET['id'];

    //CREAR Y PREPARAR EL QUERY
    $query = "SELECT title, description FROM task WHERE id = ?";
    $stmt = $bd->prepare($query);

    //ASOCIAR VARIABLES AL QUERY
    $exito = $stmt->bind_param("i", $id_t);

    //VERIFICAR QUE AL ASOCIAR LAS VARIBLES FUNCIONE
    if ($exito == false)  {

        echo "Error en el query";

    }else  {

        $stmt->execute();

        //VERIFICAR QUE SOLO NOS DEVUELVA 1 TAREA
        if ($stmt->num_rows() == 1) {

            //ASOCIAR LOS DATOS DEVIELTOS CON LAS VARIABLES
            $exito = $stmt->bind_result($titulo, $descripcion);

            if ($exito == false) {

                echo "Error";

            }else {

                //INSERTAR LOS DATOS DEVUELTOS CON LAS VARIABLES
                $stmt->fetch();

            }

        }

    }

    /*$result = mysqli_query($conectarbd, $query);

    if (mysqli_num_rows($result) == 1) {
        $fila = mysqli_fetch_array($result);
        $titulo = $fila['title'];
        $descripcion = $fila['description'];
    }*/


}

//VERIFICAR QUE SE ENVIO LA OPCION DE VERIFICAR
if (isset($_POST['actualizar'])) {

    //TRAER LAS VARIABLES
    $id = $_GET['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    //CREAR Y PREPARAR EL QUERY
    $query = "UPDATE task set title = ?, description = ? WHERE id = ?";
    $stmt = $bd->prepare($query);

    //ASOCIAR VARIABLES CON EL QUERY
    $exito = $stmt->bind_param("ssi", $titulo, $descripcion, $id);

    if ($exito == false) {
        echo "Error no funciono";
    }else {

        $stmt->execute();

        $_SESSION['mensaje'] = "Actualizado Correctamente";
        $_SESSION['tipo-mensaje'] = "warning";

        $stmt->close();

        header("Location: ../index.php");

    }

    /*$result = mysqli_query($conectarbd, $query);*/

}

?>

<div class="containner p-4">

    <div class="row">

        <div class="col-md-4 mx-auto">

            <div class="card card-body">

                <form action="editar.php?id=<?php echo $_GET["id"];?>" method="POST">

                    <div class="form-group">
                        <input type="text" name="titulo" value="<?php echo $titulo;?>" class="form-control" placeholder="Actualizar Titulo">
                    </div>

                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Editar Descripcion">
                            <?php echo $descripcion;?>
                        </textarea>
                    </div>

                    <button class="btn btn-success" name="actualizar">
                        Actualizar
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php

include("../includes/footer.php")

?>

