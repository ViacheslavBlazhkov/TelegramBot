<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

use Longman\TelegramBot\Entities\Update;

$bot_api_key  = '6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q';
$bot_username = '@blz_sl_currency_converter_bot';
$hook_url     = 'https://tg-test-bot.pp.ua/hook.php';
$allowed_updates = Update::getUpdateTypes();

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Set webhook
    $result = $telegram->setWebhook($hook_url, ['allowed_updates' => $allowed_updates]);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
    
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e->getMessage();
}