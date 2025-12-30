
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gpc-cms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS (including Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="navbar">
    <ul class="list">
        <li style="color:white;line-height:50px;margin-left:15px;font-family:Cooper Black;">
            GPC ITARSI
        </li>
        <?php
            if(isset($_SESSION["AID"])) {
                echo '
                    <li><a href="admin_home.php">Admin Home</a></li>
                    <li><a href="change_pass.php">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                ';
            } elseif(isset($_SESSION["TID"])) {
                echo '
                    <li><a href="teacher_home.php">Teacher Home</a></li>
                    <li><a href="teacher_change_pass.php">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                ';
            } else {
                echo '
                    <li><a href="index.php">ADMIN</a></li>
                    <li><a href="teacher_login.php">FACULTY</a></li>
                    <li><a href="../index.php">HOME</a></li>
                ';
            }
        ?>
    </ul>
</div>

