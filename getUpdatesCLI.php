#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;

$bot_api_key  = '6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q';
$bot_username = '@blz_sl_currency_converter_bot';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Enable MySQL
    $telegram->useGetUpdatesWithoutDatabase();

    // Handle telegram getUpdates request
    $telegram->handleGetUpdates();

    $telegram->setUpdateFilter(function (Update $update, Telegram $telegram, &$reason = 'Update denied by update_filter') {
        $user_id = $update->getMessage()->getFrom()->getId();
        if ($user_id == 721653619) {
            return true;
        }
    
        $reason = "Invalid user with ID {$user_id}";
        return false;
    });
    
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e->getMessage();
}