<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OptionsConversation extends Conversation
{

    public function askName()
    {
        $this->ask('Cómo te llamas?', function (Answer $answer) {

            $this->name = $answer->getText();

            $this->say('Encantadx de conocerte ' .  $this->name);
            $this->askProblem();
        });
    }

    public function askProblem()
    {
        $question = Question::create("Hay algo que pueda hacer por ti?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'Si') {
                    $this->say("Juntos lo vamos a solucionar!!");
                    $this->askProductProblem();
                } else {
                    $this->say("Okey, te dejo seguir comprando!");
                }
            }
        });
    }

    public function askProductProblem()
    {

        $question = Question::create("Elige una categoria sobre lo que quieres conocer un poco mas!")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Tutoriales')->value('Tutoriales'),
                Button::create('Sesion')->value('Sesion'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'Tutoriales') {
                    $this->askForTutorials();
                } else {
                    $this->askForShopping();
                }
            }
        });
    }


    public function askForTutorials()
    {
        $this->say('Encuentra aqui un tutorial que te ayudara con tu problema. Amaso@Tutoriales');
        $this->askForNewProblem();
    }

    public function askForShopping()
    {
        $this->say('Contacta con nuestro administrador si tienes problemas de sesion: admin@amaso');
        $this->askForNewProblem();
    }



    public function askForNewProblem()
    {
        $question = Question::create("Alguna otra cosita en la que pueda ayudarte?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Si, necesito ayuda!!!')->value('Si'),
                Button::create('No')->value('No'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'No') {
                    $this->say('Ha sido un placer ayudarte!');
                } else {
                    $this->askForPersonalHelp();
                }
            }
        });
    }


    public function askForPersonalHelp()
    {
        $this->say('Contacta con nuestro administrador para una mejor asistencia en tu problema: admin@amaso');
    }

    public function run()
    {
        $this->askName();
    }
}
