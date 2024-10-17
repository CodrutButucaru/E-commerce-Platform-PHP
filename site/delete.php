<?php  

include_once("class.user.php");
$user = new User();

if(isset($_POST["valideaza"])){
    $email = $_SESSION["email"];
    if(isset($_POST["da"])) {
        $stergere = $user->user_delete($email);
        echo "Contul de utilizator a fost șters cu succes!<br>";
        echo "<a href='home.php'>Intoarce-te la pagina principala</a>";
     
    }

    else{
        header("location:home.php");

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de stergere a contului pentru useri.">
    <meta name="keywords" content="Stergere-cont, delete-user">
    <title>Șterge Cont</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        #container {
            width: 70%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        input[type="radio"] {
            margin: 10px;
        }

        input[type="submit"] {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            text-align: center;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: grey;
        }
    </style>
</head>

<body>
    <div id="container">
        <h3>Sunteți sigur că doriți să vă ștergeți contul?</h3>
        <form action="delete.php" method="post">
            <input type="radio" name="da"> Da
            <br>
            <input type="radio" name="nu"> Nu
            <br>
            <input type="submit" name="valideaza" value="Alege">
        </form>
        <br>
    </div>
</body>

</html>
