<?php
include './conn.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * 10;
}
//  Tablonu (cedveli) sec deyirik
$sql = "SELECT * FROM musteriler LIMIT $offset, 10"; // ikinci cedvelde database
$query = $db->query($sql);  //  de yaddasda olanlara baxmaq ucun
$data = $query->fetchAll(PDO::FETCH_ASSOC); // Butun bazani cekirik

$sql = "SELECT COUNT(*) FROM musteriler";

$query = $db->query($sql);
$say = $query->fetchColumn();

//var_dump($say);
//die;     yoxlamaq ucun 

$pageCount = ceil($say / 10);

if (isset($_GET['status']) || isset($_GET['dstatus']) || isset($_GET['gstatus'])) {
    //  islem tamamlandiqdan sonra refresh edib index.php e geri gelsin
    header("Refresh:2 url=index.php");
}
//
//if () {
//    //  islem tamamlandiqdan sonra refresh edib index.php e geri gelsin
//    header("Refresh:2 url=index.php");
//}
//
//if ($_GET['gstatus'] == "ok") {
//    //  islem tamamlandiqdan sonra refresh edib index.php e geri gelsin
//    header("Refresh:2 url=index.php");
//}

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


        <div class="container" >
            <h4> Musteri ekle </h4>
            <hr> 
            <form action="islem/insert.php" method="POST">
                <table class="table">

                    <tr>
                        <td> Musteri adi :</td><td><input type="text" name="musteri_ad" class="form-control"></td>
                    </tr>
                    <tr>              
                        <td> Musteri soyadi :</td> <td><input type="text" name="musteri_soyad" class="form-control"> </td>
                    </tr>
                    <tr>
                        <td> Musteri numarasi :</td> <td> <input type="text" name="musteri_numarasi" class="form-control"> </td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td><td><input type="submit" name="musteri_ekle" class="btn btn-success" > </td>
                    </tr>

                </table>
            </form>



            <?php
//         $_GET den 'status' degeri gelirse 

            if (isset($_GET['status'])) {

//              $_GET  'status' == "ok" a esitse 
                if ($_GET['status'] == "ok") {

                    ?>
                    <div class="alert alert-success">

                        <b> Musteri Ekleme Basarili ! </b>
                    </div>


                    <?php
                    //              $_GET  'status' == "no" a esitse 
                } if ($_GET['status'] == "no") {

                    ?>

                    <div class="alert alert-danger">

                        <b> Musteri Eklenmesinde Bir Hata Olustu  </b>
                    </div>
                    <?php
                }
            }
            if (isset($_GET['dstatus'])) {

//            $_GET  'dstatus' == "ok" a esitse

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

//            $_GET  'gstatus' == "ok" a esitse

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

                    <li class="page-item <?php if($page == 1){echo 'disabled';} ?>"><a class="page-link" href="/crud/index.php?page=<?= $page - 1 ?>">Previous</a></li>
                    
                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>

                        <li class="page-item <?php if($page == $i){echo 'active'; } ?>"><a class="page-link" href="/crud/index.php?page=<?= $i ?>"> <?= $i ?> </a></li>

                    <?php } ?>

                    <li class="page-item <?php if($page == $pageCount) {echo "disabled"; } ?>"><a class="page-link" href="/crud/index.php?page=<?= $page + 1 ?>">Next</a></li>
                </ul>
            </nav>

        </div>

        <!-- bootstrapdan alindi javascript scripti -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  




    </body>
</html>