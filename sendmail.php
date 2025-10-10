<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "error" => "Invalid request."]);
    exit();
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$message = trim($_POST["message"] ?? "");

if (!$name || !$email || !$message) {
    echo json_encode(["success" => false, "error" => "Missing fields."]);
    exit();
}

// Prepare email
$to = "nic@niccoates.uk";
$subject = "New message from your website";
$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: $name <$email>\r\nReply-To: $email\r\n";

// Attempt to send
if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Mail failed."]);
}
