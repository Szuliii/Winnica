<?php
session_start();
   if(isset($_POST['wyloguj'])) {
    session_destroy(); 
    header("Location: logowanie.php");
    exit;
}
    

    $pol=mysqli_connect("localhost","root","","winnica");
    
     
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
        <button onclick="zmienTryb()">Zmień tryb</button>
        <form action="" method="post">
        <input type="submit" value="Wyloguj" name="wyloguj">
        </form>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
       <section id="katalogKoszyk">
        <div id="dodawanie">
        <form action="" method="post" >
            <h3>Dodawanie</h3>
                <p>
                    Typy wina: 1-Czerwone,2-Białe,3-Musujące,4-Różowe,5-Wzmacniane <br>
                    Kraje: 1-Francja 2-Włochy 3-Niemcy 4-Hiszpania 5-Portugalia 6-Chile 7-Argentyna
                </p>
                <label for="nazwa">Nazwa:</label>
                <input type="text" name="nazwa"><br>
                <label for="typ">Typ(liczba):</label>
                <input type="number" name="typ"><br>
                <label for="pojemnosc">Pojemność: </label>
                <input type="number" name="pojemnosc"><br>
                <label for="kraj">Kraj(liczba)</label>
                <input type="" name="kraj"><br>
                <label for="cena">Cena: </label>
                <input type="number" name="cena" step="0.01"><br>
                <label for="zdj">Nazwa pliku ze zdjeciem</label>
                <input type="text" name="zdj"><br>
                <label for="opis">Opis:</label>
                <input type="text" name="opis" style="height:30%"><br>
                <input type="submit" value="Dodaj" name="dodaj">
                
        </form>
        </div>
        <div id="usuwanie">
            <h3>Usuwanie</h3>
            <form action="" method="post">
                <label for="nazwa">Nazwa:</label><br>
                <input type="text" name="nazwa"><br>
                <input type="submit" value="Usun" name="usun">
            </form>
        </div>
        <div id="lista">
            <table>
                <thead>Klienci</thead>
                <tbody>
                    <tr>
                        <td>Nazwa:</td>
                        <td>Imię</td>
                        <td>Nazwisko:</td>
                        <td>Adres:</td>
                    </tr>
                <?php
                $sqlLista="SELECT nazwa,imie, nazwisko,adres FROM uzytkownicy";
                $wynikLista=mysqli_query($pol,$sqlLista);
                while($wiersz=mysqli_fetch_row($wynikLista)){
                    echo"<tr>
                        <td>$wiersz[0]</td>
                        <td>$wiersz[1]</td>
                        <td>$wiersz[2]</td>
                        <td>$wiersz[3]</td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
       </section>
        </section>
    </main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>    
</body>
            
            
<?php
if(isset($_POST['dodaj'])){
    $nazwa=$_POST['nazwa'];
    $typ=$_POST['typ'];
    $pojemnosc=$_POST['pojemnosc'];
    $kraj=$_POST['kraj'];
    $cena=$_POST['cena'];
    $zdj=$_POST['zdj'];
    $sqlDodaj="INSERT INTO `wina`( `nazwa`, `typ_wina`, `pojemnosc`, `kraj_pochodzenia`, `cena`, `zdjecie`) VALUES ('$nazwa','$typ','$pojemnosc','$kraj','$cena','$zdj')";
    $wynik=mysqli_query($pol,$sqlDodaj);
}
if(isset($_POST['usun'])){
    $nazwa=$_POST['nazwa'];
    $sqlUsun="DELETE FROM wina WHERE wina.nazwa ='$nazwa'";
    $wynik=mysqli_query($pol,$sqlUsun);
}
mysqli_close($pol);
?>
<script src="zmianaTrybu.js"></script>
</html>