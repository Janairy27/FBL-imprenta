<?php
// Configuración de la base de datos
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // Asegúrate de que sea el password correcto
$db_name = 'imprenta';

// Configuración de directorio y zona horaria
$direccion = './Respaldos/';
date_default_timezone_set('America/Mexico_City');

// Variable para el mensaje
$message = '';
$message_type = ''; // success o danger para estilos Bootstrap

try {
    // Verifica si el directorio de respaldo existe, si no, lo crea
    if (!is_dir($direccion)) {
        if (!mkdir($direccion, 0755, true)) {
            throw new Exception("No se pudo crear el directorio de respaldo.");
        }
    }

    // Detectar el sistema operativo
    $os = PHP_OS;
    $mysqldump_path = '';

    if (stripos($os, 'WIN') === 0) {
        $mysqldump_path = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump"';
    } elseif (stripos($os, 'Darwin') === 0) {
        $mysqldump_path = '/Applications/XAMPP/xamppfiles/bin/mysqldump';
    } elseif (stripos($os, 'Linux') === 0) {
        $mysqldump_path = '/usr/bin/mysqldump';
    } else {
        throw new Exception("Sistema operativo no soportado.");
    }

    // Verificar si el archivo mysqldump existe
    if (!file_exists($mysqldump_path)) {
        throw new Exception("No se encuentra el archivo mysqldump en la ruta especificada para $os.");
    }

    // Nombre del archivo de respaldo
    $nombreCopia = $direccion . $db_name . '_respaldo_' . date('Y-m-d_H-i-s') . '.sql';

    // Comando para generar el respaldo
    $command = sprintf(
        '%s --user=%s --password=%s --host=%s %s > %s',
        escapeshellcmd($mysqldump_path),
        escapeshellarg($db_user),
        escapeshellarg($db_pass),
        escapeshellarg($db_host),
        escapeshellarg($db_name),
        escapeshellarg($nombreCopia)
    );

    // Ejecutar el comando
    exec($command, $output, $return_var);

    if ($return_var !== 0) {
        throw new Exception("Sucedió un error al realizar el respaldo.");
    }

    // Configuración de permisos
    if ($os === 'WINNT') {
        $cmdPermisos = sprintf('icacls "%s" /grant Everyone:F', escapeshellarg($nombreCopia));
    } else {
        $cmdPermisos = sprintf('chmod 755 %s', escapeshellarg($nombreCopia));
    }

    exec($cmdPermisos, $outputPermisos, $retornoPermisos);

    if ($retornoPermisos !== 0) {
        throw new Exception("Respaldo realizado, pero ocurrió un problema al configurar los permisos.");
    }

    // Éxito
    $message = "Respaldo realizado con éxito.";
    $message_type = "success";

} catch (Exception $e) {
    $message = $e->getMessage();
    $message_type = "danger";
}

// Redirigir con mensaje
header("Location: ../Vista/respaldo&restauracion.php?message=" . urlencode($message) . "&type=" . $message_type);
exit;
?>
