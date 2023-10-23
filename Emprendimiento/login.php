<?php
include_once 'conexion/conexion.php';

$contraseñaActualizadaMensaje = ' ';

if (isset($_POST['ingresar'])) {
    $usuario = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = "SELECT idusuarios, password FROM usuarios WHERE nombreusuario='$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start(); // Iniciar sesión solo si las credenciales son correctas
            $_SESSION['id_usuario'] = $row['idusuarios'];
            header("Location: plataformaTec/admin.php");
            exit;
        } else {
            echo "<script>
                    alert('Usuario o Contraseña Incorrectos...!!!');
                    window.location='login.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Usuario o Contraseña Incorrectos...!!!');
                window.location='login.php';
              </script>";
        exit;
    }
}

if (isset($_POST["registrar"])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $usuario = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    // Utiliza password_hash para almacenar la contraseña de forma segura
    $password_encriptada = password_hash($password, PASSWORD_BCRYPT);

    $sqluser = "SELECT idusuarios FROM usuarios WHERE nombreusuario='$usuario'";
    $resultadouser = $conn->query($sqluser);

    if ($resultadouser->num_rows > 0) {
        echo "<script>
                alert('El usuario ya existe...!');
              </script>";
    } else {
        $sqlusuario = "INSERT INTO usuarios(nombre, correo, nombreusuario, password) 
                       VALUES ('$nombre','$correo','$usuario','$password_encriptada')";
        $resultadousuario = $conn->query($sqlusuario);

        if ($resultadousuario) {
            echo "<script>
                    alert('El usuario se Registró Correctamente!!!');
                    window.location='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al registrar el usuario...!!!');
                    window.location='login.php';
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6e13c19de6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Emprendimiento//estilos/style.css">
</head>
<body>
    <section>
        <div class="conteiner">
            <div class="formulario-container">
            <h1>RodriTecnologic</h1>
                <div class="formulario active" id="login-form">
                    <!-- Contenido del formulario de inicio de sesión -->
                    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <label>
                            <input type="text" class="form-control" name="user" placeholder="Usuario" required />
                        </label>
                        <label>
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" required />
                        </label>
                        <button type="submit" name="ingresar" class="width-35 pull-right btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Ingresar</span>
                        </button>
                        <!-- Mostrar mensaje de contraseña actualizada -->
                        <?php if (!empty($contraseñaActualizadaMensaje)): ?>
                            <p class="password-updated-message" style="margin-top: 25px;"><?php echo $contraseñaActualizadaMensaje; ?></p>
                        <?php endif; ?>
                    </form>
                    <!-- Fin del contenido del formulario de inicio de sesión -->
                </div>
                <div class="formulario" id="register-form">
                    <!-- Contenido del formulario de registro -->
                    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre Completo" required />
                        </label>
                        <label>
                            <input type="email" class="form-control" name="correo" placeholder="Email" required />
                        </label>
                        <label>
                            <input type="text" class="form-control" name="user" placeholder="Usuario" required />
                        </label>
                        <label>
                            <input type="password" class="form-control" name="pass" placeholder="Password" required />
                        </label>
                        <label>
                            <input type="checkbox" class="ace" />
                            <span class="lbl"> Acepto los <a href="otros/terminoUso.php">Términos de Uso</a></span>
                        </label>
                        <div class="clearfix">
                            <button type="submit" name="registrar" class="width-65 pull-right btn btn-sm btn-success">
                                <span class="bigger-110">Registrar</span>
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="ace-icon fa fa-refresh"></i>
                                <span class="bigger-110">Reset</span>
                            </button>
                        </div>
                    </form>
                    <!-- Fin del contenido del formulario de registro -->
                </div>
                <div class="formulario" id="forgot-password-form">
                    <!-- Contenido del formulario de recuperación de contraseña -->
                    <form>
                        <label>
                            <input type="email" class="form-control" placeholder="Email" />
                        </label>
                        <div class="clearfix">
                            <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                <span class="bigger-110">Enviar</span>
                            </button>
                        </div>
                    </form>
                    <!-- Fin del contenido del formulario de recuperación de contraseña -->
                </div>
                <div class="formulario-opciones">
                    <button onclick="showLoginForm()">Iniciar Sesión</button>
                    <button onclick="showRegisterForm()">Nuevo Registro</button>
                    <button onclick="showForgotPasswordForm()">Recuperar Contraseña</button>
                </div>
                <div class="footer">
                    <footer>
                        <p>&copy; Derechos Reservados de Autor - RodriTecnologic - 2023</p>
                        <div class="redes-sociales-footer">
                            <div class="enlaces">
                                <a href="#" class="icono"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#" class="icono"><i class="fa-brands fa-whatsapp"></i></a>
                                <a href="#" class="icono"><i class="fa-brands fa-square-youtube"></i></a>
                                <a href="#" class="icono"><i class="fa-brands fa-facebook-messenger"></i></a>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </section>
    <script>
        function showLoginForm() {
            document.getElementById("login-form").classList.add("active");
            document.getElementById("register-form").classList.remove("active");
            document.getElementById("forgot-password-form").classList.remove("active");
        }

        function showRegisterForm() {
            document.getElementById("login-form").classList.remove("active");
            document.getElementById("register-form").classList.add("active");
            document.getElementById("forgot-password-form").classList.remove("active");
        }

        function showForgotPasswordForm() {
            document.getElementById("login-form").classList.remove("active");
            document.getElementById("register-form").classList.remove("active");
            document.getElementById("forgot-password-form").classList.add("active");
        }

        // Mostrar el formulario de inicio de sesión por defecto
        showLoginForm();
    </script>
</body>
</html>
