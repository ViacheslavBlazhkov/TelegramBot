<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Entities\Update;

$bot_api_key  = '6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q';
$bot_username = '@blz_sl_currency_converter_bot';
$myId = 721653619;

$update = json_decode(file_get_contents('php://input'), true);

// Отримуємо текст повідомлення та ідентифікатор чату, з якого воно було відправлено
$message = $update['message']['text'];
$chat_id = $update['message']['chat']['id'];

// Відправляємо відповідь назад з отриманим текстом повідомлення та ідентифікатором чату
$parameters = array(
    'chat_id' => $chat_id,
    'text' => $message
);

$url = 'https://api.telegram.org/bot' . $bot_api_key . '/sendMessage';
$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($parameters),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result, true );

// Виводимо результат
if ($response['ok'] == true) {
    echo 'Message sent';
} else {
    echo 'Message not sent';
}
