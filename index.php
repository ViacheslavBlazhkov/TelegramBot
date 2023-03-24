<?php
$botToken = "6294254865:AAFxKM1MYzYSnOOomAas0rRxwIXXihRpm5Q";
$website = "https://api.telegram.org/bot" . $botToken;

$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

if (strpos($message, "/start") === 0) {
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=Welcome to CurrencyConverterBot! Type in the format '/convert {amount} {from_currency} to {to_currency}' to convert currencies.");
} else if (strpos($message, "/convert") === 0) {
    $message = str_replace("/convert ", "", $message);
    $args = explode(" ", $message);
    $amount = floatval($args[0]);
    $from = strtoupper($args[1]);
    $to = strtoupper($args[3]);

    $rates = array( 
        "USD" => array(
            "EUR" => 0.82,
            "GBP" => 0.72,
            "CAD" => 1.26,
            "AUD" => 1.29
        ),
        "EUR" => array(
            "USD" => 1.22,
            "GBP" => 0.87,
            "CAD" => 1.54,
            "AUD" => 1.57
        ),
        "GBP" => array(
            "USD" => 1.38,
            "EUR" => 1.15,
            "CAD" => 1.76,
            "AUD" => 1.79
        ),
        "CAD" => array(
            "USD" => 0.79,
            "EUR" => 0.65,
            "GBP" => 0.57,
            "AUD" => 1.02
        ),
        "AUD" => array(
            "USD" => 0.77,
            "EUR" => 0.64,
            "GBP" => 0.56,
            "CAD" => 0.98
        )
    );

    if (isset($rates[$from][$to])) {
        $result = $amount * $rates[$from][$to];
        file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$amount." ".$from." = ".$result." ".$to);
    } else {
        file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=Sorry, the conversion from ".$from." to ".$to." is not supported yet.");
    }
} else {
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=Invalid command. Type '/start' to see the available commands.");
}

?>