<?php
session_name('marmar');
session_start();
?>
<html lang="de">
<head>
<title>ProjektMarMar</title>
<link rel="stylesheet" href="style/style.css">
<meta charset="UTF-8">
</head>
<body>
    <div id="content">
        <div id="kopf">
            <div id="titel">
                <div style="display:<?php echo (!isset ($_SESSION['logged_in']) || $_SESSION['logged_in'] === false ) ? 'block' : 'none'; ?>" >
                    <a href="sites/login.html" id="anmeldebutton">Login &#9874;</a>
                </div>
                <div style="display:<?php echo (isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ) ? 'block' : 'none'; ?>" >
                    <a href="../php/logout.php" id="anmeldebutton">Logout &#8614;</a>
                </div>
                <img src="src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="" class="chosen">Startseite</a>
                <a href="sites/marmar.php" class="link">Der MarMar</a>
                <a href="sites/games.php" class="link">Games</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    <br>
                    <br>
                    <br>
                    Hier findet ihr Alles rund um den "MarMar".<br><br>Falls du wissen willst, um was es genau geht, 
                    schau dir links im Menü den Punkt "Der MarMar" an.<br>Unter "Games" findest du alles, 
                    rund um die Spiele, die Teil des MarMar sind.
                </div>
                <div class="bildcenter">
                    <img src="src/SSBkirby.png" alt="Kirby Splashart" style="width: 500px; height: auto;">
                    <br>
                    Screenshot aus: Super Smash Bros. Urheber: Nintendo
                </div>
            </div>
            <div class="block" id="navright">

            </div>
        </div>
        <div id="footer">
            <div class="textlink">
                <a href="sites/impressum.html">Impressum</a>
            </div>
        </div>
    </div>
</body>
</html>