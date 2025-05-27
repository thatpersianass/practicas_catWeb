<?php
    function get_folders($admin,$user_id,$con){
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
        <a href="../../functions/update_folder_details.php?folder=<?= urlencode($id); ?>"
            class="button-primary">Abrir</a>
        <?php if($admin){
        echo '<a href="#" class="button-delete open-delete-modal" data-folder-id="' . $id . '" data-folder-name="' . $name . '">Borrar</a>';
        } ?>
    </div>
</div>
<?php }} else {
            echo "<h6 class='error-message big-font'> ESTE USUARIO NO TIENE CARPETAS ASOCIADAS </h6>";
        }}
?>


<?php
// Obtener carpetas
    function get_files($admin,$folder_id,$con){
        $query = "SELECT * FROM files WHERE folder_id = '$folder_id'";

        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $folder_id = $row['folder_id'];
                    $name = $row['name'];
                    $real_name = $row['real_name'];
                    $size = $row['size'];
                    $type = $row['type'];
                    $created = $row['created'];
                    $filePath = "../../uploads/{$real_name}";
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
        <a href="#" class="button-primary" onclick="showFilePreview('<?=$filePath?>'); return false;">Ver</a>
        <a href="<?=$filePath?>" download="<?=$name?>" class="button-secondary">Descargar</a>
        <?php if($admin){?>
        <a href="#" class="button-delete"
            onclick="showDeleteModal('../../functions/delete_file.php?file=<?=urlencode($real_name)?>&id=<?=$id?>'); return false;">Borrar</a>
        <?php } ?>
    </div>
</div>
<?php }} else {
            echo "<h6 class='error-message big-font'> ESTA CARPETA NO CONTIENE NINGÚN ARCHIVO </h6>";
}}

function get_files_detailed($admin,$folder_id,$con){
    $query = "SELECT * FROM files WHERE folder_id = '$folder_id' ORDER BY created DESC";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){
            echo '                    <table class="folder-table" id="file-table">
                <thead>
                    <tr class="folder-element">
                        <th data-sort="name" class="sortable"><span class="description">Nombre</span></th>
                        <th data-sort="size" class="sortable"><span class="description">Tamaño</span></th>
                        <th data-sort="created" class="sortable"><span class="description">Fecha de creación</span></th>
                        <th><span class="description">Acciones</span></th>
                    </tr>
                </thead>

                <tbody id="file-table-body">';
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $folder_id = $row['folder_id'];
                $name = $row['name'];
                $real_name = $row['real_name'];
                $size = $row['size'];
                $type = $row['type'];
                $created = $row['created'];
                $filePath = "../../uploads/{$real_name}";
        ?>
<tr class="folder-element">
    <td class="folder-name">
        <div class="icon">
            <img src="../../icons/<?=$type?>.png" alt="file-icon">
        </div>
        <span class="description">
            <?=$name?>
        </span>
    </td>
    <td>
        <?=($size<1048576)?round($size/1024,2).' KB':round($size/1048576,2).' MB'?>
    </td>
    <td>
        <?= $created ?>
    </td>
    <td>
        <a href="#" class="button-primary" title="Ver archivo"
            onclick="showFilePreview('<?=$filePath?>'); return false;"><i class="bi bi-eye"></i></a>
        <a href="<?=$filePath?>" download="<?=$name?>" class="button-secondary" title="Descargar archivo"><i
                class="bi bi-download"></i></a>
        <?php if($admin){?>
        <a href="#" class="button-delete" title="Eliminar"
            onclick="showDeleteModal('../../functions/delete_file.php?file=<?=urlencode($real_name)?>&id=<?=$id?>'); return false;"><i
                class="bi bi-trash3"></i></a>
        <?php } ?>
    </td>
</tr>

<?php }echo '</tbody>
</table>';} else {
            echo "<h6 class='error-message big-font'> ESTA CARPETA NO CONTIENE NINGÚN ARCHIVO </h6>";
}}

?>

