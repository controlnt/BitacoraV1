<?php

//INCLIMOS LA BASE DE DATOS Y LA CABESERA
include("../includes/header.php");
include("../bd.php");

//VERIFICAR QUE EXISTE LA SESSION
if (!isset($_SESSION)) {

    session_start();

}

?>

<div class="container">

    <div class="row">

        <div class="col">
            <h1 class="form-control fs-1">Registro</h1>
        </div>

    </div>

    <form class="row justify-content-center" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <div class="col-2 m-1">
            <input type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required class="form-control">
        </div>

        <div class="col-2 m-1">
            <input type="email" name="correo" placeholder="Ingrese Correo" class="form-control">
        </div>

        <div class="col-2 m-1">
            <input type="password" name="contrasena" placeholder="Ingrese Contraseña" required class="form-control">
        </div>

        <div class="col-2 m-1">
            <input class="btn btn-success" type="submit" value="Registrar" name="btnregistrar">
        </div>

    </form>

</div>

<?php

if (isset($_POST['btnregistrar'])) {

    //CREAR VARIABLES PARA INSERTAR
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    //ENCRIPTAR CONTRASEÑA
    $e_contrasena = password_hash('$contrasena', PASSWORD_DEFAULT);
    
    //INSERTAR LOS DATOS
    //CREO E PREPARO EL QUERY
    $query = "INSERT INTO users(usuario, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $bd->prepare($query);

    //VINCULO LAS VARIABLES A LOS '?'
    $stmt->bind_param("sss", $usuario, $correo, $e_contrasena);
    
    //EJECUTO EL QUERY O LA SENTENCIA
    $exito = $stmt->execute();

    //ENVIO MENSAJE PARA PONER UNA BARRITA DE REGISTRADO CON EXITO
    $_SESSION["men_login"] = 1;

    //CIERRO Y LA SENTENCIA
    $stmt->close();

    //ELIMINAMOS LOS DATOS DEL POST
    unset($_POST['usuario']);
    unset($_POST['correo']);
    unset($_POST['contrasena']);
    unset($e_contrasena);

    //REDIRECIONAMOS A EL LOGIN
    header("Location: login.php");
}

include("../includes/footer.php");?>