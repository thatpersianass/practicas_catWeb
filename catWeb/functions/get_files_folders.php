<?php
    function get_folders($user_id,$con){
        $query = "SELECT * FROM folders WHERE user_id = '$user_id'";

        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];
            ?>
        <div class="folder-element">
            <div class="folder">
                <div class="icon">
                    <img src="../../icons/file.png" alt="folder-icon">
                </div>
                <div class="folder-info">
                    <span class="description">
                        <?=$name?>
                    </span>
                </div>
            </div>
            <div class="actions">
                <a href="../../functions/update_folder_details.php?folder=<?php echo urlencode($id); ?>" class="button-primary">Ver</a>
                <a href="#" class="button-delete">Borrar</a>
            </div>
        </div>
        <?php }} else {
            echo "<h6 class='error-message big-font'> ESTE USUARIO NO TIENE CARPETAS ASOCIADAS </h6>";
        }}

    function get_files($folder_id,$con){
        $query = "SELECT * FROM files WHERE folder_id = '$folder_id'";

        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $user_id = $row['user_id'];
                    $folder_id = $row['folder_id'];
                    $name = $row['name'];
                    $real_name = $row['real_name'];
                    $size = $row['size'];
                    $type = $row['type'];
                    $created = $row['created'];
            ?>
        <div class="folder-element">
            <div class="folder">
                <div class="icon">
                    <img src="../../icons/<?=$type?>.png" alt="file-icon">
                </div>
                <div class="folder-info">
                    <span class="description">
                        <?=$name?>
                    </span>
                    <span class="details">
                        <?=($size<1048576)?round($size/1024,2).' KB':round($size/1048576,2).' MB'?>
                    </span>
                </div>
            </div>
            <div class="actions">
                <a href="../../functions/update_folder_details.php?folder=<?php echo urlencode($id); ?>" class="button-primary">Ver</a>
                <a href="#" class="button-delete">Borrar</a>
            </div>
        </div>
        <?php }} else {
            echo "<h6 class='error-message big-font'> ESTA CARPETA NO CONTIENE NINGÚN ARCHIVO </h6>";
        }}
?>