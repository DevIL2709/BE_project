<?php
    require_once "../functions/database_functions.php";
    require_once "./PHPMailer/src/Exception.php";
    require_once "./PHPMailer/src/PHPMailer.php";
    require_once "./PHPMailer/src/SMTP.php";
    require_once './twilio-php-main/src/Twilio/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use Twilio\Rest\Client;
    $conn = db_connect();

    //casenotif query
    $casenotifquery = "SELECT clientname, hearingdate FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 1";
    $casenotifresult = mysqli_query($conn, $casenotifquery);
    $casenotifresult = mysqli_fetch_assoc($casenotifresult);

    //tasknotif query
    $tasknotifquery = "SELECT related, deadline FROM tasks WHERE deadline >= CURDATE() ORDER BY deadline LIMIT 1";
    $tasknotifquery = mysqli_query($conn, $tasknotifquery);
    $tasknotifresult = mysqli_fetch_assoc($tasknotifquery);

    //appnotif query
    $appnotifquery = "SELECT cname, date, time FROM appointment WHERE date >= CURDATE() ORDER BY date LIMIT 1";
    $appnotifquery = mysqli_query($conn, $appnotifquery);
    $appnotifresult = mysqli_fetch_assoc($appnotifquery);

    $clientemailidquery = "SELECT email FROM clients, cases WHERE name = (SELECT clientname FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 1)";
    $clientemailid = mysqli_query($conn, $clientemailidquery);
    $clientemailid = mysqli_fetch_assoc($clientemailid);
    $clientemailid = $clientemailid['email'];

    // Instantiation and passing `true` enables exceptions
    $mail  = new PHPMailer(true);
    $email = 'softwareforadv@gmail.com';
    $body  = 'Your next hearing date is: '. $casenotifresult['hearingdate'] .' for client: '. $casenotifresult['clientname'];
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'softwareforadv@gmail.com';                     // SMTP username
        $mail->Password   = 'ABC@1234';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email);
        $mail->addAddress($email);
        $mail->addCC($clientemailid);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Case Reminder';
        $mail->Body    = $body;

        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

    $text = 'Your next hearing date is: '. $casenotifresult['hearingdate'] .' for client: '.$casenotifresult['clientname'];
    // Your Account SID and Auth Token from twilio.com/console
    $account_sid = 'ACde0662d6ecbbfa4c8ae3eac0fff941fd';
    $auth_token = '26c8c325b16997f6bc582155fc5099cf';
    // In production, these should be environment variables. E.g.:
    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
    // A Twilio number you own with SMS capabilities
    $twilio_number = "+14157809056";
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        // Where to send a text message (your cell phone?)
        '+919870676203',
        array(
            'from' => $twilio_number,
            'body' => $text,
        )
    );
?>