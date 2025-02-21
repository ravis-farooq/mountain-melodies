<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    $total_persons = htmlspecialchars(trim($_POST['total_persons']));

    // Email details
    $to = "hello@mountain-melodies.in";
    $subject = "New Booking Request";
    $message = "
    <html>
    <head>
        <title>New Booking Request</title>
    </head>
    <body>
        <h2>Booking Details</h2>
        <p><strong>Full Name:</strong> $full_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone Number:</strong> $phone_number</p>
        <p><strong>Total Persons:</strong> $total_persons</p>
    </body>
    </html>
    ";

    // Additional headers
    // Set content-type header for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Set the "From" header to the customer's email address
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

