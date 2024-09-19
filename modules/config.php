<?php

    // OFFLINE
    $con = mysqli_connect("localhost", "root", "", "games-css");

    // ONLINE
    // $con = mysqli_connect("localhost", "gamesdev_admin", "Mardel/2024", "gamesdev_games");

    mysqli_set_charset($con, "utf8mb4");

?>