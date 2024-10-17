<?php

include_once("class.user.php");
$user = new User();

// verificam dacă utilizatorul este logat

if (!$user->get_session()){
  include("header3.html");}

  //daca nu e logat afisam header-ul 2
  else{
    include("header4.html");
  }

?>

<?php

  include("../admin/class.eveniment.php");

// verif dacă exista un id de eveniment în URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEveniment = (int)$_GET['id'];

    $eveniment = new Eveniment();

    //inf despre ev
    $sql = 'SELECT * FROM evenimente WHERE IdEveniment = ?';
    $stmt = $eveniment->db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $idEveniment);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
        } else {
            echo "Evenimentul nu există.";
            exit();
        }

        $stmt->close();
    } else {
        echo "Eroare la pregătirea instrucțiunii SQL: " . $eveniment->db->error;
    }
} 
    else {
        echo "Evenimentul nu a fost specificat.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['Titlu']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            display: none;
        }

        .container {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    justify-content: space-between; 
}

.left-side {
    width: 48%;
}

.right-side {
    width: 48%; 
    padding: 0 20px;
}


        .section {
            margin-bottom: 20px;
        }

        .buy-button {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease-in-out;
            text-align: center;
        }

        .buy-button:hover {
            background-color: #297fb8;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo $event['Titlu']; ?></h1>
    </header>

    <div class="container">
        <div class="left-side">
            <div class="section">
            <div class="image-container">
                    <img src="/proiect1/poze/<?php echo $event['Afis']?>" width="400" height="600" alt="<?php echo $event['Titlu']?>">
            </div>
            </div>

            <div class="section">
                <ul>
                    <li><a href="Pag2.php?page=event&id=<?php echo $event['IdEveniment']; ?>">Agenda</a></li>
                    <li><a href="Pag3.php?page=event&id=<?php echo $event['IdEveniment']; ?>">Speaker</a></li>
                    <li><a href="Pag4.php?page=event&id=<?php echo $event['IdEveniment']; ?>">Parteneri si sponsori</a></li>
                </ul>
            </div>
        </div>

        <div class="right-side">
            <div class="section">
                <h2><?php echo $event['Titlu']; ?></h2>
            </div>
            
            <br>

            <div class="section">
                    <p><strong>Contact:</strong> <?php echo $event['Contact']; ?></p>
                    <p><strong>Locatie:</strong> <?php echo $event['Locatie']; ?></p>
            </div>
            <a href="#" class="buy-button">Cumpără Bilet</a>
        </div>
        

    <?php
    
    
    ?>

</body>
</html>

