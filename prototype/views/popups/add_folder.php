<?php
    include("../../include/connection.php");
    include("../../include/user_details.php");

    $user_selected = $_SESSION['user_selected'];

    $user_details = get_user_details($user_selected,$con);

if(isset($_POST['save_data']))
{
        //something was posted
        $name = $_POST['name'];
        $user_id = $user_details['user_id'];

        if(!is_numeric($username))
        {
            //guardar en la base de datos
            $query ="insert into folders (user_id,name) values('$user_id','$name')";
            mysqli_query($con, $query);
            
            header("Location: admin_files.php");
            die;

        }else
        {
            echo 'Introduce informacion valida';
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
            <form method="post">
                <div class="modal-body">

                    <div class=" mb-3">
                        <label for="">Nombre de la carpeta</label>
                        <input type="text" class="form-control" name="name" placeholder="Introduce el nombre de la carpeta...">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="button-secundary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="save_data" class="button-primary">Crear carpeta</button>
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