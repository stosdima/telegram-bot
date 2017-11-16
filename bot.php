<?php
require_once "vendor/autoload.php";

try {
    $bot = new \TelegramBot\Api\Client('438332110:AAFCgeVIz_vq6HJznmLqbvTcxbZ0v4lCEzY');

    $bot->command('start', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'Hello, ' .$message->getChat()->getFirstName() .'. thank`s for subscribing. Commands list: /help' );
    });

    $bot->command('help', function ($message) use ($bot){
        $commandList = 'List of commands:
                         /start - start work with bot
                         /stop - stop work with bot
                         /search - search posts by categories
                         /admin - site administrator panel
                         <b>if you want get quote input random message to bot</b>';
        $bot->sendMessage($message->getChat()->getId, $commandList, 'html');
    });

    $bot->command('search', function ($message) use ($bot) {
        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
                [
                    ['text' => 'Categories', 'callback_data' => 'categories'],
                    ['text' => 'Keyword', 'callback_data' => 'keyword'],
                ]
            ]
        );
        $bot->sendMessage($message->getChat()->getId(), "Search by:", null, false, null, $keyboard );
    });

    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}