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
                <a href="#" class="button-primary">Ver</a>
                <a href="#" class="button-delete">Borrar</a>
            </div>
        </div>
        <?php }} else {
            echo "<h6 class='error-message big-font'> ESTE USUARIO NO TIENE CARPETAS ASOCIADAS </h6>";
        }}
?>