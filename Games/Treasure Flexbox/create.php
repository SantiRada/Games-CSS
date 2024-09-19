<?php
    include('../../modules/config.php');
    $msg = $_GET['msg'] ?? "";

    $rowcant = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '1' order by id desc limit 1;"));
    if($rowcant): $num = ($rowcant['numlevel'] + 1);
    else: $num = 1; endif;

    if(isset($_POST['create'])):
        $instruction = htmlspecialchars($_POST['instruction'], ENT_QUOTES, 'UTF-8');
        $code = htmlspecialchars($_POST['code'], ENT_QUOTES, 'UTF-8');
        $style = htmlspecialchars($_POST['style'], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
        $correct = htmlspecialchars($_POST['correct'], ENT_QUOTES, 'UTF-8');

        $data = [
            "code" => $code,
            "style" => $style,
            "content" => $content
        ];
        $json = json_encode($data, JSON_PRETTY_PRINT);

        // Guardar en la base de datos usando consultas preparadas
        $pdo = new PDO('mysql:host=localhost;dbname=gamesdev_games', 'gamesdev_admin', 'Mardel/2024');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO leveldata (idgame,numlevel,instruction,correct, content) VALUES (:idgame,:numlevel,:instruction,:correct,:content)");
        if($stmt->execute([
            ':idgame' => 1,
            ':numlevel' => $num,
            ':instruction' => $instruction,
            ':correct' => $correct,
            ':content' => $json
        ])): $msg = "Nivel de Treasure Flexbox creado con éxito.";
        else: $msg = "Falló la conexión al servidor, intentelo de nuevo más tarde."; endif;

        header('Location: create.php?msg=' . $msg);
        exit;
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creador de Niveles de Treasure Flexbox</title>
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
    <form method="post">
        <main class="distribution">
            <section id="left-content">
                <div class="between">
                    <a href="index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Juego</a>
                </div>
                <h2>Level Maker #<?php echo $num; ?></h2>

                    <textarea rows="8" class="input" name="instruction" autofocus required placeholder="Instrucciones"></textarea>
                    <?php if(!empty($msg)): ?><p class="error"><?php echo $msg; ?></p><?php endif; ?>
                    <div class="space-code">
                        <textarea rows="6" placeholder="Código inscrustado" class="input" name="code" id="input-1" required></textarea>
                        <input type="submit" class="button-primary" name="create" value="Crear Nivel">
                    </div>
                <footer class="footer">
                    <p>Treasure Flexbox es una creación de <span>Santiago Rada</span> para las clases de la <strong>UTN</strong></p>
                </footer>
            </section>

            <section id="right-content">
                <textarea rows="8" class="input" name="style" required placeholder="Estilos del contenido"></textarea><br><br>
                <textarea rows="8" class="input" name="content" required placeholder="Contenido a mostrar"></textarea><br><br>
                <textarea rows="4" class="input" name="correct" required placeholder="Respuesta correcta"></textarea>
            </section>
        </main>
    </form>
</body>
</html>