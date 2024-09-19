<?php
    session_start();
    include('../../modules/config.php');

    $msg = $_GET['msg'] ?? "";

    if(isset($_POST['create'])):
        $instruction = $_POST['instruction'] ?? "";
        $correct = $_POST['correct'] ?? "";
        $content = $_POST['content'] ?? "";

        $instruction = html_entity_decode($instruction, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $correct = html_entity_decode($correct, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '4' order by id desc limit 1;"));
        if($row): $num = $row['numlevel'];
        else: $num = 0; endif;

        $content = [
            'content' => $content
        ];

        $idgame = "4";
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de Pathfinder</title>
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
</head>
<body>
    <?php if(!empty($msg)): ?><p class="notification"><?php echo $msg; ?></p><?php endif; ?>
    <form method="post">
        <main class="distribution">
            <section id="left-content">
                <div class="between">
                    <a href="index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Juego</a>
                </div>
                <h2>Editor de Pathfinder</h2>
                <div class="instruction">
                    <textarea class="input" placeholder="Instrucciones..." rows="8" name="instruction"></textarea>
                    <input type="submit" class="button-primary" name="create" id="create" value="Crear Nivel">
                </div><br>

                <div class="codes">
                        <textarea id="input-1" class="input" name="correct" placeholder="Respuesta Correcta..." rows="4"></textarea>
                </div>
            </section>

            <section id="right-content">
                <div id="box">
                    <textarea class="input" rows="18" name="content" placeholder="Contenido..."></textarea>
                    <h3>EXAMPLE:</h3>
                    <pre>
&lt;div&gt;
    &lt;p>&lt;i class="fa-solid fa-folder">&lt;/i&gt; AR&lt;/p&gt;
    &lt;p>&lt;i class="fa-solid fa-folder">&lt;/i&gt; AN&lt;/p&gt;
    &lt;p>&lt;em class="fa-solid fa-file">&lt;/em&gt; inicio.html&lt;/p&gt;
    &lt;div&gt;
        &lt;p>&lt;i class="fa-solid fa-folder">&lt;/i&gt; FA&lt;/p&gt;
        &lt;div&gt;
            &lt;p>&lt;span class="fa-solid fa-file"&gt;&lt;/span&gt; destino.png&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </pre>
                </div>
            </section>
    </main>
    </form>
</body>
</html>