<?php
function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data; 
        }
    }

    //redirect to login
    header("Location: views/login.php");
    die;
}

function random_num($length)
{
    $text="";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4,$length);

    for($i=0; $i < $len; $i++) {
        $text .= rand(0,9);
    }

    return $text;
}

function fetch_folders($user_data,$user_details,$con){
    $user_id = $user_details['user_id'];

    $query = "SELECT * FROM folders WHERE user_id = '$user_id'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
<div class="title">
    <span class="title-panel">Carpetas de <?php echo $user_details['name']?> <?php echo $user_details['1surname']?>
        <?php echo $user_details['2surname']?></span>
</div>
<div class="folders-box-inner">
    <?php
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['id'];
                    $user_id = $row['user_id'];
                    $name = $row['name'];
            ?>
    <div class="folder">
        <?php if($user_data['admin']){ ?>
        <a href="../../include/updates/update_folder_admin.php?folder=<?php echo urlencode($id); ?>">
            <div class="img-folder">
                <img src="../../img/folder.webp" alt="folder.webp" class="folder-img">
            </div>
            <div class="description">
                <?php echo $name; ?>
            </div>
        </a>
        <?php } else { ?>
        <a href="../../include/updates/update_folder_usr.php?folder=<?php echo urlencode($id); ?>">
            <div class="img-folder">
                <img src="../../img/folder.webp" alt="folder.webp" class="folder-img">
            </div>
            <div class="description">
                <?php echo $name; ?>
            </div>
        </a>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<?php } else {
    ?>
<div class="title">
    <span class="title-panel">Carpetas de <?php echo $user_details['name']?> <?php echo $user_details['1surname']?>
        <?php echo $user_details['2surname']?></span>
</div>
<?php
    echo "<h6 class='ext-danger text-center'> Este usuario no tiene carpetas creadas... </h6>";
}
}

function fetch_files($user_data,$user_details,$con){
    $folder_id = $_SESSION['folder_selected'];

    $query = "SELECT * FROM files WHERE folder_id = '$folder_id'";

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
                        <?php if($user_data['admin']){ ?>
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