<?php
include("class.eveniment.php");

$eveniment = new Eveniment();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_event'])) {
    $idEveniment = $_POST['delete_event'];

    if (isset($idEveniment)) {
        $eveniment->stergereDate($idEveniment);
    } else {
        echo "Eroare: ID-ul evenimentului nu este definit.";
    }
}
$result = $eveniment->db->query("SELECT IdEveniment, Titlu FROM evenimente");

$eveniment->inchideConexiune();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ștergere Evenimente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Ștergere Evenimente</h1>
</header>

<form action="" method="post">
    <label for="delete_event">Selectați evenimentul pentru ștergere:</label>
    <select name="delete_event" id="delete_event">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"{$row['IdEveniment']}\">{$row['Titlu']}</option>";
        }
        ?>
    </select>
    <input type="submit" value="Șterge Eveniment">
</form>

<?php
$result->free();
?>

</body>
</html>