<?php
session_start();
if (!isset($_SESSION['nazwa'])) {
    header("Location: logowanie.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Brak ID produktu!";
    exit;
}

$pol = mysqli_connect("localhost", "root", "", "winnica");
$id = mysqli_real_escape_string($pol, $_GET['id']); // zabezpieczenie

$sql = "SELECT id, nazwa, cena, zdjecie, opis FROM wina WHERE id = $id LIMIT 1;";
$wynik = mysqli_query($pol, $sql);

if (mysqli_num_rows($wynik) === 0) {
    echo "Nie znaleziono produktu.";
    exit;
}

$produkt = mysqli_fetch_assoc($wynik);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($produkt['nazwa']); ?> - Winnica Marka</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <nav>
        <a href="main.php"><img src="zdj/LogoSklepu.png" alt=""></a>
        <a href="sklep.php">Sklep</a>
        <a href="koszyk.php">Koszyk</a>
        <button onclick="zmienTryb()">Zmień tryb</button>
        <form action="" method="post"><input type="submit" value="Wyloguj" name="wyloguj"></form>
    </nav>

    <main>
        <div class="produkt-szczegoly">
            <img src="zdj/winnicav2.jpg" alt="">
            <h1><?php echo htmlspecialchars($produkt['nazwa']); ?></h1>
            <p><?php echo htmlspecialchars($produkt['opis']); ?></p>
            <p><strong>Cena:</strong> <?php echo $produkt['cena']; ?> zł</p>
            <form action="sklep.php" method="post">
                <input type="hidden" name="produkt" value="<?php echo $produkt['nazwa']; ?>">
                <input type="hidden" name="cena" value="<?php echo $produkt['cena']; ?>">
                <label for="ilosc">Ilość:</label>
                <input type="number" name="ilosc" min="1">
                <input type="submit" name="doKoszyka" value="Dodaj do koszyka">
            </form>
        </div>
    </main>

    <footer>
        <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
        Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
        </p>
    </footer>
    <script src="zmianaTrybu.js"></script>
</body>
</html>
