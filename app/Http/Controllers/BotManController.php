<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\OptionsConversation;

class BotManController extends Controller
{
    
    public function handle()
    {
        $botman = app('botman');
        
        $botman->hears('{message}', function ($botman, $message) 
        {
            
            if ($message == 'hola' || $message == 'Hola' || $message == 'Hi' || $message == 'HOLA') {
                $this->startConversation($botman);
                
            } elseif ($message == 'ayuda' || $message == 'Ayuda' || $message == 'AYUDA') {
                $this->startConversation($botman); 

            }else {
                $botman->reply("Bienvenidx a Amasó! Tienes un problema? prueba escribir 'ayuda'");
            }

        });
        
        $botman->listen();
    }

    
    public function startConversation(BotMan $botman)
    {
        $botman->startConversation(new OptionsConversation());
    }


}
