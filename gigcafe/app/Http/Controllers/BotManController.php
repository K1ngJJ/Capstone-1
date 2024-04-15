<?php
namespace App\Http\Controllers;
   
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
   
class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
   
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'hi' || $message == 'Hi' || $message == 'hello' || $message == 'Hello') {
                $this->askName($botman);
            }
            
            else{
                $botman->reply("Start a conversation by saying hi.");
            }
   
        });
   
        $botman->listen();
    }
   
    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer, $conversation) {
            $name = $answer->getText();
            $this->say('Nice to meet you '.$name);

            $conversation->ask('Can you advise about your email.', function(Answer $answer, $conversation){
                $email = $answer->getText();
                $this->say('Email : '.$email);

                $conversation->ask('Confirm if the above email is correct. You can simply reply with yes or no', function(Answer $answer, $conversation){
                    $confirmEmail = $answer->getText();
                    if ($answer == 'yes' || $answer == 'Yes') {
                        $this->say("We have got your details.");
                    }
    
                });
            });
        });
    }
}