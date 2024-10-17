<?php
include("database.php");
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

if (!$mysqli) {
    die("Conexiunea la baza de date a eșuat: " . mysqli_connect_error());
}

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'codrutbutucaru@gmail.com';                     //SMTP username
    $mail->Password   = 'zlto nxob csos wtox';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('codrutbutucaru@gmail.com');

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$query = "SELECT * FROM evenimente";
$result = mysqli_query($mysqli, $query);

if ($result && mysqli_num_rows($result) > 0) {

    while ($evenimente = mysqli_fetch_assoc($result)) {
        // Obține detalii despre eveniment
        $usersInvited = array();
        $eventTitle = $evenimente['Titlu'];
        $eventDate = $evenimente['Data_si_ora'];

        // Obține utilizatori din baza de date
        $queryUsers = "SELECT * FROM user";
        $resultUsers = mysqli_query($mysqli, $queryUsers);

        if ($resultUsers && mysqli_num_rows($resultUsers) > 0) {
            while ($user = mysqli_fetch_assoc($resultUsers)) {
                // Obține detalii despre utilizator
                $email = $user['Email'];
                $Nume = $user['Fullname'];

                // Check if the invitation was already sent to this user
                if (!in_array($email, $usersInvited)) {
                    // Trimite invitație prin email
                    try {
                        $mail->clearAddresses();
                        $mail->clearReplyTos();

                        $mail->addAddress($email, $Nume);
                        $mail->addReplyTo('codrutbutucaru@gmail.com', 'Informations');

                        $mail->isHTML(true);
                        $mail->Subject = 'Invitatie la evenimentul: '  .$eventTitle;
                        $mail->Body = "Buna, $Nume! Va invitam la evenimentul '$eventTitle' care va avea loc la data de $eventDate.";

                        $mail->send();

                        echo "E-mailul de invitatie a fost trimis cu succes catre $email pentru evenimentul $eventTitle.<br>";

                        // Add the user to the list of invited users
                        array_push($usersInvited, $email);
                        // $usersInvited[] = $email;
                    } catch (Exception $e) {
                        echo "Eroare la trimiterea emailului catre $email: " . $mail->ErrorInfo . '<br>';
                    }
                }
            }
        }
    }
} else {
    echo "Nu exista evenimente in baza de date.";
}

// Închide conexiunea la baza de date
mysqli_close($mysqli);
?>