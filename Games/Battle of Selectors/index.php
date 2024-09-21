<?php

    session_start();

    include('../../modules/config.php');



    $msg = $_GET['msg'] ?? "";

    $level = $_GET['level'] ?? 1;

    $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '2' and numlevel = '".$level."';"));



    if(empty($row)):

        $msg = "¡Has completado 'Battle of Selectors', esperamos que hayas aprendido mucho!";

        header('Location: index.php?msg=' . $msg);

        exit;

    endif;



    $resall = mysqli_query($con, "select * from leveldata where idgame = '2' order by numlevel asc;");



    $json = json_decode($row['content'], true);



    // CONTENIDO FINAL

    $instruction = html_entity_decode($row['instruction'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $code1 = html_entity_decode($json['code1'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $code2 = html_entity_decode($json['code2'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $correct = html_entity_decode($row['correct'], ENT_QUOTES | ENT_HTML5, 'UTF-8');



    if(isset($_POST['next-level'])):

        $verify = mysqli_query($con, "select * from leveldata where idgame = '2' and numlevel = '".($level + 1)."';");



        if(mysqli_num_rows($verify) > 0): header('Location: index.php?level=' . ($level + 1)); exit; endif;



        $msg = "¡Has completado todos los niveles! Esperamos que hayas aprendido mucho.";

        header('Location: index.php?level=1&msg=' . $msg);

    endif;

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Battle of Selectors</title>

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



    <section id="base">

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

    </section>

    <?php if(!empty($instruction)): ?>

        <section class="instructor">

            <h2>Battle of Selectors</h2>

            <div class="instruction"><?php echo $instruction; ?></div>

            <br>

            <footer class="footer">

                <p><i>Battle of Selectors</i> es una creación de <span>Santiago Rada</span></p>

            </footer>

        </section>

    <?php endif; ?>



    <main>

        <section id="distribution">

            <button class="button-up" id="button-1">

                <img src="../../media/pirate-2.png" alt="Pirata 1">

                <span id="text-1"><?php echo $code1; ?></span></button>

            <button class="button-down" id="button-2">

                <img src="../../media/pirate.png" alt="Pirata 2">

                <span id="text-2"><?php echo $code2; ?></span></button>

        </section>



        <input type="hidden" id="correct" class="input" value="<?php echo $correct; ?>">

    </main>



    <section id="congrat" class="response not-view">

        <h1>¡Felicitaciones!</h1>

        <p>Has completado el nivel <?php echo $row['numlevel']; ?></p>

        <a class="button-primary" href="index.php?level=<?php echo ($level + 1); ?>">Siguiente Nivel</a>

    </section>



    <section id="failed" class="response not-view">

        <h1>D:</h1>

        <p>El nivel <?php echo $row['numlevel']; ?> es un poco difícil, ten en cuenta esta respuesta para poder repetirlo.</p>

        <a class="button-primary" href="index.php?level=<?php echo $level; ?>">Repetir Nivel</a>

    </section>

</body>

</html>

<script src="function.js"></script>

<script src="../../js/dataconfetti.js"></script>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>