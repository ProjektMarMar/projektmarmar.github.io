<?php
session_name('marmar');
session_start();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if($username == 'Solid' && $password == '12'){
    $_SESSION['logged_in'] = true;
    header("Location: ../sites/games.php");
    exit;
} 
?>

<html lang="de">
<head>
<title>ProjektMarMar</title>
<link rel="stylesheet" href="../style/style.css">
<meta charset="UTF-8">
</head>
<body>
    <div id="content">
        <div id="kopf">
            <div id="titel">
                <img src="../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="../sites/login.php" class="link">Zurück zur Anmeldung</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    Login fehlgeschlagen!<br>
                    Benutzername oder Passwort falsch
                </div>
            </div>
            <div class="block" id="navright">

            </div>
        </div>
        <div id="footer">
            <div class="textlink">
            <a href="impressum.html"> Impressum</a>
            </div>
        </div>
    </div>
</body>
</html>