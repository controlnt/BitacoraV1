<?php 
$cerrar_session = "ocultar";
include("../includes/header.php");?>

<center>
<h1 class="form-control fs-1">Registro</h1>
<div class="row">
        <form method="POST" action="registro.php">
            <div class="col-2 m-1">
            <input type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required class="form-control">
            </div>
            <div class="col-2 m-1">
            <input type="email" name="correo" placeholder="Ingrese Correo" class="form-control">
            </div>
            <div class="col-2 m-1">
            <input type="password" name="contrasena" placeholder="Ingrese Contraseña" required class="form-control">
            </div>
            <input class="btn btn-success" type="submit" value="Registrar" name="btnregistrar">
        </form>
</div>
</center>
<?php include("../includes/footer.php");?>