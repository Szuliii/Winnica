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
        <a href="logowanie.php">Logowanie</a>
         <form action="" method="post"><input type="submit" value="Wyloguj" name="wyloguj"></form>
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
       <section id="katalogKoszyk">
            
            <?php
                    $pol=mysqli_connect("localhost","root","","winnica");
                    $sql = "SELECT wina.nazwa, typy_wina.nazwa as \"typ\", kraje.nazwa as \"kraj\", pojemnosc,cena,zdjecie FROM wina INNER JOIN kraje ON wina.kraj_pochodzenia= kraje.id INNER JOIN typy_wina ON wina.typ_wina=typy_wina.id;";
                    $wynik=mysqli_query($pol,$sql);
                    while($wiersz=mysqli_fetch_row($wynik)){
                        echo" 
                        
                            <div id='produkt'>
                            
                                <img src='$wiersz[5]' alt='' >
                                
                                </div>
                            
                        ";

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
</html>