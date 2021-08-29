<?php 
$cerrar_session = "ocultar";
include("../bd.php");
include("../includes/header.php");
?>

<center>
    
<h1 class="form-control fs-1">Inicio De Sesion</h1>
<div class="row">
        <form method="POST" action="login.php">
            <div class="col-2 m-1">
            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required>
            </div>
            <div class="col-2 m-1">
            <input class="form-control" type="password" name="contraseña" placeholder="Ingrese Contraseña" required>
            </div>
            <input class="btn btn-success" type="submit" value="Login" name="btnlogin">
        </form>
</div>
</center>
<?php include("../includes/footer.php");?>
