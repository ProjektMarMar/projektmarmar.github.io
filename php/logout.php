<?php
session_name('marmar');
session_start();

$_SESSION['logged_in'] = false;
 
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
                <a href="../index.php" class="link">Zurück zur Startseite</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    Erfolgreich abgemeldet!<br>
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