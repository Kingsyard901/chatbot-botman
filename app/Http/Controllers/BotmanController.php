<?php

namespace App\Http\Controllers;

use BotMan\Drivers\Web\WebDriver;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\LaravelCache;

class BotmanController extends Controller
{
    public function startConv() {
        $config = [
            'web' => [
                'matchingData' => [
                    'driver' => 'web',
                ],
            ]
        ];

        // Load the driver(s) you want to use
        DriverManager::loadDriver(WebDriver::class);

        // Create an instance
        $botman = BotManFactory::create($config, new LaravelCache());

        // Give the bot something to listen for.
        $botman->hears('My name {name}', 'App\Http\Controllers\MyBotCommandsController@myName');

        $botman->hears('foo', 'App\Http\Controllers\MyBotCommandsController@handleFoo');

        $botman->hears('Payment Terms', 'App\Http\Controllers\MyBotCommandsController@paymentTerms');

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
        });

        // Start listening
        $botman->listen();
    }
}
