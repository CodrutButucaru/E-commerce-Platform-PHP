<?php
include_once("class.admin.php");
$admin = new Admin();

if(isset($_POST["submit"])){
    $parola_veche = $_POST["parola_veche"];
    $parola_noua = $_POST["parola_noua"];
    $con_parola = $_POST["con_parola"];
    if($parola_noua == $con_parola && $parola_veche != $parola_noua){
    $admin->admin_change_passwd($parola_veche, $parola_noua);}
    else if($parola_noua != $con_parola){
        echo"Parola noua nu coincide cu cea confirmata";
    }
    else{
        echo"Parola noua trebuie sa fie diferita de cea veche.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de schimbare a parolei pentru administratori.">
    <meta name="keywords" content="schimbare-parola, password-change">
    <title></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }

        #container {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        a {
            color: green;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>Schimbare Parola</h1>
        <form action="" method="post">
            <input type="password" name="parola_veche" placeholder="Parola Veche" required /><br>
            <input type="password" name="parola_noua" placeholder="Parola Noua" required /><br>
            <input type="password" name="con_parola" placeholder="Confirma Parola Noua" required /><br>
            <input type="submit" name="submit" value="Schimbare Parola" />
        </form>
        <p><a href="index.php">Pagina Principala</a></p>
    </div>
</body>

</html>
