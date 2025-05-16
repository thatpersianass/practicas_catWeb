<?php

include("connection.php");
// include("functions.php");

// $user_data = check_login($con);

if(isset($_POST['input'])){

    $is_admin = $_POST['user_admin'];

    $input = $_POST['input'];

    $query = "SELECT * FROM files WHERE name LIKE '{$input}%'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
<div class="folders-box-inner">
    <table class="table table-bordered file">
        <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['id'];
                    $name = $row['name'];
                    $real_name = $row['real_name'];
                    $type = $row['type'];
                    $user_id = $row['user_id'];
                    $size = $row['size'];
                    $date = $row['date'];
            ?>
            <tr>
                <td class="file-info">
                    <div class="img-file">
                        <img src="../../img/<?php echo $type;?>.webp" alt="file.webp" class="file-img">
                    </div>
                    <div class="file-data">
                        <div class="description">
                            <?php echo $name; ?>
                        </div>
                        <div class="created-at">
                            <?php echo $date; ?> - <?=($size<1048576)?round($size/1024,2).' KB':round($size/1048576,2).' MB'?>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="buttons">
                        <div class="download-file">
                            <a href="../../uploads/<?php echo $user_id; ?>/<?php echo $real_name; ?>"
                                class="button-primary">
                                <span class="icon">
                                    <i class="bi bi-eye"></i>
                                </span>
                                <span class="description">Ver archivo</span>
                            </a>
                        </div>
                        <?php if($is_admin){ ?>
                        <div class="delete-file">
                            <a href="../../include/updates/update_file_delete.php?file_id=<?php echo urlencode($id); ?>"
                                class="button-delete">
                                <span class="icon">
                                    <i class="bi bi-trash"></i>
                                </span>
                                <span class="description">Eliminar archivo</span>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } else {
    ?>
<?php
    echo "<h6 class='ext-danger text-center'> Esta carpeta está vacía... </h6>";
}
}

?>