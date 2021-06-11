<?php
    session_start();
    include_once('./config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM LOGIN WHERE username = "'.$username.'";';
    // $sql = "SELECT 1 FROM LOGIN WHERE username = '".$username."' AND password = '".$password."';";
    if($res = mysqli_query($conn, $sql)) {
        if($res->num_rows > 0) {
            $rows = mysqli_fetch_row($res);
            if($rows[1] == $password) {
                setcookie('logged', '1');
                $_SESSION['logged'] = '1';
                echo json_encode(Array('result'=>'1'));
            } else {
                echo json_encode(Array('result'=>'2'));
            }
        } else {
            echo json_encode(Array('result'=>'0'));
        }
    } else {
        echo mysqli_error($conn);
    }
?>