<?php
require_once __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q';
$bot_username = '@blz_sl_currency_converter_bot';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Unset / delete the webhook
    $result = $telegram->deleteWebhook();

    echo $result->getDescription();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}