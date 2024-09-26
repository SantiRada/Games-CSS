<?php
    session_start();

    include('modules/config.php');

    $resslides = mysqli_query($con, "select * from slides order by id asc;");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta name="keywords" content="games,html,css,javascript,java,mysql,react,vite,typescript,ajax,jquery,programar,programacion,frontend,backend">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Santiago Rada">
    <meta name="description" content="En GamesDev puedes aprender HTML, CSS, JavaScript y más con pequeños juegos que aunque simples son muy efectivos para arraigar el conocimiento.">
    <meta property="og:title" content="GamesDev - Aprende Frontend Jugando">
    <meta property="og:description" content="En GamesDev puedes aprender HTML, CSS, JavaScript y más, con juegos que aunque simples son muy efectivos para arraigar el conocimiento.">
    <meta property="og:image" content="media/socialnetwork.png">
    <meta name="twitter:title" content="GamesDev - Aprende Frontend Jugando">
    <title>GamesDev - Santiago Rada</title>
    <link rel="icon" href="media/favicon.ico" type="image/x-icon">
    <!-- STYLES -->
    <link rel="preconnect" href="style/style.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <script src="https://kit.fontawesome.com/f915c97ad7.js" crossorigin="anonymous"></script>
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
            <a class="btn-nav" href="index.php#games">Juegos</a>
            <a class="btn-nav" href="index.php#tools">Herramientas</a>
            <a class="btn-nav" href="slides.php">Slides</a>
            <a class="btn-nav" href="index.php#docs">Docs</a>
            <a class="btn-nav" href="index.php#footer">Contacto</a>
        </nav>
        <a class="btn-nav" href="<?php if(isset($_SESSION['name'])): echo "modules/close.php"; else: echo "modules/login.php"; endif; ?>"><?php if(isset($_SESSION['name'])): echo $_SESSION['name']; else: ?>Iniciar Sesión<?php endif; ?></a>
    </header>

    <main>
        <section id="games">
            <div class="title-pos">
                <h1 class="distance">Slides</h1>
                <?php if(isset($_SESSION['type'])): if($_SESSION['type'] == "admin"): ?><a class="right btn-icon" href="modules/create.php?filter=slides"><i class="fa-solid fa-plus"></i> Crear</a><?php endif; endif; ?>
            </div>
            <div class="sector-tabs">
                <div class="tabs-filter">
                    <a class="chip-tabs" href="#">Todos</a>
                    <a class="chip-tabs" href="#">HTML</a>
                    <a class="chip-tabs" href="#">CSS</a>
                    <a class="chip-tabs" href="#">JS</a>
                    <a class="chip-tabs" href="#">React</a>
                </div>
            </div>
            <div class="content-games">
                <?php foreach($resslides as $row): $tags = explode(',', $row['tags']); ?>
                    <a class="card" href="<?php echo $row['link'] ?>" target="_blank">
                    <iframe src="<?php echo $row['link']; ?>" frameborder="0" width="480" height="270" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
                        <div class="content">
                            <h4><?php echo $row['name']; ?></h4>
                            <div class="list-h">
                                <?php foreach($tags as $tag): ?>
                                    <p class="chip"><?php echo $tag; ?></p>
                                <?php endforeach; ?>
                            </div>
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
                    url: 'modules/ajax/filterslides.php',
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4MFP7LE2CB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4MFP7LE2CB');
</script>