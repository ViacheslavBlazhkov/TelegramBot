<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$bot_token = "6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q";
$user_id = 721653619;

$update = file_get_contents('php://input');
$updateArray = json_decode($update, true);

// Перевіряємо, чи є повідомлення у вхідних даних
if (isset($updateArray["message"])) {
    // Отримуємо інформацію про повідомлення та користувача
    $chatId = $updateArray["message"]["chat"]["id"];
    $message = $updateArray["message"]["text"];

    if ($message == "/start") {
        $data = http_build_query([
            "chat_id" => $chatId,
            "text" => 'Select your currency:'
        ]);

        $keyboard = json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => 'UAH',
                        'callback_data' => 'uah'
                    ],
                    [
                        'text' => 'USD',
                        'callback_data' => 'usd'
                    ],
                    [
                        'text' => 'EUR',
                        'callback_data' => 'eur'
                    ]
                ]
            ]
        ]);
        file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?{$data}&reply_markup={$keyboard}");
    }
}



if (isset($updateArray["message"])) {
    // Отримуємо інформацію про повідомлення та користувача
    $chatId = $updateArray["message"]["chat"]["id"];
    $message = $updateArray["message"]["text"];

    if ($message == "uah") {
        $selectedCurrency = 'uah';
        $data = http_build_query([
            "chat_id" => $chatId,
            "text" => 'You selected UAH'
        ]);
        file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?{$data}");
    } 
} if (isset($updateArray["message"])) {
    // Отримуємо інформацію про повідомлення та користувача
    $chatId = $updateArray["message"]["chat"]["id"];
    $message = $updateArray["message"]["text"];

    if ($message == "usd") {
        $selectedCurrency = 'usd';
        $data = http_build_query([
            "chat_id" => $chatId,
            "text" => 'You selected USD'
        ]);
        file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?{$data}");
    } 
} if (isset($updateArray["message"])) {
    // Отримуємо інформацію про повідомлення та користувача
    $chatId = $updateArray["message"]["chat"]["id"];
    $message = $updateArray["message"]["text"];

    if ($message == "eur") {
        $selectedCurrency = 'eur';
        $data = http_build_query([
            "chat_id" => $chatId,
            "text" => 'You selected EUR'
        ]);
        file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?{$data}");
    } 
}

$data = http_build_query([
    "chat_id" => $chatId,
    "text" => 'Write Sum: '
]);

if($selectedCurrency != null) {
    file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?{$data}");
}
