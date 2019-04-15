 <?php
include('config.php');

if(empty($_SESSION['uid']))
{
	header("Location: index.php");
}

include('class/userClass.php');
$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);
$secret=$userDetails->google_auth_code;
$email=$userDetails->email;

require_once 'googleLib/GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$qrCodeUrl = $ga->getQRCodeGoogleUrl($email, $secret,'2FA SOFT TOKEN SECURE THE DATA');


?>
<!DOCTYPE html>
<html>
<head>
    <title>QR CODE</title>
    <link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
</head>
<body>
	<div id="container">
		<h1>UUM STAFF RECORD MANAGEMENT SYSTEM</h1>
		<div id='device'>

<center><p>Please Scan the QR Code.</p></center>
<div id="img">
<img src='<?php echo $qrCodeUrl; ?>' />
</div>

<form method="post" action="home.php">
<center><label>Enter Google Authenticator Code</label></center>
<input type="text" name="code" autocomplete="off" />
<center><input type="submit" class="button"/></center>
</form>

 </form>
 <center><a class="small" href="logout.php">Logout</a></center> 
</form>
</div>

</body>
</html>
