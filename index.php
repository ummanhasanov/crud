<?php
include ("conn.php");

session_start();

if (isset($_GET['page'])) {
    $_SESSION['back_page'] = $_GET['page'];
} else {
    $_SESSION['back_page'] = '';
}
//var_dump($_SESSION);
//die; //    yoxlamaq ucun 
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
$row = $query->fetchColumn();

//var_dump($row);
//die; //    yoxlamaq ucun 

$pageCount = ceil($row / 10);

//var_dump($page);
//
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
            }
        </style>
        <!-- font awesome scripti -->
        <script src="https://kit.fontawesome.com/49b70e1494.js" crossorigin="anonymous"></script>
        <!-- bootstrapdan alindi css scripti -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body> 

        <?php
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] == "ok") {
                ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <b> User added successful ! </b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            } if ($_SESSION['status'] == "no") {
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <b> User added unsuccessful !</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
            unset($_SESSION['status']);
        }

        if (isset($_SESSION['dstatus'])) {
            if ($_SESSION['dstatus'] == "ok") {
                ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <b> User deleted successful ! </b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            } if ($_SESSION['dstatus'] == "no") {
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <b>User deleted unsuccessful  </b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
              unset($_SESSION['dstatus']);
        }

        if (isset($_SESSION['ustatus'])) {
            if ($_SESSION['ustatus'] == "ok") {
                ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <b> User updated successful !  </b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            } if ($_SESSION['ustatus'] == "no") {
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <b> User updated unsuccessful !  </b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
              unset($_SESSION['ustatus']);
        }
        ?>

        <!-- musteri siralamasina baxmaq ucun -->
        <br><br><br>
        <div class="container">

            <table class="table">
                <thead> <td colspan="4" > </td> <td></td> <td><a class="btn btn-primary" href="create.php" > <i class="fa-solid fa-circle-plus"></i> New User </a> </td>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Surname</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach ($data as $datas) : ?>
                        <tr>
                            <td> <?php echo $datas['id']; ?> </td>
                            <td> <img src="<?php echo $datas['photo']; ?>" class="rounded-circle" width="70" height="70" /> </td>
                            <td> <?php echo $datas['first_name']; ?> </td>
                            <td> <?php echo $datas['last_name']; ?> </td>
                            <td> <?php echo $datas['phone']; ?> </td>
                            <td>
                                <a class="btn btn-success" href="profile.php?id=<?php echo $datas['id']; ?>"> <i class="fa-solid fa-image"></i> </a>
                                <a class="btn btn-primary" href="updated.php?id=<?php echo $datas['id']; ?>"> <i class="fa-solid fa-pen"></i> </a>
                                <a class="btn btn-danger" href="config/delete.php?id=<?php echo $datas['id']; ?>" onclick="return confirm('Are you sure to delete this user?')"> <i class="fa-solid fa-trash"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php
                    if ($page <= 1) {
                        echo 'disabled';
                    }
                    ?>"><a class="page-link" href="/phpcrud/index.php?page=<?= $page - 1 ?>">Previous</a></li>
                        <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                        <li class="page-item <?php
                        if ($page == $i) {
                            echo 'active';
                        }
                        ?>"><a class="page-link" href="/phpcrud/index.php?page=<?= $i ?>"> <?= $i ?> </a></li>
                        <?php } ?>
                    <li class="page-item <?php
                    if ($page >= $pageCount) {
                        echo "disabled";
                    }
                    ?>"><a class="page-link" href="/phpcrud/index.php?page=<?= $page + 1 ?>">Next</a></li>
                </ul>
            </nav>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
