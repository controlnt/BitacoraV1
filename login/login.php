<?php

//INCLUIMOS LA BASE DE DATOS Y EL HEADER
include("../bd.php");
include("../includes/header.php");

//SI SE ACABA DE REGISTRAR UN USUARIO PONERMOS LA OPCION
if (isset($_SESSION["men_login"])) {
?>

    <div class="alert alert-dismissible alert-success fade show m-2">
        USUARIO CORRECTAMENTE REGISTRADO
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php

    //ASEMOS UNSET DEL MENSAJE QUE ENVIARON
    unset($_SESSION['men_login']);
}

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col">
            <h1 class="form-control fs-1">Inicio De Sesion</h1>
        </div>

    </div>

    <div class="row justify-content-center">

        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <div class="col-2 m-1">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required>
            </div>

            <div class="col-2 m-1">
                <input class="form-control" type="password" name="contrasena" placeholder="Ingrese Contraseña" required>
            </div>

            <div class="col-2 m-1">
                <input class="btn btn-success" type="submit" value="Login" name="btnlogin">
            </div>

        </form>

    </div>

</div>

<?php

//VERIFICAMOS QUE SE HALLA ENVIADO LOS DATOS
if (isset($_POST['btnlogin'])) {

    //CREAR VALUES PARA INSERTAR
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //HACEMOS Y PREPARAMOS EL QUERY
    $query = "SELECT id, usuario, contrasena FROM users WHERE usuario = ?";
    $stmt = $bd->prepare($query);

    //ASOCIAMOS LAS VARIABLES CON EL QUERY
    $stmt->bind_param("s", $usuario);

    //EJECUTAMOS LA SENTENCIA
    $stmt->execute();

    //VINCULAMOS DATOS DEBUELTOS A VARIABLES
    $stmt->bind_result($id,$v_usuario, $v_contrasena);

    /*$query = mysqli_query($conectarbd,"SELECT * FROM users WHERE usuario = '$usuario'");
    $fila = mysqli_num_rows($query);
    $buscarcontra = mysqli_fetch_array($query);*/

    //PONER LOS DATOS EN LAS VARIABLES
    $stmt->fetch();

    echo $stmt->num_rows();

    //VERIFICAR CONTRASEÑA USUARIO CON LA DE LA BASE DE DATOS Y GUARDAR SI ES VERDADERA O FALSA
    $contrasena_v = password_verify($contrasena, $v_contrasena);

    print_r($contrasena_v);

    //REVISAMOS SI SOLO NOS DEVOLVIO 1 DATO Y SI LA CONTRASEÑA TUVO EXITO
    if (($stmt->num_rows() == 1)&&($contrasena_v == true)) {
        $_SESSION['usuario'] = $v_usuario;
        $_SESSION['id'] = $id;
        header("Location: ../index.php");
    }else {
        echo "no funciono";
    }

//CERRAR LA SENTENCIA
$stmt->close();
}


//INCLUIR EL PIE DE PAGINA
include("../includes/footer.php");?>
