<?php
    include("../../include/connection.php");
    // include("../../include/functions.php");

if(isset($_POST['save_data']))
{
        //something was posted
        $name = $_POST['name'];
        $surname1 = $_POST['surname1'];
        $surname2 = $_POST['surname2'];
        $dni = $_POST['dni'];
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        $admin = isset($_POST['admin']) ? 1 : 0;

        if(!is_numeric($username))
        {
            //guardar en la base de datos
            $user_id = random_num(2);
            $query ="insert into users (user_id,username, passwd, name, 1surname, 2surname, dni, admin) values('$user_id','$username','$passwd','$name','$surname1','$surname2','$dni','$admin')";
            mysqli_query($con, $query);

            $_SESSION['last_username'] = $username;
            header("Location: admin_view.php");
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
                <h1 class="modal-title fs-5" id="insertdataLabel">Añadir un usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class=" mb-3">
                        <label for="">Nombre(s)</label>
                        <input type="text" class="form-control" name="name" placeholder="Introduce el nombre...">
                    </div>

                    <div class=" mb-3">
                        <label for="">Primer apellido</label>
                        <input type="text" class="form-control" name="surname1"
                            placeholder="Introduce el primer apellido...">
                    </div>

                    <div class=" mb-3">
                        <label for="">Segundo apellido</label>
                        <input type="text" class="form-control" name="surname2"
                            placeholder="Introduce el segundo apellido...">
                    </div>

                    <div class=" mb-3">
                        <label for="">DNI</label>
                        <input type="text" class="form-control" name="dni" placeholder="Introduce el DNI...">
                    </div>

                    <div class=" mb-3">
                        <label for="">Usuario</label>
                        <input type="text" class="form-control" name="username" placeholder="Introduce el usuario..."
                            required>
                    </div>

                    <div class=" mb-3">
                        <label for="">Contraseña</label>
                        <input type="password" id="passwd" class="form-control" name="passwd"
                            placeholder="Introduce la contraseña..." required>
                    </div>

                    <div class="mb-3">
                        <label for="admin">Mostrar contraseña</label>
                        <input class="form-check-input mt-0 align-end" type="checkbox" name="show_passwd" id="checkbox"
                            onclick="mostrarContrasenia()"><br>
                    </div>

                    <div class="mb-3">
                        <label for="admin">Administrador</label>
                        <input class="form-check-input mt-0 align-end" type="checkbox" name="admin" id="checkbox">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="button-secundary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="save_data" class="button-primary">Añadir usuario</button>
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