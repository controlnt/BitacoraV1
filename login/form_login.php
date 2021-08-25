<?php 
$cerrar_session = "ocultar";
include("../bd.php");
include("../includes/header.php");
?>

<center>
<div>
    <h1>Inicio Sesion</h1>
        <form method="POST" action="login.php">
            <input type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required>
            <input type="password" name="contraseña" placeholder="Ingrese Contraseña" required>
            <input type="submit" value="Login" name="btnlogin">
        </form>
</div>
</center>
<?php include("../includes/footer.php");?>
