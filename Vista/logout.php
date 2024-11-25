<?php include '../Modelo/conector/scriptdb.php' ?>
<?php include '../Vista/includes/header.php' ?>

<?php
    session_start();
    session_destroy();
    header("Location: ../index.html");

?>