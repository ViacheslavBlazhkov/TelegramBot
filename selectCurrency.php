<?php
function select_currency($bot_token, $chatId) {
    $getQuery = array(
        "chat_id" => $chatId,
        "text" => 'Select your currency:',
        "reply_markup" => json_encode(
            array(
                'inline_keyboard' => array(
                    array(
                        array(
                            'text' => 'UAH',
                            'callback_data' => 'test'
                        ),
                        array(
                            'text' => 'USD',
                            'callback_data' => 'test'
                        ),
                        array(
                            'text' => 'EUR',
                            'callback_data' => 'test'
                        ),
                    ),
                ),
            )
        ),
    );
    file_get_contents("https://api.telegram.org/bot{$bot_token}/sendMessage?" . http_build_query($getQuery));
}
