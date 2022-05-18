<?php

include ("../conn.php");

session_start();

if (isset($_POST['musteri_guncelle'])) {

    $id = $_GET['id'];
    $musteri_ad = $_POST['musteri_ad'];
    $musteri_soyad = $_POST['musteri_soyad'];
    $musteri_numarasi = $_POST['musteri_numarasi'];

    $sql = "UPDATE musteriler SET musteri_ad = ?, musteri_soyad = ?, musteri_numara = ? WHERE id = '$id'";

   //           database baglan bunu hazirla ve

    $query = $db->prepare($sql);
    $query->execute(array( $musteri_ad, $musteri_soyad, $musteri_numarasi
    ));

    $count = $query->rowCount();

    if ($count > 0) {
        if ($_SESSION['back_page']) {
            header("Location: ../index.php?page=" . $_SESSION['back_page'] . "&gstatus=ok");
        } else {
            header("Location: ../index.php?gstatus=ok");
        }
    } else {
        header("Location: ../index.php?gstatus=no");
    }
    exit;
}

 


