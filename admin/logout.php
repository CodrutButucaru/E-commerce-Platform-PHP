<?php
include_once("class.admin.php");
$admin = new Admin();
$admin->user_logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
   <meta name="description" content="Pagina de deconectare a contului pentru administratori.">
   <meta name="keywords" content="deconectare">
    <title></title>
    <style>
        .container {
            width: 500px;
            margin: 0 auto;
            text-align: center;
            margin-top: 100px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: #4CAF50;
            background-color: #000;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Ai fost deconectat cu succes!</h2>
        <a class="btn" href="login.php">Loghează-te din nou</a>
        <a class="btn" href="signup.php">Creează cont nou</a>
        <a class="btn" href="/proiect1/site/home.php">Website</a>
    </div>
</body>

</html>