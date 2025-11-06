<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';
include('functions.php');

// Allow CORS 
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


$action = $_POST['action'] ?? '';

// CONTACT US FORM
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';
$subject = $_POST['subject'] ?? 'Contact Form';
$from_name = $_POST['from_name'] ?? 'Website Contact';

// SINGLE PRODUCT REQUEST
$name = $_POST["name"] ?? '';
$image = $_POST["image"] ?? '';
$quantity = $_POST["quantity"] ?? '';
// $email = $_POST["email"] ?? '';
$message = $_POST['message'] ?? 'Hello, I would love to make a quotation enquiry of the following products';
$subject = $_POST['subject'] ?? 'Quotation Enquiry';
$weight = $_POST["weight"] ?? '';

if($action == "submit_contact_form"){
$message_body = contact_message_body($name, $email, $phone, $subject, $message);
//Create an instance; passing `true` enables exceptions


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0; // Disable debug output                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', 'Cool Plus Limited');
    $mail->addAddress('', 'George Kimagut');     //Add a recipient
    $mail->addAddress('');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message_body;
    $mail->AltBody = $message_body;

    $mail->send();
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
    ]);
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo json_encode([
        'success'=> FALSE, 
        'message'=> 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}'
    ]);
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

// request quotation

if($action == "send_single_quote_request"){
    $subject = "Quote Request for " . $name;
    $message_body = quotation_request($name, $image, $quantity, $email, $message, $weight, $subject);
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('', 'Cool Plus Limited');
        $mail->addAddress('', 'George Kimagut');
        $mail->addAddress($email);
        $mail->addReplyTo($email, 'Reply from Cool Plus Limited');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message_body;
        $mail->AltBody = strip_tags($message_body);

        $mail->send();
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success'=> false, 
            'message'=> "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
        ]);
    }
}

if($action == "send_combined_quote_request"){
    // Get the email and items from POST
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $items = isset($_POST['items']) ? json_decode($_POST['items'], true) : [];
    
    // Validate email and items
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address'
        ]);
        exit;
    }
    
    if(empty($items) || !is_array($items)){
        echo json_encode([
            'success' => false,
            'message' => 'No items found in the request'
        ]);
        exit;
    }
    
    $subject = "Quotation Request - " . count($items) . " Item(s)";
    $message_body = combined_quotation_request($items, $email, $subject);
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('', 'Cool Plus Limited');
        $mail->addAddress('', 'George Kimagut');
        $mail->addAddress($email);
        $mail->addReplyTo($email, 'Reply from Cool Plus Limited');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message_body;
        $mail->AltBody = strip_tags($message_body);

        $mail->send();
        echo json_encode([
            'success' => true,
            'message' => 'Thank you! Your quote request has been sent successfully. We will get back to you soon.'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success'=> false, 
            'message'=> "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
        ]);
    }
}
