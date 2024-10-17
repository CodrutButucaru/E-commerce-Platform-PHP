<?php
include("connection.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class User
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

    public function check_login($email, $parola)
    {
        $parola = md5($parola);
        
        $sql = "select IdUser FROM User where Email = '$email' and Parola = '$parola'";

        $result = mysqli_query($this->db, $sql);
        $user_data = mysqli_fetch_array($result);
        $count_rows = $result->num_rows;

        if ($count_rows == 1) {
                // Parola este corectă
                $_SESSION['login'] = TRUE;
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $user_data['fullname'];
               $_SESSION['telefon'] = $user_data['telefon'];
                $_SESSION['Parola'] = $user_data['parola'];
            return true;
        } else {
            //Parola este incorectă sau nu exista un user cu datele resp
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
        $_SESSION["login"] = FALSE;
        session_destroy();
    }


    public function user_signup($fullname, $email, $parola, $telefon)
    {
        // Validare email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Email-ul nu este valid!");
        }
    
        // Validare parola
        if (strlen($parola) > 20 || strlen($parola) < 5) {
            exit("Parola trebuie să fie între 5 și 20 de caractere!");
        }
    
        //validare telefon
        if (!preg_match("/^[0-9]{10}$/", $telefon)) {
            exit("Numărul de telefon nu este valid!");
        }

        // Hash parola
        $hashed_password = md5($parola);
    
        // Verificare existenta utilizator după email
        $check_email = "SELECT * FROM user WHERE Email=?";
        $stmt = mysqli_prepare($this->db, $check_email);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $count_rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
    
        if ($count_rows >= 1) {
            exit("Există deja un utilizator cu acest email!");
        } else {
            // Inserare utilizator cu instrucțiuni pregătite
            $insert_user = "INSERT INTO user (Fullname, Email, Parola, Telefon) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->db, $insert_user);
            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashed_password, $telefon);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
    
            return $result;
        }
    }
    
    public function user_change_passwd($parola_veche, $parola_noua)
    {
        $email = $_SESSION["email"];
    
        // luam parola veche din bd
        $query = "SELECT Parola FROM user WHERE Email='$email'";
        $result = mysqli_query($this->db, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $parola_existenta = $row['Parola'];
    
            // verificam daca parola veche introdusa este egala cu parola din bd
            if (md5($parola_veche) === $parola_existenta) {
               
                $parola_noua = md5($parola_noua);
    
                // actualizam parola in bd
                $sql_update = "UPDATE user SET Parola='$parola_noua' WHERE Email='$email'";
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

    public function user_delete($email)
    {
        $sql_delete = "DELETE FROM user WHERE Email='$email'";
        mysqli_query($this->db, $sql_delete);
        session_destroy();
    }

    public function get_fullname($email){
        $sql3="SELECT Fullname FROM user WHERE Email = '$email'";
        $result = mysqli_query($this->db,$sql3);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['Fullname'];
        }

    
    public function get_phoneNumber($email){
            $sql4="SELECT Telefon FROM user WHERE Email = '$email'";
            $result = mysqli_query($this->db,$sql4);
            $user_data = mysqli_fetch_array($result);
            echo $user_data['Telefon'];
            }
    


}
?>