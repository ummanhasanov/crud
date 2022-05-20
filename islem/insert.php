<?php

include ("../conn.php");
session_start();
if (isset($_POST['musteri_ekle'])) {
    $musteri_ad = $_POST['musteri_ad'];
    $musteri_soyad = $_POST['musteri_soyad'];
    $musteri_numarasi = $_POST['musteri_numarasi'];

//     SQL qeydiyyat aparmaq ucun
    $sql = "INSERT INTO musteriler (musteri_ad, musteri_soyad, musteri_numara) VALUES('$musteri_ad', '$musteri_soyad', '$musteri_numarasi')";

    $query = $db->prepare($sql);
    $result = $query->execute();

    if (!$result) {
        $_SESSION ['status'] = 'no';
        header("Location: ../index.php");
        exit;
    }
    

    $sql = "SELECT COUNT(*) FROM musteriler ";

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

