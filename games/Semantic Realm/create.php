<?php
    session_start();
    include('../../modules/config.php');

    $msg = $_GET['msg'] ?? "";

    if(isset($_POST['create'])):
        $instruction = $_POST['instruction'] ?? "";
        $correct = $_POST['correct'] ?? "";
        $content = $_POST['content'] ?? "";

        $idgame = 5;
        $rowverify = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '5' order by id desc limit 1;"));
        if($rowverify): $level = $rowverify['numlevel'] + 1;
        else: $level = 1; endif;

        $instruction = html_entity_decode($instruction, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $correct = html_entity_decode($correct, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $data = [ "content" => $content ];
        $json = json_encode($data, JSON_PRETTY_PRINT);

        $stmt = $con->prepare("insert into leveldata (idgame, numlevel, instruction, correct, content) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $idgame, $level, $instruction, $correct, $json);

        if ($stmt->execute()): $msg = "Nivel creado exitosamente";
        else: $msg = "Falló la conexión al servidor, intentelo de nuevo más tarde."; endif;

        $stmt->close();

        header('Location: create.php?msg=' . $msg);
        exit;
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de Semantic Realm</title>
    <!-- STYLES -->
    <link rel="preconnect" href="../../style/guidelines.css">
    <link rel="stylesheet" href="../../style/guidelines.css">
    <link rel="preconnect" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <!-- SCRIPT -->
    <script src="https://kit.fontawesome.com/8e77509853.js" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php if(!empty($msg)): ?><p class="notification"><?php echo $msg; ?></p><?php endif; ?>
    <form method="post">
        <main class="main editor">
            <section id="left-content">
                <div class="between">
                    <a href="index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Juego</a>
                </div>
                <h2>Editor de Semantic Realm</h2>
                <div class="instruction">
                    <textarea class="input" rows="8" name="instruction" placeholder="Instrucciones..." required></textarea>
                </div>

                <div class="content">
                    <textarea class="input" rows="10" name="content" placeholder="Contenido..." required></textarea>
                    <textarea class="input" rows="3" name="correct" placeholder="Respuesta correcta..." required></textarea>
                    <input type="submit" class="button-primary" name="create" value="Crear Nivel">
                </div>
            </section>
        </main>
    </form>
</body>
</html>
<script src="function.js"></script>
<script src="../../js/dataconfetti.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>