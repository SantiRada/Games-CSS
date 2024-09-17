<?php
    session_start();
    include('../../config.php');

    $msg = $_GET['msg'] ?? "";

    if(isset($_POST['create-level'])):
        $code1 = $_POST['code1'] ?? "";
        $code2 = $_POST['code2'] ?? "";
        $correct = $_POST['correct'] ?? "";

        $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata order by id desc limit 1;"));

        $numlevel = ($row['numlevel'] + 1);
        $correct = $correct == 1 ? $code1 : $code2;
        $content = [
            "code1" => $code1,
            "code2" => $code2
        ];
        $data = json_encode($content);

        $sql = "insert into leveldata (idgame,numlevel,instruction,correct,content) values (2,'".$numlevel."','','".$correct."','".$data."');";
        $res = mysqli_query($con, $sql);

        if($res):
            $msg = "Nivel creado con éxito";
        else:
            $msg = "Falló la conexión al servidor, intentalo de nuevo más tarde.";
        endif;

        header('Location: create.php?msg=' . $msg);
        exit;
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de Battle of Selectors</title>
    <!-- STYLES -->
    <link rel="preconnect" href="../../guidelines.css">
    <link rel="stylesheet" href="../../guidelines.css">
    <link rel="preconnect" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <!-- SCRIPT -->
    <script src="https://kit.fontawesome.com/8e77509853.js" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php if(!empty($msg)): ?><p class="notification"><?php echo $msg; ?></p><?php endif; ?>
    <form method="post">
        <section id="base" name="correct">
            <div class="between">
                <a href="index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Juego</a>
                <select class="select">
                    <option disabled selected>Opción Correcta</option>
                    <option value="1">Arriba</option>
                    <option value="2">Abajo</option>
                </select>
            </div>
        </section>

        <main>
            <section id="distribution">
                <input id="button-1" class="show-input" name="code1" placeholder="Caso 1" required>
                <input id="button-2" class="show-input" name="code2" placeholder="Caso 2" required>
                <input type="submit" value="Guardar nivel" class="button-primary" name="create-level">
            </section>
        </main>
    </form>
</body>
</html>