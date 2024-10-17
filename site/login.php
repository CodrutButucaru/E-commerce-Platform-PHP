<?php

        include("class.user.php");
        $user = new User();


        if (isset($_POST["login"])) {
            extract($_POST);
                
            $login = $user->check_login($email, $parola);
            if ($login) {

                $_SESSION["login"] = $login;
                // conectare reusita

                header("location:home.php");
            } else {
                // cnectare nereusita
                echo 'E-mail sau parola gresita!';
            }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de logare a contului pentru useri.">
    <meta name="keywords" content="logare-cont, login">
    <title>Conectati-va</title>
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

        input[type="text"],
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
            background-color: #555;
        }

        a {
            color: grey;
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
        <h1>Conectati-va</h1>
        <form action="login.php" method="post">
            <input type="text" name="email" placeholder="E-mail" required /><br>
            <input type="password" name="parola" placeholder="Parola" required /><br>
            <input type="submit" name="login" value="Login" />
        </form>
        <p>Nu ai cont? <a href="signup.php">Înregistrează-te!</a></p>
    </div>
</body>

</html>
