<?php
    session_start();
    include('../../modules/config.php');

    $msg = $_GET['msg'] ?? "";
    $level = $_GET['level'] ?? 1;

    $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '5' and numlevel = '".$level."';"));
    $resall = mysqli_query($con, "select * from leveldata where idgame = '5' order by numlevel asc;");

    $json = json_decode($row['content'], TRUE);
    // CONTENIDO FINAL
    $instruction = html_entity_decode($row['instruction'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $correct = html_entity_decode($row['correct'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $content = html_entity_decode($json['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    if(isset($_POST['next-level'])):
        $verify = mysqli_query($con, "select * from leveldata where idgame = '5' and numlevel = '".($level + 1)."';");

        if(mysqli_num_rows($verify) > 0):
            header('Location: index.php?level=' . ($level + 1));
            exit;
        endif;

        $msg = "¡Has completado todos los niveles! Esperamos que hayas aprendido mucho.";
        header('Location: index.php?level=1&msg=' . $msg);
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semantic Realm</title>
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
        <main class="main">
            <section id="left-content">
                <div class="between">
                    <a href="../../index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Inicio</a>
                    <select class="input-2" id="list">
                        <option disabled>Niveles</option>
                        <?php foreach($resall as $rowall): ?>
                            <option <?php if($level == $rowall['numlevel']): echo "selected"; endif; ?> value="<?php echo $rowall['numlevel']; ?>">Nivel <?php echo $rowall['numlevel']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if(isset($_SESSION['type'])): if($_SESSION['type'] == "admin"): ?>
                        <a href="create.php" class="arrow"><i class="fa-solid fa-plus"></i> Crear Nivel</a>
                    <?php endif; endif; ?>
                </div>
                <h2>Semantic Realm</h2>
                <div class="instruction-content">
                    <div class="instruction">
                        <?php echo $instruction; ?>
                    </div>
                </div>

                <div class="content">
                    <?php echo $content; ?>
                </div>

                <footer class="footer">
                    <p><i>Semantic Realm</i> es una creación de <span>Santiago Rada</span></p>
                </footer>
            </section>
            
            <div id="congratulation" class="not-view">
                <h1>¡Felicitaciones!</h1>
                <p>Has completado el nivel <?php echo $row['numlevel']; ?></p>
                <input type="submit" class="button-primary not-view" name="next-level" id="next-level" value="Siguiente">
            </div>
            <div id="failed" class="response not-view">
                <h1>D:</h1>
                <p>No todos los reinos se construyen a la primera, ¡intentalo de nuevo!</p>
                <a href="index.php?level=<?php echo $level; ?>" class="button-primary">Reintentar</a>
            </div>

            <input type="hidden" id="correct" class="input" value="<?php echo $correct; ?>">
        </main>
    </form>
</body>
</html>
<script src="function.js"></script>
<script src="../../js/dataconfetti.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>