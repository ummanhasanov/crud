<?php

include ("../conn.php");

session_start();

if (isset($_POST['user_update'])) {

    $id = $_GET['id'];
    $first_name = $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET first_name = ?, last_name = ?, phone = ? WHERE id = '$id'";

//           database baglan bunu hazirla ve

    $query = $db->prepare($sql);
    $query->execute(array($first_name, $last_name, $phone));

    $count = $query->rowCount();

    if ($count > 0) {
        if ($_SESSION['back_page'] || $_SESSION['ustatus']) {
            $_SESSION['ustatus'] = 'ok';
            header("Location: ../index.php?page=" . $_SESSION['back_page']);
        } else {
            $_SESSION['ustatus'] = 'ok';

            header("Location: ../index.php");
        }
    } else {
        $_SESSION['ustatus'] = 'no';
        header("Location: ../index.php");
    }
    exit;
}

 


