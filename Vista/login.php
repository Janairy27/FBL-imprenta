<link rel="stylesheet" href="css/styles.css">
<div class="contenedor-login " id="contenedor-login">
    <div class="form-contenedor sign-in">
        <!--Formulario de inicio de sesión donde se intengran todos los 
componentes visibles  -->
        <form method="POST" name="frmlogin" id="frmlogin" action="../Controlador/validacionusuario.php">
            <h1>Inicio de sesión</h1>
            <span>Usa tú código para iniciar sesión</span>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario">
            <p class="alert alert-danger" id="us" name="us" style="display: none;">
                Favor de ingresar información valida</p>
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
            <p class="alert alert-danger" id="con" name="con" style="display: none;">
                Favor de llenar el campo</p>
            <a href="#">¿Olvidaste tú contraseña?</a>
            <button type="submit" class="button-login">Iniciar sesión</button>
            <p class="alert alert-success" id="btn" name="btn" style="display: none;">
                Enviando datos</p>
            <script src="../Controlador/js/validaciones.js"></script>
        </form>

    </div>
    <div class="pestana-contenedor">
        <div class="pestana">
            <div class="panel-pestana">
                <h1>Bienvenido</h1>
            </div>
        </div>
    </div>
</div>