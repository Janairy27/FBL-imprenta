<?php
/**Obtencion de todos los parametros de la base de datos */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'imprenta';

$direccion = './Respaldos/';

/**Verificar si la carpeta existe, si no existe se crea y se le asignan los 
 * permisos
 */
if(!is_dir($direccion)){
    mkdir($direccion, 0777, true);
}

/**Asignación del nombre del archivo, incluyendo fecha y hora
 * para tener un mejor control de los respaldos
 */
$copiaBD = $direccion . 'respaldo_' . date('Y-m-d_H-i-s') . '.sql';

/**Comando que servira para generar el respaldo */
$cmd = "mysqldump -u $user -p$pass $db > $copiaBD";
/**Ejecución del comando */
exec($cmd, $output, $retorno);

/**Validar que el respaldo se realizo de forma exitosa */
if($retorno == 0){
    $message = "Respaldo realizado con éxito.";
    $message_type = "success";
}else{
    echo "Sucedió un error al realizar el respaldo";
    $message = "Sucedio un problema al realizar el respaldo.";
    $message_type = "danger";
}
header("Location: ../Vista/respaldo&restauracion.php?message=" . urlencode($message) . "&type=" . $message_type);
exit;

?>
