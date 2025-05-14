<?php

include("config.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $query = "SELECT * FROM productos WHERE nombre LIKE'{$input}%'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
<table class="table table-bordered table-stripped mt-4">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['id'];
                    $name = $row['nombre'];
                    $cate = $row['caegoria'];
                    $stock = $row['stock'];

                    ?>

        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $cate;?></td>
            <td><?php echo $stock;?></td>
        </tr>

        <?php
                }
                ?>
    </tbody>
</table>

<?php
    }else{

        echo "<h6 class='ext-danger text-center'> NO DATA FOUND </h6>";
    }
}

?>