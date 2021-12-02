<?php

include('../includes/header.php');
include('../bd.php');
include('../includes/ver_login.php');

?>

<div class="container p-4">

    <form action="crear.php" method="post" class="row justify-content-cente">

        <div class="col">
            <input type="text" name="nombre" placeholder="Nombre De Empresa" class="form-control">
        </div>

        <div class="col">
            <input type="number" name="nit" placeholder="Nit De La Empresa" class="form-control">
        </div>

        <div class="col">
            <input type="submit" name="btn_crear" value="Crear" class="btn btn-success">
        </div>

    </form>

</div>

<?php

if (isset($_POST['btn_crear'])) {

    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];

    if (!$stmt = $bd->prepare("SELECT codigo FROM empresas WHERE codigo BETWEEN '10000' AND '99999' ORDER BY codigo DESC LIMIT 1")) {

        die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);

    }

    if (!$exito = $stmt->execute()) {

        die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);

    }

    if (!$exito = $stmt->bind_result($codigo_e)) {

        die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);

    }

    $stmt->fetch();

    $codigo_s = $codigo_e + 1;

    $stmt->close();

    if (!$stmt = $bd->prepare("SELECT codigo FROM empresas WHERE codigo = ? LIMIT 1")) {

        die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);

    }

    if (!$exito = $stmt->bind_param("i", $codigo_s)) {

        die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);

    }

    if (!$exito = $stmt->execute()) {

        die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);

    }

    if (!$exito = $stmt->bind_result($codigo_v)) {

        die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);

    }

    $stmt->fetch();

    $stmt->close();

    if ($codigo_v == NULL) {

        $codigo_n = true;

    }

    if ($codigo_v == !NULL) {

        $codigo_n = false;

    }

    if (isset($codigo_n)&&($codigo_n)) {

        if (!$stmt = $bd->prepare("INSERT INTO empresas(empresa, nit, codigo) VALUES (?, ?, ?)")) {
    
            die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
    
        }
    
        if (!$exito = $stmt->bind_param("sii", $nombre, $nit, $codigo_s)) {
    
            die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);
    
        }
    
        if (!$exito = $stmt->execute()) {
    
            die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
    
        }
    
        $stmt->close();

        $codigo_f = $codigo_s;

    }


    if (isset($codigo_n)&&(!$codigo_n)) {

        if (!$stmt = $db->prepare("SELECT codigo FROM empresas WHERE codigo BETWEEN '10000' AND '99999' ORDER BY codigo ASC LIMIT 1")) {
    
            die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
    
        }
    
        if (!$exito = $stmt->execute()) {
    
            die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
    
        }
    
        if (!$exito = $stmt->bind_result($codigo_2)) {
    
            die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);
    
        }
    
        $stmt->fetch();
    
        $stmt->close();
    
        $codigo_r = $codigo_2 - 1;
    
        if (!$stmt = $bd->prepare("INSERT INTO empresas(empresa, nit, codigo) VALUES (?, ?, ?)")) {
    
            die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
    
        }
    
        if (!$exito = $stmt->bind_param("sii", $nombre, $nit, $codigo_r)) {
    
            die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);
    
        }
    
        if (!$exito = $stmt->execute()) {
    
            die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
    
        }
    
        $stmt->close();

        $codigo_f = $codigo_r;
    
    }

    if (!$stmt = $bd->prepare("SELECT id FROM empresas WHERE codigo = ?")) {

        die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);

    }

    if (!$stmt->bind_param("i", $codigo_f)) {

        die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);

    }

    if (!$stmt->execute()) {

        die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);

    }

    if (!$stmt->bind_result($id_e)) {

        die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);

    }

    $stmt->fetch();

    $stmt->close();

    $id_u = $_SESSION['id'];

    if (!$stmt = $bd->prepare("UPDATE users SET id_empresas = ? WHERE id = ?")) {

        die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);

    }

    if (!$stmt->bind_param("ii", $id_e, $id_u)) {

        die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);

    }

    if (!$stmt->execute()) {

        die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);

    }

    $stmt->close();

    $_SESSION['tipo-mensaje'] = "success";
    $_SESSION['mensaje'] = "EMPRESA CREADA CORRECTAMENTE CODIGO: " . $codigo_f;
    
    header("Location: ../index.php");

}

unset($codigo_n);
unset($codigo_2);
unset($codigo_s);
unset($codigo_r);
unset($codigo_f);
unset($id_e);

include('../includes/footer.php');

?>