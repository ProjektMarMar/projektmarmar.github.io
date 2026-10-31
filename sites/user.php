<?php
require_once __DIR__ . '/../vendor/autoload.php';
$env = parse_ini_file ('../env/data.env');

session_name('marmar');
session_start();

$uri = $env['MONGODB_URI'];
$client = new MongoDB\Client($uri);
$collection = $client->security->loginitem;
$collection2 = $client->security->franchise;
$collection3 = $client->security->game;

$name = $_SESSION['username']?? '';
$email = $_SESSION['email']?? '';
$favgame = $_SESSION['favgame']?? '';
$favfranchise = $_SESSION['favfranchise']?? '';
$icon = $_SESSION['icon']?? '';
$desc = $_SESSION['desc']?? '';

$clickedname = htmlspecialchars($_GET["name"]);

$filter = ['name' => $clickedname];
$result = $collection->findOne($filter);
if ($result['favfranchise'] !== ''){
    $filterfranchise = ['fid' => $result['favfranchise']];
    $result2 = $collection2->findOne($filterfranchise);
}else{
    $result2['name'] = '-';
}

if ($result['favgame'] !== ''){
    $filtergame = ['gameid' => $result['favgame']];
    $result3 = $collection3->findOne($filtergame);
}else{
    $result3['name'] = '-';
}

$gesamtresult2 = $collection2->find();
$gesamtresult3 = $collection3->find();

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
                    <a href="" class="logininfo">
                    <?php if(isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset ($_SESSION['username'])){
                    echo ($_SESSION['username']);
                    } ?>
                    </a>
                </div>
                <img src="../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px; position: absolute;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <a href="../index.php" class="link">Startseite</a>
                <a href="" class="chosen">Der MarMar</a>
                <a href="games.php" class="link">Games</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    <br>
                    <div class="headline">
                        <?php 
                        echo($result['name']);
                        ?>
                    </div>
                    <br>
                    <br>
                    <table class="userdata">
                        <tr>
                            <td class=""userdataname>Lieblingsspiel:</td>
                            <td class="userdataattribut">
                                <?php
                                if($clickedname === $name){
                                    echo('<select name="game">');
                                    echo('<option value="-"');
                                    if($result3['name'] === '-'){
                                        echo(' selected="selected"');
                                    }
                                    echo('>-</option>');
                                    foreach($gesamtresult3 as $game){
                                        echo('<option value="' . $game['gameid'] .'"');
                                        if($game['gameid'] === $result['favgame']){
                                            echo(' selected="selected"');
                                        }
                                        echo('>' . $game['name'] . '</option>');
                                    }
                                    echo("</select>");
                                }else{
                                    echo($result3['name']);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class=""userdataname>Lieblingsfranchise:</td>
                            <td class="userdataattribut">
                                <?php
                                if($clickedname === $name){
                                    echo('<select name="franchise">');
                                    echo('<option value="-"');
                                    if($result2['name'] === '-'){
                                        echo(' selected="selected"');
                                    }
                                    echo('>-</option>');
                                    foreach($gesamtresult2 as $franchise){
                                        echo('<option value="' . $franchise['fid'] .'"');
                                        if($franchise['fid'] === $result['favfranchise']){
                                            echo(' selected="selected"');
                                        }
                                        echo('>' . $franchise['name'] . '</option>');
                                    }
                                    echo("</select>");
                                }else{
                                    echo($result2['name']);
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
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