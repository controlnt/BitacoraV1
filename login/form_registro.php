<?php 
$cerrar_session = "ocultar";
include("../includes/header.php");?>

<center>
<div>
    <h1>Registar</h1>
        <form method="POST" action="registro.php">
            <input type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" required>
            <input type="email" name="correo" placeholder="Ingrese Correo">
            <input type="password" name="contraseña" placeholder="Ingrese Contraseña" required>
            <input type="submit" value="Registrar" name="btnregistrar">
        </form>
</div>
</center>
<?php include("../includes/footer.php");?>