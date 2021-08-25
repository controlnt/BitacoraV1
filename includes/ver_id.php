
<?php

if(!isset($_SESSION)) 
{ 
        session_start(); 
}
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM users WHERE usuario = '$usuario'";
$resultados_id = mysqli_query($conectarbd, $query);
$fila = mysqli_fetch_array($resultados_id);
echo $fila['id'];

?>