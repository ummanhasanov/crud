<?php

include ("../conn.php");
session_start();
if (isset($_POST['add_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
        
//     SQL qeydiyyat aparmaq ucun
    $sql = "INSERT INTO users (first_name, last_name, phone) VALUES('$first_name', '$last_name', '$phone')";

    $query = $db->prepare($sql);
    $result = $query->execute();

    if (!$result) {
        $_SESSION ['status'] = 'no';
        header("Location: ../index.php");
        exit;
    }


    $sql = "SELECT COUNT(*) FROM users ";

    $query = $db->query($sql);
    $row = $query->fetchColumn();

//var_dump($row);
//die; //    yoxlamaq ucun 

    $pageCount = ceil($row / 10);

    $last = $pageCount;

//var_dump($last);
//die();
    $count = $query->rowCount();

    if ($count > 0) {
        $_SESSION ['status'] = 'ok';
        header("Location: ../index.php?page=" . $last);
    } else {
        $_SESSION ['status'] = 'ok';
        header("Location: ../index.php");
    }
} else {
    $_SESSION ['status'] = 'no';
    header("Location: ../index.php");
}
exit;

