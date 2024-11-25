<?php
/* Conexión a la base de datos */

$conn= mysqli_connect(
    'localhost',
    'root',
    '',
    'imprenta'
);

/**Si la conexión falla se moestrará un mensaje mencionando el error de la conexión */
if(!$conn){
    die("Error de conexión: " . mysqli_connect_error());
}

