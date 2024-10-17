<?php
include_once("class.user.php");
$user = new User();

include("../admin/class.eveniment.php");
include_once("class.cos_cumparaturi.php"); 

$cos = new CosCumparaturi();

// Afișează coșul de cumpărături
$events_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$events = array();
$subtotal = 0.00;

// Dacă există evenimente în coș
if ($events_in_cart) {
    // Există evenimente în coș, așa că trebuie să selectăm acele evenimente din baza de date
    // Evenimente în coș sunt de tip array deci SQL statement IN (?, ?, ..., etc)
    $array_to_question_marks = implode(',', array_fill(0, count($events_in_cart), '?'));
    $stmt = $cos->db->prepare('SELECT * FROM evenimente WHERE IdEveniment IN (' . $array_to_question_marks . ')');

    // Construiește tipul de parametri pentru bind_param 
    $param_types = str_repeat('i', count($events_in_cart));

    // Construiește array-ul de parametri pentru bind_param
    $param_values = array_merge(array($param_types), array_keys($events_in_cart));

    // Adaugă valorile pentru bind_param
    foreach ($events_in_cart as $value) {
        $param_values[] = $value;
    }

    // Folosește call_user_func_array pentru a transmite array-ul de valori ca parametri
    call_user_func_array(array($stmt, 'bind_param'), $param_values);

    $stmt->execute();

    // Preluați evenimentele din baza de date și returnați rezultatul ca matrice asociativă
    $result = $stmt->get_result();
    $events = $result->fetch_all(MYSQLI_ASSOC);

    // Calculează un subtotal
    foreach ($events as $event) {
        $subtotal += (float)$event['Pret_pe_bilet'] * (int)$events_in_cart[$event['IdEveniment']];
    }
}

if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cos = new CosCumparaturi();
    
    $cos->emptyCart($userId); 
    
    header('Location: index.php?page=placeorder');
    exit;
}

include("header4.html");
?>

<html>
<head>
   
</head>
<body>

<div class="cart content-wrapper">
    <h1>Cos cumparaturi</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <th>Eveniment</th>
                    <th>Pret pe bilet</th>
                    <th>Cantitate</th>
                    <th>Total</th>
                    <th>Eliminare</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Cosul de cumparaturi este gol</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td class="event-info">
                                <a href="cos.php?page=event&id=<?=htmlspecialchars($event['IdEveniment'])?>">
                                    <img src="/proiect1/poze/<?=htmlspecialchars($event['Afis'])?>" width="100" height="150" alt="<?=htmlspecialchars($event['Titlu'])?>">
                                    <p><?=htmlspecialchars($event['Titlu'])?></p>
                                </a>
                            </td>
                            <td class="price"><?=htmlspecialchars($event['Pret_pe_bilet'])?></td>
                            <td class="quantity">
                                <input type="number" name="quantity-<?=htmlspecialchars($event['IdEveniment'])?>"
                                    value="<?=htmlspecialchars($events_in_cart[$event['IdEveniment']])?>" min="1"
                                    max="<?=htmlspecialchars($event['NrBilete'])?>" placeholder="Cantitate" required>
                            </td>
                            <td class="total-price"><?=htmlspecialchars($event['Pret_pe_bilet'] * $events_in_cart[$event['IdEveniment']])?></td>
                            <td class="remove">
                                <a href="cos.php?page=event&id=<?=htmlspecialchars($event['IdEveniment'])?>" class="remove">Stergere</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>

</body>
</html>
