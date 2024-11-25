<?php include '..Modelo/scriptdb.php'; ?>

<?php

/**Funciones para ingresar al empleado en la tabla que le corresponde */
$nomb = $_POST['nombre'];
$apat = $_POST['apaterno'];
$amat = $_POST['amaterno'];
$nacim = $_POST['fecha'];
$direc = $_POST['direccion'];
$tel = $_POST['telefono'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];

$sql = "insert into empleado(nombre, apaterno, amaterno, fecnaci, direccion, telefono,
    correo, rol) values ('$nomb', '$apat', '$amat', '$nacim', '$direc', $tel,
    '$correo', '$rol');";

$exectute = mysqli_query($conn, $sql);
sleep(2);

/**Obtener el ultimo registro ingresado para poder modificar de
 * forma personalizada en docigo del empleado  */
$ultimo = $conn->inset_id;

$nom = strtoupper(substr($nomb, 0, 2));
$pat = strtoupper(substr($apat, 0, 2));
$mncpio = strtoupper(substr($direc, 0, 1));
$numero = random_int(1, 500);
$codigo = $pat . $nom . $numero . $mncpio;

$query = "update usuarios set codigo = '$codigo' where id = $ultimo;";
$exec = mysqli_query($conn, $query);

/**Ingreso del nuevo usuario a la tabla, dependiendo de las credenciales
 * ya registradas*/

$nombre = strtoupper(substr($nomb, 0, 3));
$patern = strtoupper(substr($apat, 0, 3));
$fecha = new DateTime($nacim);
$nume = $fecha->format('Y'); // Devuelve el año como cadena

$user = $nombre . $patern . $nume;



header("Location:../Vista/empleado.php");



?>