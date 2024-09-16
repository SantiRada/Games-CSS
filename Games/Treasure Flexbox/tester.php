<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasure Flexbox - TESTER</title>
    <!-- STYLES -->
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
    <main class="distribution">
        <section id="left-content">
            <div class="between">
                <a href="../../index.php" class="arrow"><i class="fa-solid fa-arrow-left"></i> Volver al Inicio</a>
            </div>
            <h2>TESTER Flexbox</h2>
            <footer class="footer">
                <p>Treasure Flexbox es una creación de <span>Santiago Rada</span> para las clases de la <strong>UTN</strong></p>
            </footer>
        </section>

        <style>
            #pirate, #treasure{
                position: absolute;
                width: calc(100% - 4rem);
                height: calc(100% - 4rem);
                top: 2rem;
                left: 2rem;
                display: flex;
            }
            #pirate img, #treasure img{ min-width: 0; }
            #pirate { z-index: 1; flex-wrap: wrap; }
            #treasure{ align-content: center; flex-direction: column-reverse; flex-wrap: wrap; }
        </style>

        <section id="right-content">
            <div id="box">
                <div id="pirate">
                    <img class="pirate" src="pirate.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-3.png" alt="imagen del pirata">
                    
                    <img class="pirate" src="pirate-1.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-1.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-1.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-1.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-1.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-3.png" alt="imagen del pirata">

                    <img class="pirate" src="pirate-2.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-2.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-2.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-2.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-2.png" alt="imagen del pirata">
                    <img class="pirate" src="pirate-3.png" alt="imagen del pirata">
                </div>
                <div id="treasure">
                    <img class="treasure" src="treasure.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-3.png" alt="imagen del tesoro">
                    
                    <img class="treasure" src="treasure-1.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-1.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-1.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-1.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-1.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-3.png" alt="imagen del tesoro">
                    
                    <img class="treasure" src="treasure-2.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-2.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-2.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-2.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-2.png" alt="imagen del tesoro">
                    <img class="treasure" src="treasure-3.png" alt="imagen del tesoro">
                </div>
            </div>
            <div id="congratulation" class="not-view">
                <h1>¡Felicitaciones!</h1>
                <p>Has completado el nivel <?php echo $row['numlevel']; ?></p>
            </div>
        </section>
    </main>
</body>
</html>