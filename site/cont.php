<?php
include_once("class.user.php");
$user = new User();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de informatii a contului pentru useri.">
    <meta name="keywords" content="informatii-cont">
    <title>Contul Meu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }

        #container {
            width: 70%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }

        a {
    display: inline-block;
    margin: 10px 5px;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    background-color: #333;
    text-align: center;
}

a:hover {
    background-color: grey;
}

    </style>
</head>

<body>
    <div id="container">
        <h1>Informații despre Cont</h1>
        <p>Email: <?php echo $_SESSION['email']; ?></p>
        <p>Nume: <?php echo $user->get_fullname($_SESSION['email']); ?></p>
        <p>Număr de Telefon: 0<?php echo $user->get_phoneNumber($_SESSION['email']); ?></p>
        <!--<a href="#">Istoric</a>-->
        <a href="pass.php">Modifica parola</a>
        <a href="delete.php">Sterge cont</a>
    </div>
</body>

</html>
