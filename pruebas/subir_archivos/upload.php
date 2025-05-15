<?php
if(isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','pdf','png');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000000000){

                $uploadDir = 'uploads/coocoo/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // true permite crear directorios anidados
                }
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = $uploadDir.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

                header("Location: $fileDestination/$fileTmpname");
            } else {
                echo "The file is too big!";
            }

        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
?>