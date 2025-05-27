<?php
session_start();
require_once 'config.php';

if (isset($_POST['input'])) {
    $admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    $input = $_POST['input'];
    $view = $_SESSION['active_view'] ?? 'simple';
    $folder_id = $_POST['folder_id'];

    $query = "SELECT * FROM files WHERE name LIKE '{$input}%' AND folder_id = '{$folder_id}'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $folder_id = $row['folder_id'];
            $name = $row['name'];
            $real_name = $row['real_name'];
            $size = $row['size'];
            $type = $row['type'];
            $created = $row['created'];
            $filePath = "../../uploads/{$real_name}";

            if ($view === 'detailed') {
                ?>
                <tr class="folder-element">
                    <td class="folder-name">
                        <div class="icon">
                            <img src="../../icons/<?= $type ?>.png" alt="file-icon">
                        </div>
                        <span class="description"><?= htmlspecialchars($name) ?></span>
                    </td>
                    <td>
                        <?= ($size < 1048576) ? round($size / 1024, 2) . ' KB' : round($size / 1048576, 2) . ' MB' ?>
                    </td>
                    <td><?= $created ?></td>
                    <td>
                        <a href="#" class="button-primary" title="Ver archivo" onclick="showFilePreview('<?= $filePath ?>'); return false;"><i class="bi bi-eye"></i></a>
                        <a href="<?= $filePath ?>" download="<?= htmlspecialchars($name) ?>" class="button-secondary" title="Descargar archivo"><i class="bi bi-download"></i></a>
                        <?php if ($admin) { ?>
                            <a href="#" class="button-delete" title="Eliminar" onclick="showDeleteModal('../../functions/delete_file.php?file=<?= urlencode($real_name) ?>&id=<?= $id ?>'); return false;"><i class="bi bi-trash3"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            } else {
                // Vista simple (tarjeta)
                ?>
                <div class="folder-element">
                    <div class="folder">
                        <div class="icon">
                            <img src="../../icons/<?= $type ?>.png" alt="file-icon">
                        </div>
                        <div class="folder-info">
                            <span class="description"><?= htmlspecialchars($name) ?></span>
                            <span class="details">
                                <?= ($size < 1048576) ? round($size / 1024, 2) . ' KB' : round($size / 1048576, 2) . ' MB' ?>
                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <a href="#" class="button-primary" onclick="showFilePreview('<?= $filePath ?>'); return false;">Ver</a>
                        <a href="<?= $filePath ?>" download="<?= htmlspecialchars($name) ?>" class="button-secondary">Descargar</a>
                        <?php if ($admin) { ?>
                            <a href="#" class="button-delete" onclick="showDeleteModal('../../functions/delete_file.php?file=<?= urlencode($real_name) ?>&id=<?= $id ?>'); return false;">Borrar</a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "<h6 class='error-message big-font'> NO EXISTE NINGÚN ARCHIVO CON ESTE NOMBRE </h6>";
    }
}
?>
