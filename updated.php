<?php
include ("conn.php");
$id = $_GET['id'];
//  Tablonu (cedveli) sec deyirik
$sql = "SELECT * FROM users WHERE id = '$id'"; // ikinci cedvelde database de
$query = $db->query($sql);  //  id uzre yaddasda olanlara baxmaq ucun
$data = $query->fetch(PDO::FETCH_ASSOC); //Bazadan bir verini yenileyirik
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
        <br><br><br>
        <div class="container" >
            <h4 class="text-center my-3"> Update User </h4>
            <hr> 
            <form action="config/update.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off" >
                <table class="table">
                    <tr>
                        <td> User Name :</td><td><input type="text" name="first_name" class="form-control"pattern="[A-Za-z]+" required value="<?php echo $data['first_name']; ?>" ></td>
                    </tr>
                    <tr>              
                        <td> User Surname :</td> <td><input type="text" name="last_name" class="form-control" pattern="[A-Za-z]+" required value="<?php echo $data['last_name']; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Phone number :</td> <td> <input type="text" name="phone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required value="<?php echo $data['phone']; ?>"> <small>Format: 123-456-7890</small></td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td><td><input type="submit" name="user_update" class="btn btn-success" value="Update" > </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- bootstrapdan alindi javascript scripti -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
    </body>
</html>

