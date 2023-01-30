<?php

    include('include.php');

    if(!empty($_POST)) {
        extract($_POST);

        if(isset($_POST['submit'])) {

            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $extensionValides = array('jpg', 'png', 'jpeg');

                $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));

                if(in_array($extensionUpload, $extensionValides)) {
                    $dossier = 'event/';

                    $titre = strtolower($titre);
                    $img = $titre. "." . $extensionUpload;
                                    
                    $chemin = $dossier . $img;

                    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);

                }

                $ajout = date("Y-m-d");

                if(is_readable($chemin)) {
                    $insert_files = $DB->prepare("INSERT INTO evenement (titre, description, datedevent, datedajout, image) VALUES(?, ?, ?, ?, ?);");
                    $insert_files->execute(array($titre, $description, $date, $ajout, $img));
                }
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="global">
        <h1>Panel</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Titre" name="titre" required>
            <input type="text" placeholder="Description" name="description" required>
            <input type="file" name="image" required>
            <input type="date" name="date" required>
            <input type="submit" name="submit" value="Créer l'évènement">
        </form>
    </div>
    
</body>
</html>