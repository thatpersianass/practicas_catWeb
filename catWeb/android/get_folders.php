<?php
include 'connection.php'; // tu conexión a la BD

$user_id = $_GET['user_id']; // o POST, como prefieras

$query = "SELECT * FROM folders WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);

$folders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $folders[] = $row;
}
// file_put_contents("folder_debug.log", print_r($folders, true), FILE_APPEND);


header('Content-Type: application/json');
echo json_encode($folders);
?>