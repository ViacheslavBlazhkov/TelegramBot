<?php
$update = json_decode(file_get_contents('php://input'), TRUE);

$botToken = "6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q";
$botAPI = "https://api.telegram.org/bot" . $botToken;

// Check if callback is set
if (isset($update['callback_query'])) {

    // Reply with callback_query data
    $data = http_build_query([
        'text' => 'Selected currency: ' . $update['callback_query']['data'].'
        Enter nominal to transfer:',
        'chat_id' => $update['callback_query']['from']['id']
    ]);
    if ($update['callback_query']['data'] == 'usd') {
        /* ============================== */
    } else if ($update['callback_query']['data'] == 'uah') {
        /* ============================== */
    } else if ($update['callback_query']['data'] == 'eur') {
        /* ============================== */
    }
    file_get_contents($botAPI . "/sendMessage?{$data}");
}

// Check for normal command
$msg = $update['message']['text'];
if ($msg === "/start") {

    // Create keyboard
    $data = http_build_query([
        'text' => 'Please select your currency:',
        'chat_id' => $update['message']['from']['id']
    ]);
    $keyboard = json_encode([
        "inline_keyboard" => [
            [
                [
                    "text" => "UAH",
                    "callback_data" => "uah"
                ],
                [
                    "text" => "USD",
                    "callback_data" => "usd"
                ],
                [
                    "text" => "EUR",
                    "callback_data" => "eur"
                ]
            ]
        ]
    ]);

    // Send keyboard
    file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}");
}
