<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require './subscriptions-lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $inputData = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["success" => false, "message" => "Помилка формату JSON!"]);
        exit;
    }

    $name = isset($inputData['name']) ? trim(htmlspecialchars($inputData['name'], ENT_QUOTES, 'UTF-8')) : '';
    $email = isset($inputData['email']) ? trim($inputData['email']) : '';
    $budget = isset($inputData['budget']) ? trim(htmlspecialchars($inputData['budget'], ENT_QUOTES, 'UTF-8')) : '';
    $subject = isset($inputData['subject']) ? trim(htmlspecialchars($inputData['subject'], ENT_QUOTES, 'UTF-8')) : '';
    $message = isset($inputData['message']) ? trim(htmlspecialchars($inputData['message'], ENT_QUOTES, 'UTF-8')) : '';
    
    $timestamp = date('Y-m-d H:i:s');
    $userIP = $_SERVER['REMOTE_ADDR'];

    if (!$name || !$email || !$budget || !$subject || !$message) {
        logMessage("Помилка валідації: Пропущені обов'язкові поля.");
        echo json_encode(["success" => false, "message" => "Всі поля є обов'язковими!"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        logMessage("Помилка валідації: Невірний формат email.");
        echo json_encode(["success" => false, "message" => "Невірний формат email!"]);
        exit;
    }

    $subscriptionData = [
        'name' => $name,
        'email' => $email,
        'budget' => $budget,
        'subject' => $subject,
        'message' => $message,
        'timestamp' => $timestamp,
        'user_ip' => $userIP
    ];

    addSubscription($subscriptionData);
    logMessage("Нова підписка додана для email: $email");
    
    echo json_encode(["success" => true, "message" => "Дякуємо за підписку!"], JSON_UNESCAPED_UNICODE);
    exit;
}

logMessage("Некоректний метод запиту.");
echo json_encode(["success" => false, "message" => "Некоректний метод запиту"], JSON_UNESCAPED_UNICODE);
exit;
?>