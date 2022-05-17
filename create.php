<?php

include ("conn.php");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * 10;
} else {
    $offset = 0;
    $page = 1;
}
$sql = "SELECT * FROM musteriler LIMIT $offset, 10"; // ikinci cedvelde database
$query = $db->query($sql);  //  de yaddasda olanlara baxmaq ucun
$data = $query->fetchAll(PDO::FETCH_ASSOC); // Butun bazani cekirik

$sql = "SELECT COUNT(*) FROM musteriler ";

$query = $db->query($sql);
$say = $query->fetchColumn();

//var_dump($say);
//die; //    yoxlamaq ucun 
//
//
//var_dump($_SESSION);
//die();

$pageCount = ceil($say / 10);

//if (isset($_GET['status']) || isset($_GET['dstatus']) || isset($_GET['gstatus'])) {
//    //  islem tamamlandiqdan sonra refresh edib index.php e geri gelsin
//    header("Refresh:1 url=index.php");
//}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <style>
            table, tr, td, th, thead, h4 {
                text-align: center;
             }
        </style>
        <!-- font awesome scripti -->
        <script src="https://kit.fontawesome.com/49b70e1494.js" crossorigin="anonymous"></script>
        <!-- bootstrapdan alindi css scripti -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <br><br><br>
        <div class="container" >
            <h4> Musteri ekle </h4>
            <hr> 
            <div class="sticky-top" >
            </div>
            <form action="islem/insert.php" method="POST">
                <table class="table">
                    <tr><td colspan="3"> </td><td> <a align="left" class="btn btn-dark" href="index.php"><i class="fa-solid fa-eye"></i> HOME </a> </td></tr>
                    <tr>
                        <td> User Name :</td><td><input type="text" name="musteri_ad" class="form-control"></td>  
                    </tr>
                    <tr>              
                        <td> User Surname :</td> <td><input type="text" name="musteri_soyad" class="form-control"> </td>
                    </tr>
                    <tr>
                        <td> Phone number :</td> <td> <input type="text" name="musteri_numarasi" class="form-control"> </td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td><td><input type="submit" name="musteri_ekle" class="btn btn-success" > </td>
                    </tr>
                </table>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>