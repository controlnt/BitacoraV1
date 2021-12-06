<?php

include("../bd.php");
include("../includes/header.php");
include("../includes/verificar.php");

if (isset($_POST['btn_rol'])) {

    $grupos_a = $_POST['grupos_a'];
    $grupos_c = $_POST['grupos_c'];

    if (!$stmt = $bd->prepare("SELECT id FROM grupos WHERE nombre = ?")) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $bd->errno . ")" . $bd->error);
    }

    if (!$stmt->bind_param('s', $grupos_a)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->bind_result($id_a)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    $stmt->fetch();
    $stmt->close();


    if (!$stmt = $bd->prepare("SELECT id FROM grupos WHERE nombre = ?")) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $bd->errno . ")" . $bd->error);
    }

    if (!$stmt->bind_param('s', $grupos_c)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->bind_result($id_c)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    $stmt->fetch();
    $stmt->close();

    if (isset($_POST['Bitacora/Crear'])) {
        $b_crear = $_POST['Bitacora/Crear'];
    }else {
        $b_crear = "off";
    }
    if (isset($_POST['Bitacora/Consultar'])) {
        $b_consultar = $_POST['Bitacora/Consultar'];
    }else {
        $b_consultar = "off";
    }
    if (isset($_POST['Informes/Consultar'])) {
        $i_consultar = $_POST['Informes/Consultar'];
    }else {
        $i_consultar = "off";
    }
    if (isset($_POST['Informes/Asignar'])) {
        $i_asignar = $_POST['Informes/Asignar'];
    }else {
        $i_asignar = "off";
    }
    if (isset($_POST['Permisos/Roles'])) {
        $p_roles = $_POST['Permisos/Roles'];
    }else {
        $p_roles = "off";
    }
    if (isset($_POST['Permisos/Grupos'])) {
        $p_grupos = $_POST['Permisos/Grupos'];
    }else {
        $p_grupos = "off";
    }
    $nombre = $_POST['nombre'];

    $modulos = $b_crear . " " . $b_consultar . " " . $i_consultar . " " . $i_asignar . " " . $p_roles . " ". $p_grupos;

    if (!$stmt = $bd->prepare("INSERT INTO roles(rol, modulos, id_grupos_c, id_grupos_a) VALUES (?, ?, ?, ?)")) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $bd->errno . ")" . $bd->error);
    }

    if (!$stmt->bind_param('ssii', $nombre, $modulos, $id_c, $id_a)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    $stmt->close();

    $g_aplicar = $_POST['g_aplicar'];

    if (!$stmt = $bd->prepare("SELECT id FROM roles WHERE rol = ?")) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $bd->errno . ")" . $bd->error);
    }

    if (!$stmt->bind_param('s', $nombre)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->bind_result($id_aplicar)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    $stmt->fetch();
    $stmt->close();

    if (!$stmt = $bd->prepare("UPDATE grupos SET id_roles = ? WHERE nombre = ?")) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $bd->errno . ")" . $bd->error);
    }

    if (!$stmt->bind_param('is', $id_aplicar, $g_aplicar)) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error en la consulta comuniquese al soporte y envie este error: (" . $stmt->errno . ")" . $stmt->error);
    }

    $stmt->close();
}

?>

<div>
    <div>
            <h1>Crear Rol</h1>
    </div>
    <form action="roles.php" method="post">
        <div>
            <input type="text" name="nombre" placeholder="Nombre Del Rol" required>
        </div>
        <div>
            <p>Grupo quien se le va a aplicar el rol</p>
            <div>
                <select name="g_aplicar">
<?php
                $id_e = $_SESSION['id_e'];

                $query = "SELECT id, nombre, id_empresas FROM grupos WHERE id_empresas = ?";

                if (!$stmt = $bd->prepare($query)) {
                    die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
                }

                if (!$stmt->bind_param('i', $id_e)) {
                    die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);
                }

                if (!$stmt->execute()) {
                    die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
                }

                if (!$stmt->bind_result($id_g, $nombre_g, $id_e_g)) {
                    die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);
                }

                while ($stmt->fetch()) {
?>
                    <option value="<?= $nombre_g ?>"><?= $nombre_g ?></option>
<?php
                }
                if (!$stmt = $bd->query("SELECT * FROM modulos")) {
                    die("Error en el query: (" . $bd->errno . ")" . $bd->error);
                }
?>
                </select>
            </div>
        </div>
        <div>
            <h2>Modulos</h2>
<?php
            while ($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
?>
                <label> 
                    <input type="checkbox" name="<?=$row['nombre']?>">
                    <?=$row['nombre']?>
                </label>
<?php
            }
            $stmt->close();
            

            $id_e = $_SESSION['id_e'];

            $query = "SELECT id, nombre, id_empresas FROM grupos WHERE id_empresas = ?";

            if (!$stmt = $bd->prepare($query)) {
                die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
            }

            if (!$stmt->bind_param('i', $id_e)) {
                die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);
            }

            if (!$stmt->execute()) {
                die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
            }

            if (!$stmt->bind_result($id_g, $nombre_g, $id_e_g)) {
                die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);
            }
?>
        </div>
        <div>
            <h2>Grupos</h2>
            <div id="g_consultar">
                <p>Grupos a poder consultar</p>
                <select name="grupos_c">
                    <option value="Selecionar">Selecionar</option>
<?php
                while ($stmt->fetch()) {
?>
                    <option value="<?= $nombre_g ?>"> <?= $nombre_g ?> </option>
<?php
                }
                $stmt->close();
?>
                </select>
            </div>
<?php
            $query = "SELECT id, nombre, id_empresas FROM grupos WHERE id_empresas = ?";

            if (!$stmt = $bd->prepare($query)) {
                die("Error en la preparacion del query: (" . $bd->errno . ")" . $bd->error);
            }

            if (!$stmt->bind_param('i', $id_e)) {
                die("Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error);
            }

            if (!$stmt->execute()) {
                die("Error en la ejecucion: (" . $stmt->errno . ")" .  $stmt->error);
            }

            if (!$stmt->bind_result($id_g, $nombre_g, $id_e_g)) {
                die("Error en la vinculacion de resultados1: (" . $stmt->errno . ")" . $stmt->error);
            }
?>
            <div>
                <p>Grupos a poder Asignar</p>
                <select name="grupos_a">
                    <option value="Selecionar">Selecionar</option>
<?php
                while ($stmt->fetch()) {
?>
                    <option value="<?= $nombre_g ?>" id="<?= $nombre_g ?>"> <?= $nombre_g ?> </option>
<?php
                }
?>
                </select>
            </div>
        </div>
        <p>Deje este espacio vacio si no ha selecionado los modulos: Informes/Consultar, Informes/Asignar</p>
        <div>
            <input type="submit" value="Crear Rol" name="btn_rol">
        </div>
    </form>
</div>
<?php

include("../includes/footer.php");

?>