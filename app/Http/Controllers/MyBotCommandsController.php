<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Http\Request;

class MyBotCommandsController extends Controller
{
    public function handleFoo($bot) {
        $bot->reply('Hello World');
    }

    public function myName($bot, $name) {
        $attachment = new \BotMan\BotMan\Messages\Attachments\Image('/img/slimshady.jpg');
        $message = OutgoingMessage::create('Hello yourself, you good looking ' . $name)
            ->withAttachment($attachment);

        $bot->reply($message);
    }

    public function paymentTerms($bot) {
        $bot->reply('Too see our Payment Terms ' .  "<a href='http://localhost:8001/files/Kopvillkor.pdf' target='_blank'>  Click here </a>");
    }
}
