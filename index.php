<?php
    session_start();

    include('modules/config.php');

    $resgames = mysqli_query($con, "select * from games order by id desc;");
    $restools = mysqli_query($con, "select * from tools order by id desc;");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games CSS - Santiago Rada</title>
    <!-- STYLES -->
    <link rel="preconnect" href="style/style.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <script src="https://kit.fontawesome.com/8e77509853.js" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header id="header">
        <h2>GamesDev</h2>
        <nav>
            <a class="btn-nav" href="#header">Inicio</a>
            <a class="btn-nav" href="#games">Juegos</a>
            <a class="btn-nav" href="#tools">Herramientas</a>
            <a class="btn-nav" href="#footer">Contacto</a>
        </nav>
        <a class="btn-nav" href="<?php if(isset($_SESSION['name'])): echo "modules/close.php"; else: echo "modules/login.php"; endif; ?>"><?php if(isset($_SESSION['name'])): echo $_SESSION['name']; else: ?>Iniciar Sesión<?php endif; ?></a>
    </header>

    <main>
        <section id="games">
            <div class="title-pos">
                <h1 class="distance">Juegos</h1>
                <?php if(isset($_SESSION['type'])): if($_SESSION['type'] == "admin"): ?><a class="right btn-icon" href="modules/create.php?filter=games"><i class="fa-solid fa-plus"></i> Crear</a><?php endif; endif; ?>
            </div>
            <div class="sector-tabs">
                <div class="tabs-filter">
                    <a class="chip-tabs" href="#">Todos</a>
                    <a class="chip-tabs" href="#">HTML</a>
                    <a class="chip-tabs" href="#">CSS</a>
                    <a class="chip-tabs" href="#">JS</a>
                    <a class="chip-tabs" href="#">SQL</a>
                </div>
            </div>
            <div class="content-games">
                <?php foreach($resgames as $row): $chips = explode(',', $row['chips']); ?>
                    <a class="card" href="games/<?php echo $row['title']; ?>/index.php">
                        <img src="games/<?php echo $row['title'] . "/"; ?>cover.png" alt="imagen del juego">
                        <div class="content">
                            <h4><?php echo $row['title']; ?></h4>
                            <div class="list-h">
                                <?php foreach($chips as $chip): ?>
                                    <p class="chip"><?php echo $chip; ?></p>
                                <?php endforeach; ?>
                            </div>
                            <span><?php echo $row['description']; ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="tools">
            <div class="title-pos">
                <h1 class="distance">Herramientas</h1>
                <?php if(isset($_SESSION['type'])): if($_SESSION['type'] == "admin"): ?><a class="right btn-icon" href="modules/create.php?filter=tools"><i class="fa-solid fa-plus"></i> Crear</a><?php endif; endif; ?>
            </div>
            <div class="content-tools">
                <?php foreach($restools as $row): ?>
                    <a href="<?php echo $row['link']; ?>" class="card-min" target="_blank">
                        <img src="<?php echo $row['img']; ?>" alt="imagen de la herramienta">
                        <div class="content">
                            <span><?php echo $row['title']; ?></span>
                            <small><?php echo $row['description']; ?></small>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer id="footer">
        <h3>Santiago Rada</h3>
        <ul class="list-h">
            <li><a class="btn-icon" href="https://instagram.com/santiagonrada" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a class="btn-icon" href="https://linkedin.com/in/santiago-rada" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
            <li><a class="btn-icon" href="https://github.com/SantiRada" target="_blank"><i class="fa-brands fa-github"></i></a></li>
        </ul>
    </footer>

    <script>
        $(document).ready(function() {
            $('.chip-tabs').click(function() {
                var chiptabs = $(this).text();

                $.ajax({
                    url: 'modules/ajax/filtergames.php',
                    type: 'POST',
                    data: { type: chiptabs },
                    success: (response) => {
                        $('.content-games').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>