<?php

//INCLUIR LOS ARCHIVOS NESESARIOS
include("../bd.php");
include("../includes/header.php");
include("../includes/ver_login.php");


?>

<div class="continer p-4 align-items-center">

    <div class="row justify-content-center">

        <div class="col-md-auto">

            <div class="card card-body">
                
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                
                    <div class="form-group my-1">

                        <label> Ingresa el codigo de la empresa:
                            <input type="text" class="form-control" limit="5" placeholder="00000" name="cod_empresa">
                        </label>

                        <input type="submit" name="btn_submit" value="Verificar" class="btn btn-success">

                    </div>
            
                </form>

            </div>

        </div>

    </div>

</div>


<?php

if (isset($_POST["btn_submit"])) {

    //TRAER LOS DATOS A CONSULTAR
    $cod_empresa = $_POST["cod_empresa"];

    //CREAR EL QUERY Y PREPARAR EL QUERY
    $query = "SELECT * FROM empresas WHERE codigo=?";
    $stmt = $bd->prepare($query);

    //VERIFICAR QUE LA PREPARACION SEA CORRECTA
    if (!$stmt) {

        echo "Error en la preparacion: (" . $bd->errno . ") " . $bd->error;

    }else {
        
        //ASOCIAR VARIABLES A EL QUERY
        $exito = $stmt->bind_param("i", $cod_empresa);

        if (!$exito) {

            echo "Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error;
        
        }else {
            
            //EJECUTAMOS LA SENTENCIA
            $exito = $stmt->execute();

            if (!$exito) {

                echo "Error en la ejecucion: (" . $stmt->errno . ")" . $stmt->error;

            }else {

                //VINCULAMOS LOS DATOS DEVUELTOS
                $exito = $stmt->bind_result($id, $nombre, $codigo_empresa);

                if ($exito) {

                    $stmt->fetch();

                    $stmt->close();
                    
                    $ver_cod = true;

                }else {

                    $ver_cod = false;

                }

            }

        }

    }

}

if (isset($ver_cod)) {

    if (!$ver_cod) {

        echo "Error en la vinculacion de datos devueltos: (" . $stmt->errno . ")" . $stmt->error;

    }else {

        if ($codigo_empresa == $cod_empresa) {

            $id_u = $_SESSION['id'];

            $query = "UPDATE users SET id_empresas = ? WHERE id = ?";

            $stmt = $bd->prepare($query);

            if (!$stmt) {

                echo "Error en la preparacion: (" . $bd->errno . ")" . $bd->error;

            }else {

                $exito = $stmt->bind_param('ii',$id, $id_u);

                if (!$exito) {

                    echo "Error en la vinculacion de parametros: (" . $stmt->errno . ")" . $stmt->error;

                }else {

                    $exito = $stmt->execute();

                    if (!$exito) {

                        echo "Error en la ejecucion: (" . $stmt->errno . ")" . $stmt->error;

                    }else {

                        $stmt->close();

                        $_SESSION['mensaje'] = "Ha Ingresado Correctamente A Su Empresa";
                        $_SESSION['tipo_mensaje'] = "success";

                        header('Location: ../index.php');

                    }

                }

            }

        }else {

?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                NO SE ENCONTRO NINGUNA EMPRESA CON ESE CODIGO
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

<?php

        }

    }

}

?>