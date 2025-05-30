<?php
session_start();

if (!isset($_SESSION['nazwa'])) {
    header("Location: logowanie.php");
    exit;
}

$pol = mysqli_connect("localhost", "root", "", "winnica");

if (!$pol) {
    die("Błąd połączenia z bazą danych");
}

if (!isset($_GET['id'])) {
    echo "Brak ID produktu.";
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT nazwa, cena, zdjecie, opis FROM wina WHERE id = $id;";
$wynik = mysqli_query($pol, $sql);

if (!$wynik || mysqli_num_rows($wynik) == 0) {
    echo "Produkt nie istnieje.";
    exit;
}

$produkt = mysqli_fetch_assoc($wynik);

if (isset($_POST['doKoszyka']) && isset($_POST['ilosc'])) {
    $ilosc = (int)$_POST['ilosc'];
    $cenaProd = (float)$produkt['cena'];
    $nazwaProd = $produkt['nazwa'];

    if ($ilosc > 0) {
        if (!isset($_SESSION['koszyk'])) {
            $_SESSION['koszyk'] = [];
        }

        if (isset($_SESSION['koszyk'][$nazwaProd])) {
            $_SESSION['koszyk'][$nazwaProd] += $ilosc;
        } else {
            $_SESSION['koszyk'][$nazwaProd] = $ilosc;
        }

        $cena = isset($_SESSION['cena']) ? $_SESSION['cena'] : 0;
        $cena += $cenaProd * $ilosc;
        $_SESSION['cena'] = $cena;

        echo "<p style='color:green;'>Dodano do koszyka!</p>";
    } else {
        echo "<p style='color:red;'>Podaj poprawną ilość!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $produkt['nazwa']; ?></title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="main.php"><img src="zdj/LogoSklepu.png" alt=""></a>
    <a href="sklep.php">Sklep</a>
    <a href="koszyk.php">Koszyk</a>
    <a href="chat.php">Chat</a>
    <button onclick="zmienTryb()">Zmień tryb</button>
    <form action="sklep.php" method="post">
        <input type="submit" name="wyloguj" value="Wyloguj">
    </form>
</nav>

<main>
    <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
    <div id="katalogKoszyk"></div>
    <div class="produkt-szczegoly">
        <img src="zdj/<?php echo $produkt['zdjecie']; ?>" alt="" style="max-width:400px;"><br>
        <h1><?php echo $produkt['nazwa']; ?></h1>
        <p><strong>Cena:</strong> <?php echo $produkt['cena']; ?> zł</p>
        <p><?php echo $produkt['opis']; ?></p>

        <form method="post">
            <label for="ilosc">Ilość:</label>
            <input type="number" name="ilosc" min="1" required>
            <input type="submit" name="doKoszyka" value="Dodaj do koszyka">
        </form>
    </div>
</main>

<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
        Tel: +48 123 456 789 E-mail: <a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>
<script src="zmianaTrybu.js"></script>
</body>
</html>
