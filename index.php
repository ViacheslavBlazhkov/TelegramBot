<?php

require_once 'selectCurrency.php';

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
    $username = $updateArray["message"]["chat"]["username"];

    // Відправляємо вітання, якщо користувач написав "/start"
    if ($message == "/start") {
        select_currency($bot_token, $chatId);
    } else {
        $text = "Something";
        file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?chat_id={$chatId}&text={$text}");
    }
}
