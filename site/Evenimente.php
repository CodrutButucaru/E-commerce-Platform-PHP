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

$num_events_on_each_page = 15;
// pagina curenta in URL va aparea ca index.php? Page = events & p = 1, index.php? Page = events & p = 2...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

$eveniment = new Eveniment();

// selectam evenimentele de la cea mai apropiata data la cea mai indepartata
$sql = 'SELECT * FROM evenimente ORDER BY Data_si_ora ASC LIMIT ?,?';
$stmt = $eveniment->db->prepare($sql);

if ($stmt) {
    //cream o var pt pagina curenta
    $offset = ($current_page - 1) * $num_events_on_each_page;

    // bind param pentru limita
    $stmt->bind_param('ii', $offset, $num_events_on_each_page);

    $stmt->execute();

    $result = $stmt->get_result();
    $events = $result->fetch_all(MYSQLI_ASSOC);

    // inchidem declaratia si rezultatul
    $stmt->close();
    $result->close();
} 
else {
    //daca exista o eroare la declaratie
    echo "Eroare la pregatirea instructiunii SQL: " . $eveniment->db->error;
}


//nr total de evenimente
$total_events = $eveniment->db->query('SELECT * FROM evenimente')->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     .events {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .events-wrapper {
            display: flex;
            margin: 50px;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .event {
            position: relative;
            width: calc(20% - 15px); /* Aproximativ 4 evenimente pe linie */
            margin-bottom: 20px;
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px; /* Ajustează înălțimea la nevoie */
        }

        .buy-button {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .buy-button:hover {
            background-color: #297fb8;
        }

        .event:hover {
            transform: scale(1.05);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-left: 5%;
            margin-top: 2%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date {
            font-size: 14px;
            color: #666;
            margin-left: 5%;
            margin-top: 2%;
        }

        .buttons {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-right: 50%;
            margin-left: 50%;
            margin-bottom: 15px;
        }

        .buttons a {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
            
        }

        .buttons a:hover {
            background-color: #297fb8;
        }

</style>
</head>
</body>
<div class="events content-wrapper">
    <div class="events-wrapper">
        <?php foreach ($events as $event): ?>
            <div class="event">
                <a href="Eveniment.php?page=event&id=<?php echo $event['IdEveniment'] ?>" class="event">
                    <div class="title"><?php echo $event['Titlu'] ?></div>
                    <div class="date"><?php echo date('d M Y', strtotime($event['Data_si_ora'])); ?></div>
                    <div class="image-container">
                        <img src="/proiect1/poze/<?php echo $event['Afis']?>" width="200" height="200" alt="<?php echo $event['Titlu']?>">
                    </div>
                </a>
                <div>
                    <a href="#" class="buy-button">Cumpara bilet</a>
                </div>
            </div>
        <?php endforeach;?>
    </div>

    <div class="buttons">
        <?php if ($current_page > 1): ?>
            <a href="Evenimente.php?page=events&p=<?php echo $current_page - 1 ?>">Prev</a>
        <?php endif; ?>

        <?php if ($total_events > ($current_page * $num_events_on_each_page) - $num_events_on_each_page + count($events)): ?>
            <a href="Evenimente.php?page=events&p=<?php echo $current_page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<body>
</html>


<?php
  include("footer.html");
  ?>
