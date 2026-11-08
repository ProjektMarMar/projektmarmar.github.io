<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$env = parse_ini_file ('../../env/data.env');

session_name('marmar');
session_start();

$uri = $env['MONGODB_URI'];
$client = new MongoDB\Client($uri);

$clicked_game = htmlspecialchars($_GET["game"]);

$collection_game = $client->security->game;
$collection_guide = $client->security->guide;
$collection_review = $client->security->review;
$collection_speedrun_kategorie = $client->security->speedrunkategorie;
$collection_speedrun = $client->security->speedrun;
$collection_user = $client->security->loginitem;

$filter_game = ['gameid' => $clicked_game];
$game = $collection_game->findOne($filter_game);
$guides = $collection_guide->find($filter_game);
$reviews = $collection_review->find($filter_game);
$speedrun_kategorien = $collection_speedrun_kategorie->find($filter_game);

if(!isset($game)){
    header('Location: ../games.php');
}
?>
<html lang="de">
<head>
<title>ProjektMarMar</title>
<link rel="stylesheet" href="../../style/style.css">
<meta charset="UTF-8">
</head>
<body>
    <div id="content">
        <div id="kopf">
            <div id="titel">
                <div style="display:<?php echo (!isset ($_SESSION['logged_in']) || $_SESSION['logged_in'] === false ) ? 'block' : 'none'; ?>" >
                    <a href="../login.html" id="anmeldebutton">Login &#9874;</a>
                </div>
                <div style="display:<?php echo (isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ) ? 'block' : 'none'; ?>" >
                    <a href="../../php/logout.php" id="anmeldebutton">Logout &#8614;</a>
                    <?php if(isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset ($_SESSION['username'])){
                    echo ('<a href="../user.php?name=' . $_SESSION['username'] .'" class="logininfo">');
                    echo('<img src="../../src/usericons/');
                    if($_SESSION['icon'] === ''){
                         echo('icon_default.png');
                    }else{
                        echo($_SESSION['icon'] . '.png');
                    }
                    echo('"  style="width: 20px; height: 20px; margin-right: 5px; margin-top: 5px; border-radius: 10px;">'); 
                    echo ($_SESSION['username'] . "</a>");
                    } ?>
                </div>
                <img src="../../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px; position: absolute;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="../games.php" class="link">Zurück zur Übersicht</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzgames">
                    <div class="infobox">
                        <?php

                        echo('<img src="../../src/listIcons/'. $game['gameid'] . '.png" alt="'. $game['name'] . ' Titlescreen" style="width: 100%; height: auto;">');
                        echo('<div class="bildinfos">Screenshot aus: ' . $game['name'] .' Urheber: '. $game['publisher'] . '</div>');
                        echo('<table class="infotext">');
                        echo('<tr><td class="infotextname">Name</td><td class="infotextattribut">'. $game['name'] .'</tr>');
                        echo('<tr><td class="infotextname">Konsole</td><td class="infotextattribut">');
                        $i = 0;
                        foreach($game['konsole'] as $konsole){
                            if($i > 0){
                                echo(', ');
                            }
                            echo($konsole);
                            $i++;
                        }
                        echo('</td></tr>');
                        echo('<tr><td class="infotextname">Genre</td><td class="infotextattribut">'. $game['genre'] .'</tr>');
                        echo('<tr><td class="infotextname">Entwickler</td><td class="infotextattribut">'. $game['developer'] .'</tr>');
                        echo('<tr><td class="infotextname">Publisher</td><td class="infotextattribut">'. $game['publisher'] .'</tr>');
                        echo('<tr><td class="infotextname">Veröffentlichung</td><td class="infotextattribut">'. $game['releasedate'] .'</tr>');
                        echo('</table>');
                        ?>
                    </div>
                    <br>
                    <div class="headline" id="allgemein">
                        <?php echo($game['name']); ?>
                    </div>
                    <br>
                    <br>
                    <?php echo($game['content']); ?>
                    <br>
                    <br>
                    <?php 
                    if($game['liste'] !== ""){
                        echo('Hier findest du die 100% Liste: <a href="'. $game['liste'] .'" class="textlink2" target="_blank">Super Mario Bros. 100% Liste</a>');
                    } else{
                        echo('Aktuell ist noch keine 100% Liste vorhanden');
                    }
                    ?>
                    <br>
                    <br>
                    Guides
                    <table id="guides">
                        <th>Name</th>
                        <th>Beschreibung</th>
                        <?php 
                        foreach($guides as $guide){
                            echo('<tr>');
                            echo('<td class="guidesname"><a href="guide.php?guide='. $guide['guideid'] . '" class="tabellenlink">' . $guide['name'] . '</a></td>');
                            echo('<td class="guidesdesc">' . $guide['desc'] . '</td>');
                            echo('</tr>');
                        }
                        ?>
                    </table>
                    <br>
                    <br>
                    Reviews
                    <table id="reviews">
                        <th>Name</th>
                        <th>Beschreibung</th>
                        <?php 
                        foreach($reviews as $review){
                            echo('<tr>');
                            echo('<td class="guidesname"><a href="review.php?review='. $review['reviewid'] . '" class="tabellenlink">' . $review['name'] . '</a></td>');
                            echo('<td class="guidesdesc">' . $review['desc'] . '</td>');
                            echo('</tr>');
                        }
                        ?>
                    </table>
                    <br>
                    <br>
                    <div id="speedruns">Speedrun Community-Rangliste</div>
                    <?php
                    foreach($speedrun_kategorien as $srk){
                        echo('Kategorie: ' . $srk['name']);
                        echo('<table class="speedruns">');
                        echo('<th>Platzierung</th><th>Name</th><th>Zeit</th><th>Link</th>');
                        $i = 1;
                        $filter_speedrun = ['srkid' => $srk['srkid']];
                        $options_speedrun = ['sort' =>['time' => 1]];
                        $runs = $collection_speedrun->find($filter_speedrun, $options_speedrun);
                        foreach($runs as $run){
                            echo('<tr>');
                            echo('<td class="platzierung">' . $i . '.</td>');
                            $i++;
                            $filter_runner = ['_id' => $run['runner']];
                            $runner = $collection_user->findOne($filter_runner);
                            echo('<td class="speedrunsname">' . $runner['name'] . '</td>');
                            echo('<td>' . $run['time'] . '</td>');
                            echo('<td class="reviewsdesc">');
                            if($run['link'] !== ""){
                                echo('<a href="' . $run['link'] . '" class="tabellenlink">Run ansehen</a>');
                            }else{
                                echo('kein Video vorhanden');
                            }
                            echo('</td>');
                            echo('</tr>');
                        }
                        echo('</table>');
                    }
                    ?>
                    <!-- Kategorie: any%
                    <table class="speedruns">
                        <th>Platzierung</th>
                        <th>Name</th>
                        <th>Zeit</th>
                        <th>Link</th>
                        <tr>
                            <td class="platzierung">1.</td>
                            <td class="speedrunsname">++Platzhalter++</td>
                            <td>00:00</td>
                            <td class="reviewsdesc">++Platzhalter++</td>
                        </tr>
                    </table> -->
                </div>
            </div>
            <div class="block" id="navright">
                <a href="#allgemein" class="link2">Allgemeine Infos</a>
                <a href="#guides" class="link2">Guides</a>
                <a href="#reviews" class="link2">Reviews</a>
                <a href="#speedruns" class="link2">Speedruns</a>
            </div>
        </div>
        <div id="footer">
            <div class="textlink">
            <a href="../impressum.html"> Impressum</a>
            </div>
        </div>
    </div>
</body>
</html>