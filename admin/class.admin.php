<?php
include("connection.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Admin
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {
            echo "Eroare: nu se poate conecta la baza de date!";
            exit;
        }
    }


    public function check_login($username, $parola)
    {
        $parola = md5($parola);
        $sql = "select IdAdministrator from administratori where Username = '$username' and Parola = '$parola'";

        $result = mysqli_query($this->db, $sql);
        $admin_data = mysqli_fetch_array($result);
        $count_rows = $result->num_rows;

        if ($count_rows == 1) {
            // Parola este corecta
            $_SESSION['login'] = TRUE;
            $_SESSION['id'] = $admin_data['IdAdministrator'];
            $_SESSION['username'] = $admin_data['Username'];
            return true;
        } else {
            //Parola este incorecta sau administrator inexistent
            return false;
        }
    }


    /*** start session ***/
    public function get_session()
    {
        if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE) {
            return 1; 
        } else {
            return 0;
        }
    }


    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }


    public function user_signup($username, $parola, $fullname, $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Email-ul nu este valid!");
        }
    
        // Validare parola
        if (strlen($parola) > 20 || strlen($parola) < 5) {
            exit("Parola trebuie să fie între 5 și 20 de caractere!");
        }

        $parola = md5($parola);

        $check_email = "SELECT * FROM administratori WHERE Email=?";
        $stmt = mysqli_prepare($this->db, $check_email);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $count_rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
    
        if ($count_rows >= 1) {
            exit("Există deja un administrator cu acest email!");
        } else {
            // Inserare utilizator cu instrucțiuni pregătite
            $insert_user = "INSERT INTO administratori (Username, Parola, Fullname, Email) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->db, $insert_user);
            mysqli_stmt_bind_param($stmt, "ssss", $username, $parola, $fullname, $email);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
    
            return $result;
        }
    }

    public function user_delete()

{
    $id = $_SESSION['id'];
    $sql_delete = "DELETE FROM administratori WHERE IDAdministrator='$id'";
    mysqli_query($this->db, $sql_delete);
    session_destroy();
    }
    


    public function admin_change_passwd($parola_veche, $parola_noua)
{
    $id = $_SESSION['id'];

    // luam parola veche din bd pe baza id-ului
    $query = "SELECT Parola FROM administratori WHERE IdAdministrator='$id'";
    $result = mysqli_query($this->db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $existing_password = $row['Parola'];

        // verificam daca parola veche coincide cu cea din bd
        if (md5($parola_veche) == $existing_password) {

            // Generăm un hash nou pentru parola
            $new_password_hashed = md5($parola_noua);

            // actualizam parola in bd
            $sql_update = "UPDATE administratori SET Parola='$new_password_hashed' WHERE IdAdministrator='$id'";
            $result_update = mysqli_query($this->db, $sql_update);

            if ($result_update) {
                echo "Parola a fost actualizată cu succes!";
            }
        }
         else {
            echo "Parola veche introdusă nu corespunde cu cea din baza de date.";
        }
    } 
    }
}
