<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
$env = parse_ini_file ('../env/data.env');
session_name('marmar');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN'){
    header('Location: ../index.php');
}

$uri = $env['MONGODB_URI'];
$client = new MongoDB\Client($uri);
$collection = $client->security->loginitem;
$mailpw = $env['MAIL_PW'];

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$role = $_POST['role'] ?? '';

$filteremail = ['email' => $email];
$uniqueemail = $collection->findOne($filteremail);

$filtername = ['name' => $name];
$uniquename = $collection ->findOne($filtername);

if(!isset($uniqueemail) && !isset($uniquename)){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-()';
    $length = strlen($characters);
    $randompw = '';

    for($i = 0; $i < 10; $i++){
        $randompw .= $characters[random_int(0, $length - 1)];
    }

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'mail.gmx.net';
    $mail->Port = '587';
    $mail->Username = 'projektmarmar@gmx.net';
    $mail->Password = $mailpw;
    $mail->SMTPAuth = true;
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->setFrom('projektmarmar@gmx.net', 'Projekt MarMar');
    $mail->addAddress($email);
    $mail->addReplyTo('projektmarmar@gmx.net', 'Projekt MarMar');
    $mail->Subject = 'Registrierung für MarMar';
    $mail->Body = "Herzlich Willkommen im MarMar!\r\n \r\nDu wurdest für die MarMar-Webseite registriert. Untenstehend findest du deine Anmeldedaten.\r\n \r\nBenutzername: " . $email . "\r\nPasswort: " . $randompw . "\r\n \r\nUnter ++Platzhalter++ kannst du dich anmelden.";
    $mail->send();

    //$nachricht = "Herzlich Willkommen im MarMar!\r\n \r\nDu wurdest für die MarMar-Webseite registriert. Untenstehend findest du deine Anmeldedaten.\r\n \r\nBenutzername: " . $email . "\r\nPasswort: " . $randompw . "\r\n \r\nUnter ++Platzhalter++ kannst du dich anmelden.";
    //$nachricht = wordwrap($nachricht, 70, "\r\n");

    //$empf = $email;
    //$betreff = 'Registrierung für MarMar';
    //$header = 'From: projektmarmar@gmx.net' . "\r\n" . 'Reply-To: projektmarmar@gmx.net' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    // //mail($empf, $betreff, $nachricht, $header);

    $pwhash = password_hash($randompw, PASSWORD_DEFAULT);

    $result = $collection->insertOne(['name' => $name, 'pw' => $pwhash, 'role' => $role, 'email' => $email, 'favgame' => '', 'favfranchise' => '', 'icon' => '', 'desc' => '']);

    header("Location: ../index.php");
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
                <a href="../sites/admin.php" class="link">Zurück zur Admin-Konfig</a>
            </div>
            <div class="block" id="inhalt">
                <div class="absatzcenter">
                    Registrierung fehlgeschlagen!<br>
                    Benutzername oder E-Mail Adresse existieren bereits.
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