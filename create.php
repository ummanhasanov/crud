<?php

include ("conn.php");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * 10;
} else {
    $offset = 0;
    $page = 1;
}
$sql = "SELECT * FROM users LIMIT $offset, 10"; // ikinci cedvelde database
$query = $db->query($sql);  //  de yaddasda olanlara baxmaq ucun
$data = $query->fetchAll(PDO::FETCH_ASSOC); // Butun bazani cekirik

$sql = "SELECT COUNT(*) FROM users ";

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
            <h4 class="text-center my-3"> Add User </h4>
            <hr> 

            <form action="config/insert.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <table class="table">
                    <td colspan="3"> </td><td> <a align="left" class="btn btn-info" href="index.php"><i class="fa-solid fa-eye"></i> HOME </a> </td>
                    <tr>
                        <td> User Name :</td><td><input type="text" name="first_name" class="form-control" pattern="[A-Za-z]+" required></td>  
                    </tr>
                    <tr>              
                        <td> User Surname :</td> <td><input type="text" name="last_name" class="form-control" pattern="[A-Za-z]+" required> </td>
                    </tr>
                    <tr>
                        <td> Phone number :</td> <td> <input type="tel" name="phone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><small>Format: 123-456-7890</small> </td>
                    </tr>
<!--                    <tr>
                        <td> User Photo :</td> <td> <input type="file" accept=".jpg, .png, .gif, .svg" name="image" class="form-control"> </td>
                    </tr>-->
                    <tr>
                        <td colspan="3"> </td><td><input type="submit" name="add_user" class="btn btn-success" > </td>
                    </tr>
                </table>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>