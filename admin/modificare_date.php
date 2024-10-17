<?php
include("class.eveniment.php");

$eveniment = new Eveniment();
if ($eveniment->db->connect_error) {
    die("Eroare la conectarea la baza de date: " . $eveniment->db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEveniment = $_POST["idEveniment"];
    $titlu = $_POST["titlu"];
    $descriere = $_POST["descriere"];
    $locatie = $_POST["locatie"];
    $data_si_ora = $_POST["data_si_ora"];
    $nr_bilete = $_POST["nr_bilete"];
    $pret_pe_bilet = $_POST["pret_pe_bilet"];
    $afis = $_POST["afis"];
    $speaker = $_POST["speaker"];
    $parteneri = $_POST["parteneri"];
    $sponsori = $_POST["sponsori"];
    $agenda = $_POST["agenda"];
    $contact = $_POST["contact"];

    $rezultatModificare = $eveniment->modificareDate($idEveniment, $titlu, $descriere, $locatie, $data_si_ora, $nr_bilete, $pret_pe_bilet, $afis, $speaker, $parteneri, $sponsori, $agenda, $contact);

    echo $rezultatModificare;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificare Evenimente</title>
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
            padding: 10px;
            text-align: center;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>Modificare Evenimente</h1>
</header>

<form action="" method="post">
    <label for="idEveniment">Selectează Eveniment:</label>
    <select name="idEveniment" id="idEveniment" required>
        <?php
        $sqlSelect = "SELECT IdEveniment, Titlu FROM evenimente";
        $resultSelect = $eveniment->db->query($sqlSelect);

        while ($rowSelect = $resultSelect->fetch_assoc()) {
            echo "<option value='" . $rowSelect['IdEveniment'] . "'>" . $rowSelect['Titlu'] . "</option>";
        }
        ?>
    </select>

    <label for="titlu">Titlu eveniment:</label>
    <input type="text" name="titlu" id="titlu" required>

    <label for="descriere">Descriere eveniment:</label>
    <textarea name="descriere" id="descriere" rows="4" required></textarea>

    <label for="locatie">Locatie eveniment:</label>
    <input type="text" name="locatie" id="locatie" required>

    <label for="data_si_ora">Data și Ora evenimentului:</label>
    <input type="datetime-local" name="data_si_ora" id="data_si_ora" required>

    <label for="nr_bilete">Număr bilete disponibile:</label>
    <input type="number" name="nr_bilete" id="nr_bilete" required>

    <label for="pret_pe_bilet">Preț per bilet:</label>
    <input type="number" name="pret_pe_bilet" id="pret_pe_bilet" required>

    <label for="afis">Cale către afiș (URL sau cale locală):</label>
    <input type="text" name="afis" id="afis" required>

    <label for="speaker">Numele Speakerului:</label>
    <input type="text" name="speaker" id="speaker" required>

    <label for="parteneri">Parteneri (separate prin virgulă):</label>
    <input type="text" name="parteneri" id="parteneri" required>

    <label for="sponsori">Sponsori (separate prin virgulă):</label>
    <input type="text" name="sponsori" id="sponsori" required>

    <label for="agenda">Agenda (separate prin virgulă):</label>
    <input type="text" name="agenda" id="agenda" required>

    <label for="contact">Contact (separate prin virgulă):</label>
    <input type="text" name="contact" id="contact" required>

    <input type="submit" value="Actualizare Eveniment">
</form>
</body>
</html>