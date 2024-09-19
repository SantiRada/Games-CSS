<?php

    include('../config.php');

    $type = $_POST['type'] ?? "";

    if($type != "Todos"): $sql = "select * from games where chips like '%".$type."%';";
    else: $sql = "select * from games;"; endif;

    $resgames = mysqli_query($con, $sql);

    foreach($resgames as $row): $chips = explode(',', $row['chips']); ?>
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