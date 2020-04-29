<?php
  

   use BotMan\BotMan\BotMan;
   use BotMan\BotMan\BotManFactory;
   use BotMan\BotMan\Drivers\DriverManager;
   use BotMan\BotMan\Messages\Incoming\Answer;
   use BotMan\BotMan\Messages\Conversations\Conversation;
   use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$config = [
    'conversation_cache_time' => 1
    // Your driver-specific configuration
    // "telegram" => [
    //    "token" => "TOKEN"
    // ]
];
class onGoingConversation extends Conversation {

    protected $age;
    protected $sexe;
    protected $symptome;

    public function askAge()
    {
        $this->ask('quel âge avez-vous ?', function(Answer $answer) {
           
            // Save result
            $this->age = $answer->getText();
            $this->say('bien !');
            $this->askSexe();

        });
    }

    public function askSexe()
    {
            $this->ask('bien ! maintenant vous êtes un homme ou une femme ?', function(Answer $answer) {
            // Save result
            $this->sexe = $answer->getText();

            $this->say('très bien, il est maintenant temps d\'entrer vos symptômes ');
        });
    }

    public function askSymptom(){
        $this->ask('follow these tips to get better results', function(Answer $answer) {
            // Save result
            $this->symptome = $answer->getText();

            $this->say('Great - that is all we need');
        });
     
    }

    public function run()
    {
        // This will be called immediately
        $this->askAge();
    }
}
