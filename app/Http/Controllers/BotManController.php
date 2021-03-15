<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) 
        {

            if ($message == 'hola' || $message == 'Hola' || $message == 'Hi' || $message == 'HOLA') {
                $this->askName($botman);

            } elseif ($message == 'ayuda' || $message == 'Ayuda' || $message == 'AYUDA') {
                $this->help($botman);

            }else {
                 $botman->reply("Bienvenidx a Amasó! Tienes un problema? prueba escribir 'ayuda'");
            }
        });

        $botman->listen();
    }


    public function askName($botman)
    {
        $botman->ask('Cómo te llamas?', function (Answer $answer) {

            $name = $answer->getText();
            
            $botman = app('botman');

            $this->say('Encantadx de conocerte ' .  $name);
            $this->askProductProblem($botman);

        });
    }


    public function askProductProblem($botman)
    {
        $botman->ask('Encuentra aqui un tutorial que te ayudara con tu problema. Amaso@Tutoriales', function (Answer $answer) {

            $this->say('Ha sido un placer ayudarte!');
        });
    }

    public function help($botman)
    {
        $botman->ask("En que puedo ayudarte?  elige una categoria para ayudarte, Ej: 'productos'", function (Answer $answer) {

            $category = $answer->getText();

            $this->say('has elegido la categoria' . $category);

            $this->productProblem($botman);
        });
    }



    public function helpOtro($botman)
    {
        $botman->ask('Contacta con nuestro administrador si tienes problemas de sesion: admin@amaso', function (Answer $answer) {

            $this->say('Ha sido un placer ayudarte!');
        });
    }



}
