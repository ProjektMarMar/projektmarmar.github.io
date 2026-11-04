<?php 
require_once __DIR__ . '/../vendor/autoload.php';
$env = parse_ini_file ('../env/data.env');
session_name('marmar');
session_start();

$uri = $env['MONGODB_URI'];
$client = new MongoDB\Client($uri);

$collection = $client->security->loginitem;

$icon = $_POST['icon'] ?? '';
$game = $_POST['game'] ?? '';
$franchise = $_POST['franchise'] ?? '';
$beschreibung = $_POST['beschreibung'] ?? '';

$name = $_SESSION['username'];

if($icon === '-'){
    $icon = '';
}

if($game === '-'){
    $game = '';
}

if($franchise === '-'){
    $franchise = '';
}

$resultupdate = $collection->updateOne(
    ['name' => $name],
    ['$set' => ['icon' => $icon, 'favfranchise' => $franchise, 'favgame' => $game, 'desc' => $beschreibung]],
);

$_SESSION['favgame'] = $game;
$_SESSION['favfranchise'] = $franchise;
$_SESSION['icon'] = $icon;
$_SESSION['desc'] = $beschreibung;
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
                <img src="../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px; position: absolute;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="../index.php" class="link">Zurück zur Startseite</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    Änderungen erfolgreich gespeichert<br>
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