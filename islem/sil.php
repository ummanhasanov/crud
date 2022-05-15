<?php

include ("../conn.php");

// GET den gelen id 
$id = $_GET['id'];

// Database de musteriler tablosundan verilen id uzre sil

$sql = "DELETE FROM musteriler WHERE id= '$id'";

$query = $db->query($sql);
$count = $query->rowCount();

if ($count > 0) {
    header("Location: ../read.php?dstatus=ok");
} else {
    header("Location: ../read.php?dstatus=no");
}
exit;

