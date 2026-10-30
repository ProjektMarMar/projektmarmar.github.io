<?php
session_name('marmar');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN'){
    header('Location: ../index.php');
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
                <img src="../src/MarMarLogo.png" alt="MarMar Logo" style="width: auto; height: 80px; position: absolute;">
            </div>
        </div>
        <div id="körper">
            <div class="block" id="nav">
                <button onclick="history.back()">Zurück</button>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    <div class="headline">
                        Admin-Oberfläche
                    </div>
                    <br>
                    <form action="../php/register.php" method="post">
                        <div class="headline">
                            Neuen Nutzer anlegen und Passwort versenden
                        </div>
                        <br>
                        <table>
                            <tr class="anmeldedialog">
                                <td><label for="name">Name</label></td>
                                <td><input type="text" name="name" placeholder="Name" required></td>
                            </tr>
                            <tr class="anmeldedialog">
                                <td><label for="email">E-Mail</label></td>
                                <td><input type="email" name="email" placeholder="E-Mail" required></td>
                            </tr>
                            <tr class="anmeldedialog">
                                <td><label for="role">Rolle</label></td>
                                <td>
                                    <select name="role">
                                        <option value="USER" selected="selected">USER</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <button type="submit" class="button1">Registrieren</button>
                    </form>
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