<?php

function debug($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}

if (isset($_FILES['photo'])) {

    $tmp_name = $_FILES['photo']['tmp_name'];

    $file_extension = strrchr($_FILES['photo']['type'], "/");
    $file_extension = str_replace("/", ".", $file_extension);

    $file_name = date("ymdhs") . $file_extension;
    $folder = '../photo/';
    $max_size = 5000000;
    $file_size = filesize($tmp_name);

    $extension_array = array('.png', '.jpg', '.jpeg');


    if ($file_size > $max_size) {
        $error = 'Fichier trop volumineux';
    }

    if (!in_array($file_extension, $extension_array)) {
        $error = "Mauvais type de fichier";
    }

    if(!isset($error)) {
        if(move_uploaded_file($tmp_name, $folder . $file_name)) {
            echo "C'est réussi !";
        }
        else {
            echo "Ah...il semblerait que ça ne se passe pas comme prévu..";
        }
    }
    else {
        echo '<div class="alert alert-danger>"' . $error . '</div>';
    }
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="photo">
    <input type="submit" value="Envoyer">
</form>



