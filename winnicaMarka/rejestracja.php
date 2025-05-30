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
        <a href="logowanie.php">Logowanie</a>
        <button onclick="zmienTryb()">Zmień tryb</button>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
       <section id="sekcjaMain" style="width:30%; ">
            <form action="" method="post">
                <label for="imie">Imię: </label>
                <input type="text" name="imie" require><br>

                <label for="nazwisko">Nazwisko: </label>
                <input type="text" name="nazwisko" require><br>

                <label for="nazwa">Nazwa: </label>
                <input type="text" name="nazwa" require><br>

                <label for="haslo">Hasło: </label>
                <input type="text" name="haslo" require><br>

                <label for="adres">Adres: </label>
                <input type="text" name="adres" require><br>

                <label for="data">Data urodzenia: </label>
                <input type="date" name="data" require><br>

                
                <input type="submit" value="Rejestracja" name="rejestracja">
            </form>
            <?php
    if(isset($_POST['rejestracja'])){
        $nazwa=$_POST['nazwa'];
        $imie=$_POST['imie'];
        $nazwisko=$_POST['nazwisko'];
        $haslo=hash('sha1', $_POST['haslo']);
        $adres=$_POST['adres'];
        $data=$_POST['data'];
        $data_ur=date_create($data);
        $pol=mysqli_connect("localhost","root","","winnica");
        $dzis=date_create("now");
        $lata=date_diff($data_ur,$dzis);
        $r=$lata->format("%y");
        
        
        if($r<18)
            echo"<p style='font-size:200%'>Rejestracja przerwana, Musisz mieć 18lat!!!";
        else{
            $sql="INSERT INTO `uzytkownicy`( `nazwa`, `imie`, `nazwisko`, `haslo`, `adres`) VALUES ('$nazwa','$imie','$nazwisko','$haslo','$adres')";
            $wynik=mysqli_query($pol,$sql);
        }

    }
            ?>
        </section>
    </main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>    
</body>
            


<?php
mysqli_close($pol);
?>
<script src="zmianaTrybu.js"></script>
</html>