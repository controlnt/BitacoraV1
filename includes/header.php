<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BITACORA</title>
    <!-- bostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--FONT AWESOME -->
    <script src="https://kit.fontawesome.com/7e992ae22f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">SANGEL N TEGNOLOGIA</a>
        </div>
                <a href="cerrar_session.php" id="ocultar">
                    <button class="cerrar-sesion" id="cerrarsesion">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </a>
        </ul>
    </nav>
</header>

<?php
if ($cerrar_session=="ocultar") {?>
    <style>
        #ocultar {
            display: none;
        }
    </style>
<?php
}
?>