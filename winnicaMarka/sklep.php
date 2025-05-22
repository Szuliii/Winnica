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
        
         <form action="" method="post"><input type="submit" value="Wyloguj" name="wyloguj"></form>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
       <section id="katalogKoszyk">
            
       </section>
       <div id="niewidzialny">
        <?php
                    $pol=mysqli_connect("localhost","root","","winnica");
                    $sql = "SELECT nazwa, cena,zdjecie,opis FROM wina;";
                    $wynik=mysqli_query($pol,$sql);
                    if(isset($_POST['doKoszyka']) && isset($_POST['produkt']) && isset($_POST['ilosc'])) {
                        $produkt = $_POST['produkt'];
                        $ilosc = (int)$_POST['ilosc'];
                        $cenaProd = (float)$_POST['cena'];
                        
                        if ($ilosc > 0) {
                           
                            if (!isset($_SESSION['koszyk'])) {
                                $_SESSION['koszyk'] = [];
                            }
                        
                            
                            if (isset($_SESSION['koszyk'][$produkt])) {
                                $_SESSION['koszyk'][$produkt] += $ilosc;
                            } else {
                                $_SESSION['koszyk'][$produkt] = $ilosc;
                            }
                                $cena = isset($_SESSION['cena']) ? $_SESSION['cena'] : 0;
                                $cena += $cenaProd * $ilosc;
                                $_SESSION['cena'] = $cena;
                            
                            header("Location: koszyk.php");
                            exit;
                        }
                        
                    }
                    while($wiersz=mysqli_fetch_row($wynik)){
                        echo" 
                        
                            <div class='katalog'>
                            
                                <img src='zdj/$wiersz[2]'' alt='' ><br>
                                <a href='produkt.php'>$wiersz[0]</a><br><br>
                                <p>$wiersz[1]zł</p>
                                <p>$wiersz[3]</p>
                                <form action='sklep.php' method='post'>
                                  <input type='hidden' name='produkt' value='$wiersz[0]'>
                                    <input type='hidden' name='cena' value='$wiersz[1]'>
                                    <label for='ilosc'>Ilość:</label>    
                                    <input type='number' name='ilosc'>
                                    <input type='submit' name='doKoszyka'>
                                </form>
                                </div>
                            ";

                    }
                    
                ?>
       </div>
    </main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail:<a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a>
    </p>
</footer>    
</body>


</html>