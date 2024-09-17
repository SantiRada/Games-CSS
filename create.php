<?php

    include('config.php');
    
    session_start();
    if(!isset($_SESSION['name'])): header('Location: index.php'); exit; endif;

    $msg = $_GET['msg'] ?? "";
    $filter = $_GET['filter'] ?? "tools";

    if(isset($_POST['create-games'])):
        $title = $_POST['title'] ?? "";
        $description = $_POST['description'] ?? "";
        $chips = $_POST['chips'] ?? "";

        $restest = mysqli_query($con, "select * from games where title = '".$title."';");

        if(mysqli_num_rows($restest) > 0):
            $msg = "Este Juego ya está en la base de datos";
            header('Location: create.php?filter=games&msg=' . $msg);
            exit;
        endif;

        $res = mysqli_query($con, "insert into games (title, description, chips) values ('".$title."','".$description."','".$chips."');");

        if($res): header('Location: index.php?msg=si');
        else:
            $msg = "Error al crear el juego, intentelo de nuevo más tarde.";
            header('Location: create.php?filter=games&msg=' . $msg);
            exit;
        endif;
    endif;

    if(isset($_POST['create-tools'])):
        $link = $_POST['link'] ?? "";
        $img = $_POST['img'] ?? "";
        $title = $_POST['title'] ?? "";
        $description = $_POST['description'] ?? "";

        $restest = mysqli_query($con, "select * from tools where title = '".$title."';");

        if(mysqli_num_rows($restest) > 0 ):
            $msg = "Este Herramienta ya está en la base de datos.";
            header('Location: create.php?filter=tools&msg=' . $msg);
            exit;
        endif;

        $res = mysqli_query($con, "insert into tools (link,img,title,description) values ('".$link."','".$img."','".$title."','".$description."');");

        if($res): header('Location: index.php');
        else:
            $msg = "Error al crear la herramienta, intentelo de nuevo más tarde.";
            header('Location: create.php?filter=tools&msg=' . $msg);
            exit;
        endif;
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear <?php if($filter == "tools"): echo "Herramienta"; else: echo "Juego"; endif; ?></title>
    <!-- STYLES -->
    <link rel="preconnect" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <script src="https://kit.fontawesome.com/8e77509853.js" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <h1>Crear <?php if($filter == "tools"): echo "Herramienta"; else: echo "Juego"; endif; ?></h1>
        <form method="post" class="form-distance">
            <?php if($filter == "games"): ?>
                <div class="grid-2">
                    <div class="input-content">
                        <label for="title">Título</label>
                        <input type="text" class="input" name="title" id="title" required>
                    </div>
                    <div class="input-content">
                        <label for="description">Descripción</label>
                        <input type="text" class="input" name="description" id="description" required>
                    </div>
                </div>
                <div class="input-content">
                        <label for="chips">Chips</label>
                        <input type="text" class="input" name="chips" id="chips" required>
                    </div>
                <input type="submit" class="button-primary" name="create-games" value="Crear Juegos">
            <?php elseif($filter == "tools"): ?>
                <div class="grid-2">
                    <div class="input-content">
                        <label for="link">Link del Sitio</label>
                        <input type="text" class="input" name="link" id="link" required>
                    </div>
                    <div class="input-content">
                        <label for="img">Link a la Imagen</label>
                        <input type="text" class="input" name="img" id="img" required>
                    </div>
                    <div class="input-content">
                        <label for="title">Título</label>
                        <input type="text" class="input" name="title" id="title" required>
                    </div>
                    <div class="input-content">
                        <label for="description">Descripción</label>
                        <input type="text" class="input" name="description" id="description" required>
                    </div>
                </div>
                <input type="submit" class="button-primary" name="create-tools" value="Crear Herramienta">
            <?php endif; ?>
        </form>
    </main>
</body>
</html>