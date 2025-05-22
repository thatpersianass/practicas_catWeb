<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST['input'])){

    $input = $_POST['input'];

    $query = "SELECT * FROM users WHERE name LIKE '{$input}%' OR 1surname LIKE '{$input}%' OR 2surname LIKE '{$input}%' OR dni LIKE '{$input}%'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
<table>
    <?php
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['id'];
                    $username = $row['username'];
                    $name = $row['name'];
                    $surname1 = $row['1surname'];
                    $surname2 = $row['2surname'];
                    $color = $row['color'];
                    $dni = $row['dni'];
                    ?>
    <tr>
        <td class="user-show">
            <span class="pfp">
                <img src="../../img/pfp/<?= $color?>.webp" alt="pfp">
            </span>
            <div class="user-info">
                <span class="user-name"><?=$name?> <?=$surname1?> <?=$surname2?></span>
                <span class="user-others"><?=$dni?></span>
            </div>
        </td>
        <td>
            <div class="actions">
                <a href="../../functions/update_user_details.php?user=<?php echo urlencode($username); ?>"
                    class="button-primary">Detalles</a>
                <a href="#" class="button-delete open-delete-user-modal" data-user-id="<?= $row['id'] ?>"
                    data-user-name="<?= htmlspecialchars($row['username']) ?>">
                    Eliminar
                </a>
            </div>
        </td>
    </tr>

    <?php
                }
                ?>
</table>
<?php
    }else{

        echo "<h6 class='error-message big-font'> ESTE USUARIO NO EXISTE... </h6>";
    }
}

?>