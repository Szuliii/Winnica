<?php
session_start();
if (!isset($_SESSION['nazwa'])) {
    header("Location: logowanie.php");
    exit;
}
if (isset($_POST['wyloguj'])) {
    session_destroy();
    header("Location: logowanie.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['mode']) && $_GET['mode'] === 'write') {
    if (!empty($_POST['msg'])) {
        $msg = strip_tags($_POST['msg']);
        $user = htmlspecialchars($_SESSION['nazwa']);
        $line = date("H:i:s") . " | " . $user . ": " . $msg . "\n";
        file_put_contents("chat.txt", $line, FILE_APPEND);
    }
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['mode']) && $_GET['mode'] === 'read') {
    if (file_exists("chat.txt")) {
        echo nl2br(file_get_contents("chat.txt"));
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Czat</title>
    <link rel="stylesheet" href="styl.css">
    
    </style>
</head>
<body>
<nav>
    <a href="main.php"><img src="zdj/LogoSklepu.png" alt=""></a>
    <a href="sklep.php">Sklep</a>
    <a href="koszyk.php">Koszyk</a>
    <button onclick="zmienTryb()">Zmień tryb</button>
    <form action="chat.php" method="post">
        <input type="submit" name="wyloguj" value="Wyloguj">
    </form>
</nav>
<main>
    <img src="zdj/winnicav2.jpg" alt="Winnica" style="max-width: 100%; height: auto;">
    <div class="chatMessages" id="chat"></div>
    <div class="chatBottom">
        <form onsubmit="sendMessage(); return false;">
            <input type="text" id="msg" placeholder="Wpisz wiadomość" required />
            <input type="submit" value="Wyślij" />
        </form>
    </div>
</main>
<footer>
    <p>Adres: 87-300 Brodnica ul. Zamkowa 13 <br>
    Tel: +48 123 456 789 E-mail: <a href="mailto:kontakt@winomarka.pl">kontakt@winomarka.pl</a></p>
</footer>
<script src="zmianaTrybu.js"></script>
<script>
    function sendMessage() {
        const xhr = new XMLHttpRequest();
        const msg = document.getElementById("msg").value;
        xhr.open("POST", "chat.php?mode=write", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("msg=" + encodeURIComponent(msg));
        document.getElementById("msg").value = "";
    }
    function loadMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "chat.php?mode=read", true);
        xhr.onload = function () {
            document.getElementById("chat").innerHTML = this.responseText;
        };
        xhr.send();
    }
    setInterval(loadMessages, 1000);
    window.onload = loadMessages;
</script>
</body>
</html>
