<?php
    session_start();
    include('../../config.php');

    $msg = $_GET['msg'] ?? "";

    if(isset($_POST['create-level'])):
        $instruction = $_POST['instruction'];
        $correct = $_POST['correct'];
        $code = $_POST['code'];

        $instruction = html_entity_decode($instruction, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $correct = html_entity_decode($correct, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '3' order by id desc limit 1;"));
        if($row): $num = $row['numlevel'];
        else: $num = 0; endif;

        $content = [
            'code' => $code
        ];

        $idgame = "3";
        $numlevel = ($num + 1);
        $content = json_encode($content, JSON_PRETTY_PRINT);

        $stmt = $con->prepare("INSERT INTO leveldata (idgame, numlevel, instruction, correct, content) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $idgame, $numlevel, $instruction, $correct, $content);

        if ($stmt->execute()): $msg = "Nivel creado exitosamente";
        else: $msg = "Falló la conexión al servidor, intentelo de nuevo más tarde."; endif;

        $stmt->close();

        header('Location: create.php?msg=' . $msg);
        exit;
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de The Word of Emmet</title>
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
        <main class="distribution">
            <section id="left-content">
                <div class="between">
                    <a href="../../index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Juego</a>
                </div>
                <h2>The Word of Emmet</h2>

                <div class="instruction">
                    <textarea class="input" name="instruction" placeholder="Instrucciones" rows="6"></textarea>
                </div>

                <div class="instruction">
                    <textarea class="input" name="correct" placeholder="Resultado correcto..." rows="3"></textarea>
                    <input type="submit" class="button-primary" name="create-level" value="Crear Nivel">
                </div>
            </section>

            <section id="right-content">
                <textarea rows="18" placeholder="Código HTML" class="input" name="code" autofocus required></textarea>
            </section>
        </main>
    </form>
</body>
</html>
<script src="function.js"></script>
<script src="../../dataconfetti.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>