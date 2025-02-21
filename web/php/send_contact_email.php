<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message_content = htmlspecialchars(trim($_POST['message']));

    // Email details
    $to = "hello@mountain-melodies.in";  // Replace with your email address
    $subject = "New Contact Message";
    $message = "
    <html>
    <head>
        <title>New Contact Message</title>
    </head>
    <body>
        <h2>Contact Details</h2>
        <p><strong>First Name:</strong> $first_name</p>
        <p><strong>Last Name:</strong> $last_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone Number:</strong> $phone</p>
        <p><strong>Message:</strong> $message_content</p>
    </body>
    </html>
    ";

    // Additional headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        header('Location: https://mountain-melodies.in/thankyou.html');
        exit();
    } else {
        echo "<script type='text/javascript'>
        alert('Please try again later');
        window.history.back();
        </script>";
    }
} else {
    echo "<script type='text/javascript'>
    alert('Please try again later');
    window.history.back();
    </script>";
}
?>
