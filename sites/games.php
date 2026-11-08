<?php
require_once __DIR__ . '/../vendor/autoload.php';
$env = parse_ini_file ('../env/data.env');

session_name('marmar');
session_start();

$uri = $env['MONGODB_URI'];
$client = new MongoDB\Client($uri);

$collection_franchise = $client->security->franchise;
$collection_game = $client->security->game;
$collection_kategorie = $client->security->kategorie;
$collection_guide = $client->security->guide;
$collection_review = $client->security->review;

$gesamtresult_franchise = $collection_franchise->find();
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
                <div style="display:<?php echo (!isset ($_SESSION['logged_in']) || $_SESSION['logged_in'] === false ) ? 'block' : 'none'; ?>" >
                    <a href="login.html" id="anmeldebutton">Login &#9874;</a>
                </div>
                <div style="display:<?php echo (isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ) ? 'block' : 'none'; ?>" >
                    <a href="../php/logout.php" id="anmeldebutton">Logout &#8614;</a>
                    <?php if(isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset ($_SESSION['username'])){
                    echo ('<a href="user.php?name=' . $_SESSION['username'] .'" class="logininfo">');
                    echo('<img src="../src/usericons/');
                    if($_SESSION['icon'] === ''){
                         echo('icon_default.png');
                    }else{
                        echo($_SESSION['icon'] . '.png');
                    }
                    echo('"  style="width: 20px; height: 20px; margin-right: 5px; margin-top: 5px; border-radius: 10px;">'); 
                    echo ($_SESSION['username'] . "</a>");
                    } ?>
                </div>
                <img src="../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px; position: absolute;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="../index.php" class="link">Startseite</a>
                <a href="marmar.php" class="link">Der MarMar</a>
                <a href="" class="chosen">Games</a>
            </div>
            <div class="block" id="inhaltgames">
                <div class="absatzcenter">
                    <br>
                    <div class="headline">
                        Spieleliste
                    </div>
                    <br>
                    <br>
                    Hier findest du eine Liste aller bisher geplanten Spiele.<br>
                    Eine Google Sheet mit allen 100% Listen findest du hier: ++Platzhalter++<br>
                    <br>
                    <?php 
                    foreach($gesamtresult_franchise as $grf){
                        echo('<div class="gamesUnterkategorie"><div class="headline2" id="' . $grf['fid'] . '">'. $grf['name'] . '<br></div>');
                        $fid = ['fid' => $grf['fid']];
                        $result_kategorie = $collection_kategorie->find($fid);
                        foreach($result_kategorie as $rk){
                            echo('<table class="games" id="' . $rk['kid'] . '">' . $rk['name'] . '<th>Game</th><th>Bild</th><th>100% Liste vorhanden?</th><th>Guide vorhanden</th><th>Review vorhanden</th>');
                            $kid = ['kid' => $rk['kid']];
                            $result_games = $collection_game->find($kid);
                            foreach($result_games as $rg){
                                echo('<tr>');
                                echo('<td class="gamesName"><a href="games/main.php?game='. $rg['gameid'] .'" class="tabellenlink">'. $rg['name'] .'</td>');
                                echo('<td class="gamesIcon"><a href="games/main.php?game='. $rg['gameid'] .'"><img src="../src/listIcons/'. $rg['gameid'] .'.png" alt="'. $rg['name'] .'Titlesreen" style="width: auto; height: 25px;"></a></td>');
                                echo('<td class="checkmark"><img src="../src/');
                                if($rg['liste'] !== ""){
                                    echo('checkTrue.png" alt="True Checkmark" style="width: auto; height: 20px;"></td>');
                                }else{
                                    echo('checkFalse.png" alt="false Checkmark" style="width: auto; height: 20px;"></td>');
                                }
                                echo('<td class="checkmark"><img src="../src/');
                                $filter_game = ['gameid' => $rg['gameid']];
                                $result_guide = $collection_guide->findOne($filter_game);
                                if(isset($result_guide)){
                                    echo('checkTrue.png" alt="True Checkmark" style="width: auto; height: 20px;"></td>');
                                }else{
                                    echo('checkFalse.png" alt="false Checkmark" style="width: auto; height: 20px;"></td>');
                                }
                                echo('<td class="checkmark"><img src="../src/');
                                $result_review = $collection_review->findOne($filter_game);
                                if(isset($result_review)){
                                    echo('checkTrue.png" alt="True Checkmark" style="width: auto; height: 20px;"></td>');
                                }else{
                                    echo('checkFalse.png" alt="false Checkmark" style="width: auto; height: 20px;"></td>');
                                }
                                echo('</tr>');
                            }
                            echo('</table>');
                        }
                        echo('</div>');
                    }
                    ?>
                </div>
            </div>
            <div class="block" id="navright">
                <?php 
                $gesamtresult_franchise = $collection_franchise->find();
                foreach($gesamtresult_franchise as $grf){
                    echo('<a href="#'. $grf['fid'] . '" class="link2">' . $grf['name'] .'</a>');
                    $fid = ['fid' => $grf['fid']];
                    $result_kategorie = $collection_kategorie->find($fid);
                    foreach($result_kategorie as $rk){
                        echo('<a href="#'. $rk['kid'] . '" class="link3">' . $rk['name'] .'</a>');
                    }
                }
                ?>
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