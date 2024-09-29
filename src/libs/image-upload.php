<?php
    if(session_status() === 1){
        session_start();
    }

    // Change la photo de profile de l'utilisateur

    if (isset($_FILES['imageFile'])) 
    {
        $file = $_FILES['imageFile'];
        
        
        $filename = $file['name'];
        $tempFilePath = $file['tmp_name'];
        
        $destinationPath =  __DIR__ . "/../database/" . $_SESSION["type"] . "/" . $_SESSION["user"]["mail"] . "/profil-picture.png";
        
        if (move_uploaded_file($tempFilePath, $destinationPath)) {
            echo "/../src/database/" . $_SESSION["type"] . "/" . $_SESSION["user"]["mail"] . "/profil-picture.png";
        } else {
            echo "failed";
        }
    }
?>
