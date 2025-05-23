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
        <button onclick="zmienTryb()">Zmień tryb</button>
       <form action="" method="post"><input  type="submit" value="Wyloguj" name="wyloguj"></form>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
        <section id="sekcjaMain">
            <h2>Winnica Marka</h2>
            <p>Wszystko zaczęło się od pasji do dobrego wina i chęci dzielenia się tym, co najlepsze z własnej winnicy. Winnica Marka to połączenie tradycji, rzemiosła i serca wkładanego w każdą butelkę.
                Nasze wina pochodzą z wyselekcjonowanych szczepów, dojrzewających w naturalnych warunkach i zbieranych ręcznie w odpowiednim momencie. Dzięki temu każda butelka kryje w sobie niepowtarzalny charakter i smak.
                Nie jesteśmy wielką hurtownią – jesteśmy pasjonatami, którzy wierzą, że dobre wino opowiada historię. Wierzymy w jakość, autentyczność i relację z klientem.
            </p>
            <h3>„Wino to nie tylko napój – to opowieść o ziemi, czasie i człowieku.” — Marek, założyciel winnicy</h3>
        </section>
    </main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>    
</body>
<?php
session_start();


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