<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Incoming\Answer;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class ,'startConversation');
$botman->hears('shafqat', function ($bot) {
    $bot->reply('Hello! shafqat');
});

$botman->hears('bye', function ($bot) {
    $bot->reply('good bye!');
});

$botman->hears('tellmemore', function ($bot) {
    $bot->ask('Kindly mention your age and your spouse age?', function (Answer $answer) {
        $answer->say('For how long have you been married?');
    });
});

$botman->hears('call me {name}', function ($bot, $name) {
    $bot->reply('Your name is: ' . $name);
});

$botman->hears('.*nice.*', function ($bot) {
    $bot->reply('Nice to meet you!');
});
$botman->fallback(function ($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
$botman->hears('Hello', function ($bot) {
    $user = $bot->getUser();
    $bot->reply('Hello ' . $user->getFirstName() . ' ' . $user->getLastName());
    $bot->reply('Your username is: ' . $user->getProfilePic());
    $bot->reply('Your gender is: ' . $user->getGender());
    $bot->reply('Your ID is: ' . $user->getId());
});
