<?php include '../Modelo/conector/scriptdb.php'; ?>

<?php
session_start();
/*Variables para obtener el usuario con el que se ha iniciado sesión
y denegar el acceso en caso que no alla iniciado sesión anteriormente*/

$user = $_POST['usuario'];
$password = $_POST['contrasena'];


$sql = "select u.usuario, u.contrasena, e.rol 
    from usuarios u inner join empleado e on u.idempleado = e.idempleado 
    where u.usuario = '$user' and u.contrasena = '$password';";

$execute = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($execute);

/* Validar los roles de los empleados para así poder mostrarle las diferentes
vistas dependiendo de los roles */
if($row){
    /**Asignar la sesión y redireccionar a las vistas correspondientes */
    $_SESSION['usuario'] = $user;
    if($row['rol'] == "Representante"){
        header("Location: ../Vista/administrador.php"); 
    }elseif($row['rol'] == "Practicante"){
        header("Location: ../Vista/practicante.php");  
    }elseif($row['rol'] == "Empleado"){
        header("Location: ../Vista/empleado.php"); 
    }else{
        /**Rediriguir al login en caso de no ser niinguna opción */
        header("Location:../Vista/login.php");
    }
}


?>