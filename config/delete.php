<?php

include ("../conn.php");

session_start();
// GET den gelen id 
$id = $_GET['id'];

// Database de musteriler tablosundan verilen id uzre sil

$sql = "DELETE FROM users WHERE id= '$id'";

$query = $db->query($sql);
$count = $query->rowCount();

if ($count > 0) {
    if ($_SESSION['back_page'] || $_SESSION['dstatus']) {
         $_SESSION['dstatus'] = 'ok';
        header("Location: ../index.php?page=" . $_SESSION['back_page']);
    } else {
        $_SESSION['dstatus'] = 'ok';
        header("Location: ../index.php");
    }
} else {
    $_SESSION['dstatus'] = 'no';
    header("Location: ../index.php");
}
exit;
