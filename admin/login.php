<?php
    include("class.admin.php");
    $admin = new Admin();

    if (isset($_REQUEST["submit"])) {
        extract($_REQUEST);
            
        $login = $admin->check_login($username, $parola);
        if ($login) {
            // Inregistrare cu succes
            header("location:index.php");
        } else {
            // Inregistrare cu esec
            echo 'username sau parola gresite!';
        }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de login a contului pentru administratori.">
    <meta name="keywords" content="logare-administrator, login, intra-in-cont">
    <title>Login Here</title>
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
            color: #4CAF50;
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
        <h1>Login Here</h1>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required /><br>
            <input type="password" name="parola" placeholder="Parola" required /><br>
            <input type="submit" name="submit" value="Login" />
        </form>
        <p>Nu ai cont? <a href="signup.php">Inregistreaza-te!</a></p>
    </div>
</body>

</html>
