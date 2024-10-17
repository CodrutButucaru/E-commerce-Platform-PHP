<?php
include_once("class.user.php");
$user = new User();

if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["parola"]) && isset($_POST["telefon"])) {
    
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $parola = $_POST["parola"];
    $telefon = $_POST["telefon"];
    $inregistrare = $user->user_signup($fullname,$email,$parola,$telefon);
    if ($inregistrare) {
        header("Location:home.php");
    }else{  
        echo "Email-ul coincide cu un alt utilizator inregistrat.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de creare cont pentru administratori.">
    <meta name="keywords" content="creare-cont, signup">
    <title>Sign up</title>
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
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
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
            background-color: grey;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>Sign up</h1>
        <form action="signup.php" method="post">
            <input type="text" name="fullname" placeholder="Nume si prenume" required /><br>
            <input type="email" name="email" placeholder="Email" required /><br>
            <input type="password" name="parola" placeholder="Parola" required /><br>
            <input type="text" name="telefon" placeholder="Telefon" required /><br>
            <input type="submit" name="submit" value="Sign up" />
        </form>
    </div>
</body>

</html>