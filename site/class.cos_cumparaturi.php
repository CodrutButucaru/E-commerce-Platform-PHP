<?php
include("connection.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CosCumparaturi {

    public $db;
    
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {
            echo "Eroare: nu se poate conecta la baza de date!";
            exit;
        }
    }
    
    public function getCartItemByProduct($IdEveniment, $IdUser) {
        $sql = "SELECT c.*, e.Titlu, e.Pret_pe_bilet FROM evenimente e
        INNER JOIN cos_cumparaturi c ON e.IdEveniment = c.IdEveniment
        WHERE c.IdUser = ? AND c.IdEveniment = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $IdUser, $IdEveniment);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

   

    function addToCart($IdEveniment, $NrBilete, $IdUser)
    {
        // Verifica dacă utilizatorul este autentificat
        if (!$IdUser) {
            die("Utilizatorul nu este autentificat. Nu se poate adauga in cos.");
        }
    
        // Verifică dacă evenimentul există în baza de date
        $stmtCheckEvent = $this->db->prepare('SELECT * FROM evenimente WHERE IdEveniment = ?');
        $stmtCheckEvent->bind_param('i', $IdEveniment);
        $stmtCheckEvent->execute();
        $resultCheckEvent = $stmtCheckEvent->get_result();
    
        // Verifică dacă evenimentul există
        if ($resultCheckEvent->num_rows === 0) {
            die("Evenimentul nu există în baza de date. Nu se poate adauga in cos.");
        }
    
        // Pregătirea și executarea interogării SQL
        $stmt = $this->db->prepare('INSERT INTO cos_cump (IdEveniment, NrBilete, IdUser) VALUES (?, ?, ?)');
        
        if ($stmt == false) {
            die('Eroare la pregătirea declarației SQL: ' . $this->db->error);
        }
    
        $stmt->bind_param('iii', $IdEveniment, $NrBilete, $IdUser);
    
        if (!$stmt->execute()) {
            die('Eroare la executarea declarației SQL: ' . $stmt->error);
        }
    
        echo "Eveniment adăugat în coș cu succes!";
    
        // Închide declarația
        $stmt->close();
    }
    


    function updateCartQuantity($NrBilete, $IdCos) {
        // Verifică dacă coșul nu este gol și dacă elementul există în coș
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$IdCos])) {
            // Actualizează cantitatea în coșul de sesiune
            $_SESSION['cart'][$IdCos] = $NrBilete;
    
            // Poți adăuga și cod suplimentar pentru a actualiza baza de date, dacă este necesar
            // ...
    
            echo "Cantitate actualizată cu succes!";
        } else {
            echo "Evenimentul nu există în coș.";
        }
    }
    

function deleteCartItem($IdCos) {
    // Verifică dacă coșul nu este gol și dacă elementul există în coș
    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$IdCos])) {
        // Sterge elementul din coș
        unset($_SESSION['cart'][$IdCos]);

        // Poți adăuga și cod suplimentar pentru a actualiza baza de date, dacă este necesar
        // ...

        echo "Eveniment șters cu succes din coș!";
    } else {
        echo "Evenimentul nu există în coș.";
    }
}



function emptyCart($IdUser) {
    // Interogare SQL pentru golirea coșului pentru un anumit utilizator
    $query = "DELETE FROM cos_cump WHERE IdUser = ?";
    
    // Pregătește declarația
    $stmt = $this->db->prepare($query);

    // Verifică dacă pregătirea a eșuat
    if ($stmt === false) {
        die("Eroare la pregătirea declarației SQL: " . $this->db->error);
    }

    // Leagă parametrii
    $stmt->bind_param('i', $IdUser);

    // Execută declarația
    if (!$stmt->execute()) {
        die("Eroare la executarea declarației SQL: " . $stmt->error);
    }

    echo "Coșul a fost golit cu succes!";

    // Închide declarația
    $stmt->close();
}

}
?>

