<?php

function check_login($con)
{
    $timeout_duration = 1800; // 5 minutes

    if (isset($_SESSION['user_id'])) {

        // Check inactivity timeout
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: login");
            exit;
        }

        // Update last activity time
        $_SESSION['LAST_ACTIVITY'] = time();

        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // If not logged in or session expired, redirect to login
    header("Location: login");
    exit;
}

function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}
