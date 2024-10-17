<?php

include_once("class.admin.php");
$admin = new Admin();
if(!$admin->get_session()){
   die("Nu ai acces pe aceasta pagina!<br>Intra in cont sau creeaza unul:<br> <a href='admin.html'>Continua</a>");
}

?>
<?php
   include("header.html");
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou de control</title>
    <style>
        body {
            background-color: #f4f4f4; /* Culoarea de fundal pentru body (gri) */
            margin: 0;
            padding: 0;
            color: #000000; /* Culoarea textului (negru) */
            transition: background-color 0.3s ease; /* Efect de tranziție pentru schimbarea culorii de fundal */
        }

        .dashboard-section {
            opacity: 0; /* Opacitatea initiala */
            transform: translateY(20px); /* Deplasare initiala */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Efect de tranziție pentru afișarea butoanelor */
        }

        .dashboard-section.show {
            opacity: 1; /* Opacitatea la afișarea butoanelor */
            transform: translateY(0); /* Anuleaza deplasarea initiala */
        }

        .dashboard-link {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            background-color: #ffffff; /* Culoarea de fundal pentru butoane, alba */
            color: #000000; /* Culoarea textului, negru */
            border: 2px solid #ffffff; /* Bordura */
            border-radius: 5px; /* Colțuri rotunjite pentru butoane */
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease; /* Efect de tranziție pentru schimbarea culorii de fundal, transformarea butoanelor la hover, și schimbarea culorii textului la hover */
        }

        .dashboard-link:hover {
            background-color: #cccccc; /* Culoarea butoanelor la hover, gri deschis */
            transform: scale(1.05); /* Efect de scalare la hover */
            color: #000000; /* Culoarea textului la hover, negru */
        }

        .dashboard-link img {
            width: 20px; /* Ajustează dimensiunea imaginii la nevoie */
            height: auto;
            margin-left: 10px; /* Spațiu între text și pictogramă */
            border-radius: 50%; /* Colțuri rotunjite pentru imagine */
        }
    </style>
</head>
<body>
<div class="dashboard-section">
    <table>
        <tr>
            <td><a href='vizualizare_date.php' class="dashboard-link">Vizualizare Evenimente <img src="view_icon.png" alt="Vizualizare"></a></td>
        </tr>
        <tr>
            <td><a href='inserare_date.php' class="dashboard-link">Inserare Evenimente <img src="plus_icon.png" alt="Inserare"></a></td>
        </tr>
        <tr>
            <td><a href='modificare_date.php' class="dashboard-link">Modificare Evenimente <img src="edit_icon.png" alt="Modificare"></a></td>
        </tr>
        <tr>
            <td><a href='stergere_date.php' class="dashboard-link">Stergere Evenimente <img src="trash_bin.png" alt="Stergere"></a></td>
        </tr>
        <tr>
            <td><a href='../sendemail/SendEmail.php' class="dashboard-link">Trimitere automata de invitatii <img src="send_icon.png" alt="Trimitere"></a></td>
        </tr>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Afișează butoanele cu o întârziere mică pentru a permite efectul de tranziție
        document.querySelector(".dashboard-section").classList.add("show");
    });
</script>

</body>
</html>

<?php
include("footer.html");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panoul de control a administratorilor.">
    <meta name="keywords" content="panou-de-control, home, index">
   <title>Panou de control</title>

</head>
<body>
<div class="dashboard-section">
    <table>
        <tr>
            <td><a href='vizualizare_date.php' class="dashboard-link">Vizualizare Evenimente</a></td>
        </tr>
        <tr>
            <td><a href='inserare_date.php' class="dashboard-link">Inserare Evenimente</a></td>
        </tr>
        <tr>
            <td><a href='modificare_date.php' class="dashboard-link">Modificare Evenimente</a></td>
        </tr>
        <tr>
            <td><a href='stergere_date.php' class="dashboard-link">Stergere Evenimente</a></td>
        </tr>
        <tr>
            <td><a href='/../proiect1/sendemail/SendEmail.php' class="dashboard-link">Transmitere automata de invitatii</a></td>
        </tr>
    </table>
</div>
</body>
</html>


<?php
include("footer.html");
?>
