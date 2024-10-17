<?php
include("connection.php");

class Eveniment {
    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if ($this->db->connect_error) {
            die("Eroare: nu se poate conecta la baza de date!" . $this->db->connect_error);
        }
    }

    public function inserareDate($titlu, $descriere, $locatie, $data_si_ora, $nr_bilete, $pret_pe_bilet, $afis, $speaker, $parteneri, $sponsori, $agenda, $contact) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titlu = isset($_POST["titlu"]) ? $_POST["titlu"] : null;
            $descriere = isset($_POST["descriere"]) ? $_POST["descriere"] : null;
            $locatie = isset($_POST["locatie"]) ? $_POST["locatie"] : null;
            $data_si_ora = isset($_POST["data_si_ora"]) ? $_POST["data_si_ora"] : null;
            $nr_bilete = isset($_POST["nr_bilete"]) ? $_POST["nr_bilete"] : null;
            $pret_pe_bilet = isset($_POST["pret_pe_bilet"]) ? $_POST["pret_pe_bilet"] : null;
            $afis = isset($_POST["afis"]) ? $_POST["afis"] : null;
            $speaker = isset($_POST["speaker"]) ? $_POST["speaker"] : null;
            $parteneri = isset($_POST["parteneri"]) ? $_POST["parteneri"] : null;
            $sponsori = isset($_POST["sponsori"]) ? $_POST["sponsori"] : null;
            $agenda = isset($_POST["agenda"]) ? $_POST["agenda"] : null;
            $contact = isset($_POST["contact"]) ? $_POST["contact"] : null;

            if ($titlu !== null && $descriere !== null && $locatie !== null && $data_si_ora !== null &&
                $nr_bilete !== null && $pret_pe_bilet !== null && $afis !== null && $speaker !== null &&
                $parteneri !== null && $sponsori !== null && $agenda !== null && $contact !== null) {

                $sql = "INSERT INTO evenimente (Titlu, Descriere, Locatie, Data_si_ora, Nr_bilete, Pret_pe_bilet, Afis, Speaker, Parteneri, Sponsori, Agenda, Contact)
                        VALUES ('$titlu', '$descriere', '$locatie', '$data_si_ora', $nr_bilete, $pret_pe_bilet, '$afis', '$speaker', '$parteneri', '$sponsori', '$agenda', '$contact')";

                if ($this->db->query($sql) === TRUE) {
                    echo "Datele au fost inserate cu succes!";
                } else {
                    echo "Eroare la inserarea datelor: " . $this->db->error;
                }
            } else {
                echo "Nu s-au primit toate datele din formular.";
            }
        }
    }

    public function vizualizareDate() {
        $sql = "SELECT * FROM evenimente";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='styled-table'>
                <thead>
                    <tr>
                        <th>ID Eveniment</th>
                        <th>Titlu</th>
                        <th>Descriere</th>
                        <th>Locatie</th>
                        <th>Data si Ora</th>
                        <th>Nr Bilete</th>
                        <th>Pret pe Bilet</th>
                        <th>Afis</th>
                        <th>Speaker</th>
                        <th>Parteneri</th>
                        <th>Sponsori</th>
                        <th>Agenda</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>";


            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["IdEveniment"] . "</td>";
                echo "<td>" . $row["Titlu"] . "</td>";
                echo "<td>" . $row["Descriere"] . "</td>";
                echo "<td>" . $row["Locatie"] . "</td>";
                echo "<td>" . $row["Data_si_ora"] . "</td>";
                echo "<td>" . $row["Nr_bilete"] . "</td>";
                echo "<td>" . $row["Pret_pe_bilet"] . "</td>";
                echo "<td>" . $row["Afis"] . "</td>";
                echo "<td>" . $row["Speaker"] . "</td>";
                echo "<td>" . $row["Parteneri"] . "</td>";
                echo "<td>" . $row["Sponsori"] . "</td>";
                echo "<td>" . $row["Agenda"] . "</td>";
                echo "<td>" . $row["Contact"] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Nu există înregistrări în tabela evenimente.";
        }
    }

    function modificareDate($idEveniment, $titlu, $descriere, $locatie, $data_si_ora, $nr_bilete, $pret_pe_bilet, $afis, $speaker, $parteneri, $sponsori, $agenda, $contact) {
        $sql = "UPDATE evenimente SET
        Titlu = ?,
        Descriere = ?,
        Locatie = ?,
        Data_si_ora = ?,
        Nr_bilete = ?,
        Pret_pe_bilet = ?,
        Afis = ?,
        Speaker = ?,
        Parteneri = ?,
        Sponsori = ?,
        Agenda = ?,
        Contact = ?
        WHERE IdEveniment = ?";

        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssiiisssssi", $titlu, $descriere, $locatie, $data_si_ora, $nr_bilete, $pret_pe_bilet, $afis, $speaker, $parteneri, $sponsori, $agenda, $contact, $idEveniment);

            if ($stmt->execute()) {
                echo "Datele au fost actualizate cu succes!";
            } else {
                echo "Eroare la actualizarea datelor: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Eroare la pregătirea instrucțiunii de actualizare: " . $this->db->error;
        }
    }


    public function stergereDate($idEveniment)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_event'])) {
            $idEveniment = $_POST['delete_event'];

            $sql = "DELETE FROM evenimente WHERE IdEveniment = ?";
            $stmt = $this->db->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $idEveniment);

                if ($stmt->execute()) {
                    echo "Evenimentul a fost șters cu succes!";
                } else {
                    echo "Eroare la ștergerea evenimentului: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Eroare la pregătirea instrucțiunii de ștergere: " . $this->db->error;
            }
        }
    }

    public function inchideConexiune() {
        $this->db->close();
    }
}
?>
