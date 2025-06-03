<?php
include 'connection.php';

$folder_id = $_GET['folder_id'];

$query = "SELECT * FROM files WHERE folder_id = '$folder_id'";
$result = mysqli_query($con, $query);

$files = [];
while ($row = mysqli_fetch_assoc($result)) {
    $files[] = $row;
}
file_put_contents("files_debug.log", print_r($files, true), FILE_APPEND);

header('Content-Type: application/json');
echo json_encode($files);
?>