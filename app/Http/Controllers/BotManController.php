<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hola' || $message == 'Hola') {
                $this->askName($botman);
            } else {
                $botman->reply("Bienvenidx a Amasó");
            }
        });

        $botman->listen();
    }


    public function askName($botman)
    {
        $botman->ask('Cómo te llamas?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Encantadx de conocerte ' . $name);
        });
    }
}
