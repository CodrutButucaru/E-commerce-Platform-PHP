<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare Evenimente</title>
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

        table.styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table.styled-table thead tr {
            background-color: #4caf50;
            color: white;
        }

        table.styled-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        table.styled-table th,
        table.styled-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.styled-table th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>
<header>
    <h1>Vizualizare Evenimente</h1>
</header>

<?php
include("class.eveniment.php");

$eveniment = new Eveniment();

$eveniment->vizualizareDate();

$eveniment->inchideConexiune();
?>

</body>
</html>
