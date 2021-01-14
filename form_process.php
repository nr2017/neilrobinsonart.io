<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\xampp\composer\vendor\autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

// define variables and set to empty values
$nameErr = $emailErr = $subjectErr = "";
$name = $email = $message = $success = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }

  if ($nameErr == '' and $emailErr == '' ){
	$messageBody = '';
	unset($_POST['submit']);
	foreach ($_POST as $key => $value){
		$messageBody .=  "$key: $value\n";
	}
  }

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);	
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);	
$messageBody = filter_var($_POST['message'], FILTER_SANITIZE_STRING);	


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER             // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mail.gmx';                  // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'nrartprints@gmx.com';               // SMTP username
    $mail->Password   = 'pmqF7uW.JZvs';                             // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS`
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Sender
	$mail->setFrom('nrartprints@gmx.com', 'Neil Robinson');

    //Recipient
    $mail->addAddress($email, $name);     // Add a recipient


    //Body Content
    $body = "<p><strong>Hello</strong>, you have received a message from " . $name . " the  message is " . $message . " you can contact on " . $email . "</p>";

    //Content
    $mail->isHTML(true);                 // Set email format to HTML
    $mail->Subject = 'Contact Me submission ' . $name;
    
	$mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
	header("location; thankyou.php?sent");
	
} catch (Exception $e) {
    echo "Your message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>