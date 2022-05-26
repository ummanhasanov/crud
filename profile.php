<?php
include ("conn.php");

if (isset($_POST['upload'])) {
    $id = $_GET['id'];

    $file_name = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];

    $location = "upload/" . $file_name;

    if ($file_size < 524000) {
        if (move_uploaded_file($file_temp, $location)) {
            try {
                $db->setAttribute(PDO::ATTR_ERRMODE);
                $sql = "UPDATE users SET Photo='$location' WHERE id = '$id'";
                $db->exec($sql);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $db = null;
            header('location:index.php');
        }
    } else {
        echo "<script>alert('File size is too large to upload')";
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- font awesome scripti -->
        <script src="https://kit.fontawesome.com/49b70e1494.js" crossorigin="anonymous"></script>
        <!-- bootstrapdan alindi css scripti -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $query = $db->prepare($sql);
        $result = $query->execute();
        $result = $query->fetch();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Profile Upload</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload Here</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" name="upload" class="btn btn-danger">Upload</button>
                    </form>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
