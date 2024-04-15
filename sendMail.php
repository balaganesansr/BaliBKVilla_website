<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $desc = trim($_POST["desc"]);

    // Validate form data
    $errors = array();
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }
    if (empty($desc)) {
        $errors["desc"] = "Description is required";
    }

    // If there are no validation errors, send the email
    if (empty($errors)) {
        // Set recipient email address
        $to = "balaganesansr@gmail.com";

        // Set subject
        $subject = "New form submission";

        // Compose email message
        $message = "Name: $name\n";
        $message .= "Email: $email\n";
        $message .= "Description:\n$desc\n";

        // Set headers
        $headers = "From: $email" . "\r\n" .
            "Reply-To: $email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            // Email sent successfully
            echo json_encode(array("success" => true, "message" => "Form submitted successfully"));
        } else {
            // Failed to send email
            echo json_encode(array("success" => false, "message" => "Failed to send email"));
        }
    } else {
        // Validation errors
        echo json_encode(array("success" => false, "errors" => $errors));
    }
} else {
    // Request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
