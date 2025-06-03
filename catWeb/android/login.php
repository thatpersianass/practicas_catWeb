<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    require_once "connection.php";

    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($passwd, $user['passwd'])) {
            $response = [
                'status' => $user['admin'] ? 'success admin' : 'success user',
                'user_id' => $user['id'],
                'username' => $user['username'],
                'color' => $user['color']
            ];
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'failure']);
        }
    } else {
        echo json_encode(['status' => 'failure']);
    }
}
?>
