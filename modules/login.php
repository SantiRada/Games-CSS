<?php
    include('config.php');

    $msg = $_GET['msg'] ?? "";
    $filter = $_GET['filter'] ?? "login";

    if(isset($_POST['login'])):
        $mail = $_POST['mail'] ?? "";
        $pass = $_POST['pass'] ?? "";

        $restest = mysqli_query($con, "select * from admin where mail = '".$mail."' and pass = '".md5($pass)."';");

        if(mysqli_num_rows($restest) > 0):
            $row = mysqli_fetch_assoc($restest);
            
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['mail'] = $row['mail'];

            if($row['mail'] == "santynrada@gmail.com"): $_SESSION['type'] = "admin";
            else: $_SESSION['type'] = "user"; endif;

            header("Location: ../index.php");
            exit;
        else:
            $msg = "Correo o contraseña incorrectas,<br> intentalo nuevamente.";
            header('Location: login.php?msg=' . $msg);
            exit;
        endif;
    endif;

    if(isset($_POST['register'])):
        $name = $_POST['name'] ?? "";
        $mail = $_POST['mail'] ?? "";
        $pass = $_POST['pass'] ?? "";
        $passtwo = $_POST['passtwo'] ?? "";

        if($pass !== $passtwo):
            $msg = "Las contraseñas no coinciden.";
            header('Location: login.php?msg=' . $msg);
            exit;
        endif;

        $restest = mysqli_query($con, "select * from admin where mail = '".$mail."';");
        if(mysqli_num_rows($restest) > 0):
            $msg = "El correo electrónico ya existe.";
            header('Location: login.php?msg=' . $msg);
            exit;
        endif;

        $res = mysqli_query($con, "insert into admin (name, mail, pass) values ('".$name."', '".$mail."','".md5($pass)."');");

        if($res):
            $row = mysqli_fetch_assoc(mysqli_query($con, "select * from admin where mail = '".$mail."';"));

            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['mail'] = $row['mail'];
            $_SESSION['type'] = "user";

            header("Location: ../index.php");
            exit;
        else:
            $msg = "Fallo en la base de datos, intentelo de nuevo más tarde.";
            header('Location: login.php?msg=' . $msg);
            exit;
        endif;
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games CSS - Santiago Rada</title>
    <!-- STYLES -->
    <link rel="preconnect" href="../style/style.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <script src="https://kit.fontawesome.com/8e77509853.js" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
</head>
<body>
    <main id="login-space">
        <a href="../index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Inicio</a>
            <?php if($filter == "login"): ?>
                <section id="login">
                    <h1>Iniciar Sesión</h1>
                    <form method="post">
                        <div class="input-content">
                            <label for="mail">Correo Electrónico</label>
                            <input type="mail" class="input" id="mail" name="mail" autofocus required>
                        </div>

                        <div class="input-content">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="input" id="pass" name="pass" required>
                        </div>
                        <?php if(!empty($msg)): ?><p class="error"><?php echo $msg; ?></p><?php endif; ?>
                        <input type="submit" name="login" class="button button-primary" value="Iniciar Sesión">
                        <a href="login.php?filter=register" class="btn-nav">¿No tienes una cuenta? Registrarse</a>
                    </form>
                </section>
            <?php elseif($filter == "register"): ?>
                <section id="register">
                    <h1>Registrarse</h1>
                    <form method="post">
                        <div class="input-content">
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" class="input" id="name" name="name" required>
                        </div>

                        <div class="input-content">
                            <label for="mail">Correo Electrónico</label>
                            <input type="mail" class="input" id="mail" name="mail" required>
                        </div>

                        <div class="input-content">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="input" id="pass" name="pass" required>
                        </div>

                        <div class="input-content">
                            <label for="passtwo">Repetir Contraseña</label>
                            <input type="password" class="input" id="passtwo" name="passtwo" required>
                        </div>
                        <?php if(!empty($msg)): ?><p class="error"><?php echo $msg; ?></p><?php endif; ?>
                        <input type="submit" name="register" class="button-primary" value="Registrarse">
                        <a href="login.php?filter=login" class="btn-nav">¿Ya tienes una cuenta? Iniciar Sesión</a>
                    </form>
                </section>
            <?php endif; ?>
        </section>

        <footer id="footer">
            <h3>Santiago Rada</h3>
            <ul class="list-h">
                <li><a class="btn-icon" href="https://instagram.com/santiagonrada" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a class="btn-icon" href="https://linkedin.com/in/santiago-rada" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                <li><a class="btn-icon" href="https://github.com/SantiRada" target="_blank"><i class="fa-brands fa-github"></i></a></li>
            </ul>
        </footer>
    </main>
</body>
</html>
