<?php
    include("../../include/connection.php");
    include("../../include/user_details.php");

    $user_selected = $_SESSION['user_selected'];

    $user_details = get_user_details($user_selected,$con);

if(isset($_POST['save_data'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $user_id = $user_details['user_id'];
    $folder_id = $_SESSION['folder_selected'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $name = $_POST['name'] . '.' . $fileActualExt;

    $allowed = array('jpg','jpeg','pdf','png');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000000000){

                $uploadDir = '../../uploads/' . $user_details['user_id'] . '/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = $uploadDir.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

                $query ="insert into files (real_name,name,type,user_id,size,folder_id) values('$fileNameNew','$name','$fileActualExt','$user_id','$fileSize','$folder_id')";
                mysqli_query($con, $query);

                header("Location: admin_files_manage.php?uploadsuccesfull");
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

    // if($run)
    // {
    //     $_SESSION['status'] = 'Data inserted successfully';
    //     header('location: admin_view.php');
    // }
    // else
    // {
    //     $_SESSION['status'] = 'Data insertion failed';
    //     header('location: admin_view.php');
    // }

?>

<link rel="stylesheet" href="../style/login.css">

<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdataLabel">Crear una carpeta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class=" mb-3">
                        <label for="">Titulo del archivo</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="Introduce el nombre del archivo..." required>
                    </div>

                    <div class=" mb-3">
                        <label for="">Subir el archivo</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="button-secundary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="save_data" class="button-primary">Subir archivo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function mostrarContrasenia() {
    var x = document.getElementById("passwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>