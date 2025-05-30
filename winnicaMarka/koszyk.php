<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnica Marka</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    
    <nav><a href="main.php"><img src="zdj/LogoSklepu.png" alt=""></a>
         <a href="sklep.php">Sklep</a>
        <a href="koszyk.php">Koszyk</a>
        <a href="chat.php">Chat</a>
        <button onclick="zmienTryb()">Zmień tryb</button>
         <form action="" method="post"><input type="submit" value="Wyloguj" name="wyloguj"></form>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
            <section id="katalogKoszyk">
                
        </section>
                <div id="koszyk">
                <?php 
                $cena = isset($_SESSION['cena']) ? $_SESSION['cena'] : 0;

                echo "<h2>Twój koszyk</h2><br>";

                if (!empty($_SESSION['koszyk'])) {
                    foreach ($_SESSION['koszyk'] as $produkt => $ilosc) {
                        echo "<p>$produkt - ilość: $ilosc</p>";
                    }
                    echo "<h3>Łączna cena: $cena zł</h3>";
                } else {
                    echo "<p>Koszyk jest pusty.</p>";
                }
                
                $pol = mysqli_connect("localhost", "root", "", "winnica");
                $nazwa = $_SESSION['nazwa'];
                $sql1 = "SELECT id,adres FROM uzytkownicy WHERE nazwa='$nazwa';";
                $wynik = mysqli_query($pol, $sql1);
                while($wiersz=mysqli_fetch_row($wynik)){
                    $id=$wiersz[0];
                    $adres=$wiersz[1];
                }
                
                $dzis = date("d-m-y");
                if(isset($_POST['zamow'])){
                $sql2="INSERT INTO `zamowienia`( `id_klienta`, `data_zamowienia`, `suma_zamowienia`,  `adres_dostawy`) VALUES ('$id','$dzis','$cena','$adres')";
                $insert=mysqli_query($pol,$sql2);
                if ($insert) {
                $id_zamowienia = mysqli_insert_id($pol); 

                if(!empty($_SESSION['koszyk'])){
                foreach ($_SESSION['koszyk'] as $nazwa_produktu => $ilosc) {
                    $sqlWino = "SELECT id, cena FROM wina WHERE nazwa = '$nazwa_produktu'";
                    $wynikWino = mysqli_query($pol, $sqlWino);
                    
                    if ($wierszWino = mysqli_fetch_assoc($wynikWino)) {
                        $id_wina = $wierszWino['id'];
                        $cena_wina = $wierszWino['cena'];

                        $sqlPozycja = "INSERT INTO pozycje_zamowienia (id_zamowienia, id_wina, ilosc, cena)
                                       VALUES ('$id_zamowienia', '$id_wina', '$ilosc', '$cena_wina')";
                        mysqli_query($pol, $sqlPozycja);
                    }
                }
                }
            }
                    unset($_SESSION['koszyk']);
                    $cena=null;
                    $nazwa=null;
                    header("Refresh:0");
                    exit;
                }
                ?>
                <form action="" method="post">
                    <input type="submit" value="Zamów" name="zamow">
                </form>
                </div>
                

    </main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>    
</body>
<?php



if(!isset($_SESSION['nazwa'])) {
    header("Location: logowanie.php");
    exit;
}


if(isset($_POST['wyloguj'])) {
    session_destroy(); 
    header("Location: logowanie.php");
    exit;
}
?>
<script src="zmianaTrybu.js"></script>
</html>