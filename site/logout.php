<?php
include_once("class.user.php");
$user = new User();
$user->user_logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de deconectare a contului pentru useri.">
    <meta name="keywords" content="deconectare-cont, deconectare, logout">
    <title>Deconectare</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            text-align: center;
            cursor: pointer;
        }

        .btn:hover {
            background-color: grey;
        }
    </style>
</head>

<body>
        <h2>Ai fost deconectat cu succes!</h2>
        <a class="btn" href="home.php">Inapoi la site</a>
</body>

</html>
