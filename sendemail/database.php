<?php
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $database = "evenimentedb";

   $mysqli = new mysqli($hostname, $username, $password, $database);

   if(!mysqli_connect_errno()){

     //echo "Conectat la baza de date <br>".$database;
   }

   else{

    echo "Nu se poate conecta";
    exit();
   }

   