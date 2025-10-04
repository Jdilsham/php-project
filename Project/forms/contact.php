<?php
// Enable error reporting for debugging (optional)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session (needed for session variables)
session_start();
require "../../connection.php";

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust the path to the autoload file
require __DIR__ . '../../../vendor/autoload.php'; // Adjust relative path

// Function to sanitize input data
function validate($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form fields are set
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {

    // Sanitize the input data
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $subject = validate($_POST['subject']);
    $message = validate($_POST['message']);

    // Prepare the SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the query
    if ($stmt->execute()) {
        // Data inserted successfully, send email notification using Gmail SMTP

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Enable SMTP debugging
            //$mail->SMTPDebug = 2; // Enables detailed SMTP debug output
            //$mail->Debugoutput = 'html'; // Output in HTML format for better readability

            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'janithadilsham@gmail.com';  // Your Gmail address
            $mail->Password = 'ptdazwhvnkfmuzli';  // Your Gmail password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set the "From" email (Gmail address)
            $mail->setFrom('janithadilsham@gmail.com', $name);
            $mail->addAddress('janitha1717@gmail.com', 'Janitha Dilsham');  // Recipient email

            // Subject and email body content
            $mail->Subject = 'New Message from Contact Form';

            // Set the email format to HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';  // Set character encoding for the email

            // HTML body content
            $mail->Body = "<html>
                <head>
                    <title>New Message from Contact Form</title>
                </head>
                <body>
                    <h2>Contact Form Submission</h2>
                    <p><strong>Name:</strong> " . $name . "</p>
                    <p><strong>Email:</strong> " . $email . "</p>
                    <p><strong>Subject:</strong> " . $subject . "</p>
                    <p><strong>Message:</strong></p>
                    <p>" . nl2br($message) . "</p>  <!-- nl2br converts newlines to <br> -->
                </body>
            </html>";

            // Send the email
            $mail->send();

            // Set success message and redirect
            echo '<script type="text/javascript">
                    alert("Message has been sent successfully.");
                    window.location.href = "../contact.html"; // Adjust the page URL if needed
                </script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['form_status'] = 'error';
        $_SESSION['error_message'] = 'Failed to submit the form. Please try again later.';
        header("Location: ../contact.html");
        exit();
    }

    // Close the prepared statement
    $stmt->close();
} else {
    $_SESSION['form_status'] = 'error';
    $_SESSION['error_message'] = 'Please fill in all fields.';
    header("Location: ../contact.html");
    exit();
}

// Close the database connection
$conn->close();
