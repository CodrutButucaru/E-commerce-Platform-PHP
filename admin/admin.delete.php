<?php  
   include_once("class.admin.php");
   $admin = new Admin();

   if(isset($_POST["valideaza"])) {
    if(isset($_POST["da"])) {
        $admin->user_delete();
        echo "Contul de utilizator a fost șters cu succes!<br>";
        echo "<a href='admin.html'>Inapoi</a>";
     
    }

    else {
        header("Location:index.php");

    }}
   ?>
   
   <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina de stergere a contului pentru administratori.">
    <meta name="keywords" content="Stergere-cont, delete-admin">
    <title></title>
    <style>
        body {
            background-color: whitesmoke;
            color: #4CAF50;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            margin-top: 100px;
        }

        h3 {
            margin-bottom: 20px;
        }

        input[type="radio"] {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #000;
            color: #4CAF50;
            padding: 8px 15px;
        }

        input[type="submit"]:hover {
            background-color: #4CAF50;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Sunteți sigur că doriți să vă ștergeți contul?</h3>
        <form action="admin.delete.php" method="post">
            <input type="radio" name="da"> Da
            <br>
            <input type="radio" name="nu"> Nu
            <br>
            <input type="submit" name="valideaza" value="Alege">
        </form>
    </div>
</body>

</html>
