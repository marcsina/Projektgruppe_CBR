<?php
header('Content-Type: text/html; charset=utf-8');
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);

include_once 'conn.php';

sec_session_start();

$mysqli = $mysqli;

if(isset($_FILES["fileToUpload"]["name"]))
{
    //Dateiendung auf $ending[1]
    $ending = split("/",$_FILES['fileToUpload']['type']);

    $target_dir = "../uploads/";
    $target_file = $target_dir . $_SESSION['user_id'].".".$ending[1];
    //target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo '<script language="javascript">';
            echo 'alert("File is not an image")';
            echo '</script>';
            $uploadOk = 0;
        }

    }
    /*
    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<script language="javascript">';
        echo 'alert("Dateiname existiert bereits")';
        echo '</script>';
        $uploadOk = 0;
    }*/
    // Check file size <=500kb
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo '<script language="javascript">';
        echo 'alert("Datei darf maximal 500KB gro� sein")';
        echo '</script>';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo '<script language="javascript">';
        echo 'alert("Nur JPG, JPEG, PNG & GIF erlaubt")';
        echo '</script>';
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Error by uploading image";
        // if everything is ok, try to upload file
    } else
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            changeProfileImage($mysqli, $target_file);

        } else
        {
            echo '<script language="javascript">';
            echo 'alert("Unbekannter Fehler beim Hochladen")';
            echo '</script>';
        }
    }
}

function changeProfileImage($mysqli, $path)
{
    $path = substr($path, 2-strlen($path));

    if($stmt = $mysqli->prepare("UPDATE members SET profilbild = ? WHERE id= ?"))
    {
        $stmt->bind_param('si',$path ,$_SESSION['user_id']);
        if($stmt->execute())
        {
            $_SESSION['profilbild'] = $path;
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
?>