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

$pageCount = ceil($say / 10);

if (isset($_GET['status']) || isset($_GET['dstatus']) || isset($_GET['gstatus'])) {
    //  islem tamamlandiqdan sonra refresh edib read.php e geri gelsin
    header("Refresh:1 url=read.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <style>
            table, tr, td, th, thead{
                text-align: center;
                vertical-align: center;
            }
        </style>
        <!-- font awesome scripti -->
        <script src="https://kit.fontawesome.com/49b70e1494.js" crossorigin="anonymous"></script>
        <!-- bootstrapdan alindi css scripti -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body> 
        <?php
        if (isset($_GET['dstatus'])) {

//              $_GET  'dstatus' == "ok" a esitse

            if ($_GET['dstatus'] == "ok") {
                ?>
                <div class="alert alert-success">

                    <b> Musteri Silme Islemi Basarili ! </b>
                </div>


                <?php
//              $_GET  'dstatus' == "no" a esitse 
            } if ($_GET['dstatus'] == "no") {
                ?>

                <div class="alert alert-danger">

                    <b> Musteri Silinirken Bir Hata Olustu  </b>
                </div>
                <?php
            }
        }

        if (isset($_GET['gstatus'])) {

//              $_GET  'gstatus' == "ok" a esitse

            if ($_GET['gstatus'] == "ok") {
                ?>
                <div class="alert alert-success">

                    <b> Musteri Guncelleme Islemi Basarili ! </b>
                </div>


                <?php
//              $_GET  'gstatus' == "no" a esitse 
            } if ($_GET['gstatus'] == "no") {
                ?>

                <div class="alert alert-danger">

                    <b> Musteri Guncellenirken Bir Hata Olustu  </b>
                </div>
                <?php
            }
        }
        ?>

        <!-- musteri siralamasina baxmaq ucun table -->

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Musteri adi</th>
                        <th scope="col">Musteri soyadi</th>
                        <th scope="col">Musteri numarasi</th>
                        <th scope="col">Islemler </th>
                    </tr>
                </thead>
                <tbody>
                    <a colspan="3" class="btn btn-success" href="index.php" style="text-align: end"> <i class="fa-solid fa-circle-plus"></i> New User </a>
                    <?php foreach ($data as $datas) : ?>
                        <tr>
                            <td> <?php echo $datas['id']; ?> </td>
                            <td> <?php echo $datas['musteri_ad']; ?> </td>
                            <td> <?php echo $datas['musteri_soyad']; ?> </td>
                            <td> <?php echo $datas['musteri_numara']; ?> </td>
                            <td>
                                <!-- guncelle duymesini basanda guncellesayfa.php ye getmesi -->
                                <!-- ucun <a> taginin icinde href="" istifade edirik -->

                                <a class="btn btn-success" href="guncellesayfa.php?id=<?php echo $datas['id']; ?>"> <i class="fa-solid fa-pen"></i> </a>
                                <!-- sil duymesini basanda sil.php ye getmesi -->
                                <!-- ucun <a> taginin icinde href="" istifade edirik -->
                                <a class="btn btn-danger" href="islem/sil.php?id=<?php echo $datas['id']; ?>"> <i class="fa-solid fa-trash"></i> </a>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">

                    <li class="page-item <?php
                    if ($page == 1) {
                        echo 'disabled';
                    }
                    ?>"><a class="page-link" href="/phpcrud/read.php?page=<?= $page - 1 ?>">Previous</a></li>

                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>

                        <li class="page-item <?php
                       if ($page == $i) {
                        echo 'active';
                    }
                      ?>"><a class="page-link" href="/phpcrud/read.php?page=<?= $i ?>"> <?= $i ?> </a></li>

                    <?php } ?>

                    <li class="page-item <?php
                    if ($page == $pageCount) {
                        echo "disabled";
                    }
                    ?>"><a class="page-link" href="/phpcrud/read.php?page=<?= $page + 1 ?>">Next</a></li>
                </ul>
                
            </nav>
        </div>


