<?php
    session_start();
    include('../../modules/config.php');

    $msg = $_GET['msg'] ?? "";
    $level = $_GET['level'] ?? 1;
    $row = mysqli_fetch_assoc(mysqli_query($con, "select * from leveldata where idgame = '3' and numlevel = '".$level."';"));

    $resall = mysqli_query($con, "select * from leveldata where idgame = '3' order by numlevel asc;");

    $json = json_decode($row['content'], true);

    $instruction = $row['instruction'] ?? "";
    $code = htmlspecialchars($json['code'], ENT_QUOTES, 'UTF-8');
    $correct = htmlspecialchars($row['correct'], ENT_QUOTES, 'UTF-8');

    if(isset($_POST['next-level'])):
        $verify = mysqli_query($con, "select * from leveldata where idgame = '3' and numlevel = '".($level + 1)."';");

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
    <title>The Word of Emmet</title>
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
    <main class="distribution">
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
            <h2>The Word of Emmet</h2>
            <div class="instruction">
                <?php echo $instruction; ?>
            </div>

            <div class="codes">
                <div class="list-v">
                    <p>1</p>
                    <p>2</p>
                    <p>3</p>
                    <p>4</p>
                    <p>5</p>
                </div>
                <form method="post" class="relative">
                    <textarea class="input" placeholder="La palabra de Emmet..." id="input-1" rows="5" maxlength="100" autofocus></textarea>
                    <input type="submit" class="button-primary not-view" name="next-level" id="next-level" value="Siguiente">
                </form>
            </div>

            <footer class="footer">
                <p>The Word of Emmet es una creación de <span>Santiago Rada</span> para las clases de la <strong>UTN</strong></p>
            </footer>
        </section>

        <section id="right-content">
            <div id="box">
                <div class="codes">
                    <div class="list-v">
                        <p>1</p>
                        <p>2</p>
                        <p>3</p>
                        <p>4</p>
                        <p>5</p>
                        <p>6</p>
                        <p>7</p>
                        <p>8</p>
                        <p>9</p>
                        <p>10</p>
                        <p>11</p>
                        <p>12</p>
                        <p>13</p>
                        <p>14</p>
                        <p>15</p>
                        <p>16</p>
                        <p>17</p>
                        <p>18</p>
                    </div>
                    <form method="post">
                        <pre><?php echo $code; ?></pre>
                        <input type="submit" class="button-primary not-view" name="next-level" id="next-level" value="Siguiente">
                    </form>
                </div>
            </div>
            <div id="congratulation" class="not-view">
                <h1>¡Felicitaciones!</h1>
                <p>Has completado el nivel <?php echo $row['numlevel']; ?></p>
            </div>
        </section>
        
        <input type="hidden" id="correct" class="input" value="<?php echo $correct; ?>">
    </main>
</body>
</html>
<script src="function.js"></script>
<script src="../../js/dataconfetti.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
