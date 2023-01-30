<?php
    include('include.php');

    $actu = $DB->prepare("SELECT titre, description, datedevent, image FROM evenement HAVING DATEDIFF(datedevent, DATE(NOW())) >=0 order by DATEDIFF(datedevent, DATE(NOW())) limit 3;");
    $actu->execute();
    $actu = $actu->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="global">

        <h1>Actualités</h1>

        <div class="actualites">
            <?php
                foreach ($actu as $actus) {
            ?>
            <div class="actualite">
                <img src="event/<?= $actus['image']?>" alt="">
                <h3><?= $actus['titre']?></h3>
                <p class="date"><?= $actus['datedevent']?></p>
                <div class="desc"><?= $actus['description']?></div>
            </div>
            <?php
                }
            ?>
        </div>

    </div>
    
</body>
</html>