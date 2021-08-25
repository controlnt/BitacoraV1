<?php
include ("../bd.php");


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];


if ($_POST['btnlogin']) {
    $query = mysqli_query($conectarbd,"SELECT * FROM users WHERE usuario = '$usuario'");
    $fila = mysqli_num_rows($query);
    $buscarcontra = mysqli_fetch_array($query);

    if (($fila == 1)&&(password_verify($contraseña,$buscarcontra['contraseña']))) {
        $_SESSION['ver_login'] = $usuario;
        header("Location: ../index.php");
    }
}else {
    echo "no mo sirve" /*"<script>
                alert('Mensaje');
    </script>"*/;
    header("Location: form_registro.php");
}

/*header("Location: index.php");*/
$_SESSION['usuario'] = $usuario;
?>