<?php
  include_once("class.user.php");
  $user = new User();
  
  // verificam dacă utilizatorul este logat
  
  if (!$user->get_session()){
    include("header2.html");}
  
    //daca nu e logat afisam header-ul 2
    else{
      include("header.html");
    }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Descoperă și participă la cele mai tari evenimente. Bine ai venit pe platforma noastră de evenimente!">
    <meta name="keywords" content="evenimente, participare, distracție">
    <title>Evenimente</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
        }

        section {
            margin: 50px;
            text-align: center;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .content-container {
            position: relative;
        }
    </style>
</head>
<body>



<section class="content-container">
    <div class="content-text">
        <h2>De ce să te alături?</h2>
        <p>Pe platforma noastră, vei găsi o varietate de evenimente, de la concerte și expoziții până la conferințe și petreceri tematice. Fii parte din comunitatea noastră și bucură-te de momente memorabile!</p>
    </div>
    <img class="content-image" src="/proiect1/poze/17.jpg" alt="poza cu Cluj-Napoca">
</section>
<br><br><br><br><br><br><br><br>
<?php
include("footer.html");
?>

</body>
</html>
