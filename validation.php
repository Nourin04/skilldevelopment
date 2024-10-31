<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $email = $message = "";
    $errors = [];

    // Validate name
    if (empty($_POST["name"])) {
        $errors['name'] = "Name is required.";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $errors['name'] = "Only letters and spaces are allowed.";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required.";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
    }

    // Validate message
    if (empty($_POST["message"])) {
        $errors['message'] = "Message is required.";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If no errors, proceed (you can handle form submission here, like sending an email)
    if (empty($errors)) {
        echo "Form submitted successfully!";
        // You can add mail functionality or database insertion here
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>