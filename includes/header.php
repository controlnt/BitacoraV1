<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BITACORA</title>
    <!-- bostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--FONT AWESOME -->
    <script src="https://kit.fontawesome.com/7e992ae22f.js" crossorigin="anonymous"></script>
</head>
<header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col">
                    <a class="navbar-brand" href="index.php">SANGEL N TEGNOLOGIA</a>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col">
                    <a href="funciones/buscar.php" class="btn btn-secondary ocultar">
                        Consutar Tareas
                    </a>
                    <a href="cerrar_session.php" class="ocultar">
                        <button class="btn btn-danger text-nowrap" id="cerrarsesion">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<?php

if (!isset($_SESSION['usuario'])) {

?>

    <style>
        .ocultar {
            display: none;
        }
    </style>

<?php

}

//VERIFICAR QUE EL USUARIO ESTE LOGEADO
if (!isset($_SESSION['ver_login'])) {
    header('Location: login/login.php');
}

?>