<?php

include ("../conn.php");

if (isset($_POST['musteri_ekle'])) {
    $musteri_ad = $_POST['musteri_ad'];
    $musteri_soyad = $_POST['musteri_soyad'];
    $musteri_numarasi = $_POST['musteri_numarasi'];

//     SQL qeydiyyat aparmaq ucun
    $sql = "INSERT INTO musteriler (musteri_ad, musteri_soyad, musteri_numara) VALUES('$musteri_ad', '$musteri_soyad', '$musteri_numarasi')";

    $query = $db->prepare($sql);
    $query->execute();

    $sql = "SELECT COUNT(*) FROM musteriler ";

    $query = $db->query($sql);
    $row = $query->fetchColumn();

//var_dump($row);
//die; //    yoxlamaq ucun 

    $pageCount = floor($row / 10) + 1;

    $last = $pageCount;

//var_dump($last);
//die();
    $count = $query->rowCount();

    if ($count > 0) {

        header("Location: ../index.php?page=" . $last . "&status=ok");
    } else {
        header("Location: ../index.php?status=ok");
    }
} else {
    header("Location: ../index.php?status=no");
}
exit;

