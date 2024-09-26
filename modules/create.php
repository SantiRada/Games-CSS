<?php
    include('config.php');
    session_start();
    
    if(!isset($_SESSION['name'])): header('Location: ../index.php'); exit; endif;

    $msg = $_GET['msg'] ?? "";
    $filter = $_GET['filter'] ?? "tools";
    
    $type = "";
    switch($filter):
        case "tools": $type = "Herramientas"; break;
        case "games": $type = "Juegos"; break;
        case "slides": $type = "Slides"; break;
        case "docs": $type = "Documetación"; break;
    endswitch;

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



        if($res): header('Location: ../index.php?msg=Creación exitosa');

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



        if($res): header('Location: ../index.php');

        else:

            $msg = "Error al crear la herramienta, intentelo de nuevo más tarde.";

            header('Location: create.php?filter=tools&msg=' . $msg);

            exit;

        endif;

    endif;

    if(isset($_POST['create-slides'])):
        $name = $_POST['name'] ?? "";
        $numclass = $_POST['numclass'] ?? "";
        $link = $_POST['link'] ?? "";
        $tags = $_POST['tags'] ?? "";

        $sql = "insert into slides (name,numclass,link,tags) values ('".$name."','".$numclass."','".$link."','".$tags."');";
        $res = mysqli_query($con, $sql);

        if($res): $msg = "La presentación se ha creado con éxito.";
        else: $msg = "Falló la conexión al servidor, intentalo de nuevo más tarde."; endif;

        header('Location: create.php?filter=' . $filter . '&msg=' . $msg);
    endif;

    if(isset($_POST['create-docs'])):
        $name = $_POST['name'] ?? "";
        $description = $_POST['description'] ?? "";
        $img = $_POST['img'] ?? "";
        $link = $_POST['link'] ?? "";

        $sql = "insert into docs (name,description,img,link) values ('".$name."','".$description."','".$img."','".$link."');";
        $res = mysqli_query($con, $sql);

        if($res): $msg = "La documetación se ha creado con éxito.";
        else: $msg = "Falló la conexión al servidor, intentalo de nuevo más tarde."; endif;

        header('Location: create.php?filter=' . $filter . '&msg=' . $msg);
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear <?php echo $type; ?></title>
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
    <main>
        <h1>Crear <?php echo $type; ?></h1>
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
            <?php elseif($filter == "slides"): ?>
                <div class="grid-2">
                    <div class="input-content">
                        <label for="name">Título de la Clase</label>
                        <input type="text" class="input" name="name" id="name" required>
                    </div>
                    <div class="input-content">
                        <label for="numclass">Número de Clase</label>
                        <select class="input" name="numclass" required>
                            <option disabled selected>Número de Clase</option>
                            <?php for($i = 0; $i < 60; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="input-content">
                        <label for="link">Link de las Slides</label>
                        <input type="text" class="input" name="link" id="link" required>
                    </div>
                    <div class="input-content">
                        <label for="tags">Tags (Separados por coma)</label>
                        <input type="text" class="input" name="tags" id="tags" required>
                    </div>
                </div>
                <input type="submit" class="button-primary" name="create-slides" value="Crear Slides">
            <?php elseif($filter == "docs"): ?>
                <div class="grid-2">
                    <div class="input-content">
                        <label for="name">Nombre de la Documetación</label>
                        <input type="text" class="input" name="name" id="name" required>
                    </div>
                    <div class="input-content">
                        <label for="description">Descripción de la documentación</label>
                        <input type="text" class="input" name="description" id="description" required>
                    </div>
                    <div class="input-content">
                        <label for="img">Link de la Imagen (logo)</label>
                        <input type="text" class="input" name="img" id="img" required>
                    </div>
                    <div class="input-content">
                        <label for="link">Link a la Documentación</label>
                        <input type="text" class="input" name="link" id="link" required>
                    </div>
                </div>
                <input type="submit" class="button-primary" name="create-docs" value="Crear Documentación">
            <?php endif; ?>
        </form>
    </main>
</body>
</html>