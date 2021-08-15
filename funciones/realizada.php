<?php
include("../bd.php");

if (isset($_GET)) {
    $id = $_GET['id'];
    $query = "UPDATE task set estado='realizado' WHERE id='$id'";
    $result = mysqli_query($conectarbd, $query);
    if (!$result) {
        die("Error a Cambiar Estado");
    }else {
        header("Location: ../index.php");
    }
}

?>