<?php

include("connection.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $query = "SELECT * FROM users WHERE name LIKE '{$input}%' OR dni LIKE '{$input}%'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php
                while($row = mysqli_fetch_assoc($result)){

                    $username = $row['username'];
                    $name = $row['name'];
                    $surname1 = $row['1surname'];
                    $surname2 = $row['2surname'];
                    $dni = $row['dni']
                    ?>

        <tr>
            <td><?php echo $name;?> <?php echo $surname1;?> <?php echo $surname2;?><br><b class="dni"><?php echo $dni;?></b></td>
            <td class="details">
                <a href="../../include/updates/update_session.php?user=<?php echo urlencode($username); ?>" class="button-primary" id="<?php echo $username; ?>">
                    <span class="icon">
                        <i class="bi bi-file-person"></i>
                    </span>
                    <span class="description">Detalles</a></span>
                    
                    <a href="../../include/delete_user.php" class="button-delete">
                        <span class="icon">
                            <i class="bi bi-person-dash"></i>
                        </span>
                        <span class="description">Eliminar</a></span>
                    </td>
        </tr>

        <?php
                }
                ?>
    </tbody>
</table>

<?php
    }else{

        echo "<h6 class='ext-danger text-center'> ESTE USUARIO NO EXISTE... </h6>";
    }
}

?>