<?php
function get_user_details($username,$con) {
    $query = "SELECT * FROM users WHERE username = '$username' limit 1";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data; 
        }
}

function get_file_details($file_id,$con){
    $query = "SELECT * FROM files WHERE id = '$file_id' limit 1";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $file_data; 
        }
}
?>