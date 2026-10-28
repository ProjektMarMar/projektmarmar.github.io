<?php
session_name('marmar');
session_start();
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
                    <div class="logininfo">
                        <?php if(isset ($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset ($_SESSION['username'])){
                        echo ($_SESSION['username']);
                        } ?>
                    </div>
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
                        <img src="../../src/listIcons/Icon_SuperMarioBros.png" alt="SuperMarioBros. Titlescreen" style="width: 100%; height: auto;">
                        <div class="bildinfos">Screenshot aus: Super Mario Bros. Urheber: Nintendo</div>
                        <table class="infotext">
                            <tr>
                                <td class="infotextname">Name</td>
                                <td class="infotextattribut">Super Mario Bros.</td>
                            </tr>
                            <tr>
                                <td class="infotextname">Konsole</td>
                                <td class="infotextattribut">Famicom, Nintendo Entertainment System (NES)</td>
                            </tr>
                            <tr>
                                <td class="infotextname">Genre</td>
                                <td class="infotextattribut">2D Platformer</td>
                            </tr>
                            <tr>
                                <td class="infotextname">Entwickler</td>
                                <td class="infotextattribut">Systems Research & Development</td>
                            </tr>
                            <tr>
                                <td class="infotextname">Publisher</td>
                                <td class="infotextattribut">Nintendo</td>
                            </tr>
                             <tr>
                                <td class="infotextname">Veröffentlichung</td>
                                <td class="infotextattribut">Juni 1986</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="headline" id="allgemein">
                        Super Mario Bros.
                    </div>
                    <br>
                    <br>
                    Hier werden ein paar allgemeine Informationen des ausgewählten Games hinterlegt. Aktuell fehlen diese noch und werden nachgereicht.
                    <br>
                    <br>
                    Hier findest du die 100% Liste: <a href="" class="textlink2">Super Mario Bros. 100% Liste</a>
                    <br>
                    <br>
                    Guides
                    <table id="guides">
                        <th>Name</th>
                        <th>Beschreibung</th>
                        <tr>
                            <td class="guidesname">++Platzhalter++</td>
                            <td class="guidesdesc">++Platzhalter++</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    Reviews
                    <table id="reviews">
                        <th>Name</th>
                        <th>Beschreibung</th>
                        <tr>
                            <td class="reviewsname">++Platzhalter++</td>
                            <td class="reviewsdesc">++Platzhalter++</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <div id="speedruns">Speedrun Community-Rangliste</div>
                    Kategorie: any%
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
                    </table>
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