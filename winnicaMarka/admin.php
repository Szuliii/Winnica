<?php
session_start();
    if(isset($_SESSION['nazwa'])) {
        header("Location: panel.php");
        exit;
    }
    

    $pol=mysqli_connect("localhost","root","","winnica");
    
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nazwa=$_POST['nazwa'];
         $haslo=hash('sha1', $_POST['haslo']);
       
        $sql="SELECT * FROM administratorzy WHERE nazwa='$nazwa' AND haslo='$haslo'";
        $wynik=mysqli_query($pol,$sql);
        if($wynik->num_rows==1){

            if($_SESSION['nazwa']=$nazwa)
            header("Location: panel.php");
            else echo"Błędny login lub hasło";
        }
        
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
        <a href="logowanie.php">Logowanie</a>
        <a href="admin.php">ADMIN</a>
        
    </nav>
    <main>
        <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
       <section id="sekcjaMain" style="width:30%; ">
            <form action="" method="post">
                <label for="nazwa">Nazwa: </label>
                <input type="text" name="nazwa" require><br>
                <label for="haslo">Hasło: </label>
                <input type="text" name="haslo" require><br>
                <input type="submit" value="Zaloguj"name="logowanie">
               
            </form>
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
</html>