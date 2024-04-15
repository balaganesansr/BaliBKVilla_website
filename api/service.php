<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $desc = trim($_POST["desc"]);   
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
    if (empty($errors)) {
       
        $to = "balaganesansr@gmail.com";       
        $subject = "New form submission";       
        $message = "Name: $name\n";
        $message .= "Email: $email\n";
        $message .= "Description:\n$desc\n";       
        $headers = "From: $email" . "\r\n" .
            "Reply-To: $email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();       
        if (mail($to, $subject, $message, $headers)) {
           
            echo json_encode(array("success" => true, "message" => "Form submitted successfully"));
        } else {
           
            echo json_encode(array("success" => false, "message" => "Failed to send email"));
        }
    } else {
       
        echo json_encode(array("success" => false, "errors" => "1235000"));
    }
} else {
   
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
