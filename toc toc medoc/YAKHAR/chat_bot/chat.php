<?php
   require_once 'vendor/autoload.php';
  
   use BotMan\BotMan\Messages\Incoming\Answer;
  use BotMan\BotMan\Messages\Outgoing\Question;
   use BotMan\BotMan\Messages\Outgoing\Actions\Button;
   use BotMan\BotMan\Messages\Conversations\Conversation;

   use BotMan\BotMan\BotMan;
   use BotMan\BotMan\BotManFactory;
   use BotMan\BotMan\Drivers\DriverManager;
 
   
   use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
   use BotMan\BotMan\Cache\DoctrineCache;
   use BotMan\BotMan\Cache\CodeIgniterCache;
   use BotMan\BotMan\Cache\Psr6Cache;
   use BotMan\BotMan\Cache\SymfonyCache;
   use Symfony\Component\Cache\Adapter\FilesystemAdapter;
   use BotMan\BotMan\Cache\RedisCache;
   use Doctrine\Common\Cache\FilesystemCache;
   

  
    

$config = [
    'conversation_cache_time' => 60
    // Your driver-specific configuration
    // "telegram" => [
    //    "token" => "TOKEN"
    // ]
];
class MedicalConversation extends Conversation {

    protected $age;
    protected $sexe;
    protected $symptome;
    
    protected $indicator=true ;


    public function askConfirmationToStartConversation(){
        $question = Question::create('vous souhaitez démarrer le processus de diagnostic?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Oui !')->value('oui'),
            Button::create('Non')->value('non'),
        ]);

    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
             $selectedValue= $answer->getValue(); // will be either 'yes' or 'no'
            if( $selectedValue=='oui'){
                $this->askForSymptom();
            }else{
                $this->say('au revoir !!');
                $this->say('faites-moi savoir si vous voulez recommencer :)');


            }
            $selectedText = $answer->getText(); 
            // will be either 'Of course' or 'Hell no!'
        }
    });
    }
    public function askForSymptom(){
    
        $this->ask('décrivez votre symptôme, utilisez des phrases comme: je me sens ....., j\'ai.....', function(Answer $answer) {
        $this->symptome = $answer->getText();
       try {
            $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', 'root', '');
           // $this->say('connection established to data base');
           // $stm = $pdo->query("SELECT DATABASE()") ;
           foreach($pdo->query("SELECT * FROM SYMPTOMES WHERE nom_commun  =\"$this->symptome\"") as $row)
            {
                $nom_symptome=utf8_encode($row['nom_commun']);
                $id_symptome=utf8_encode($row['id_symptome']);
                $des_symptome=utf8_encode($row['description_symptome']);
               
                $this->say("Vous avez : " .$nom_symptome );
                $this->askConfirmationForSymptomDescription($des_symptome ,$id_symptome);
               
            }
            if($this->indicator){
                $this->say("Aucune resultat ):");
                $this->askForSymptom();

            }
            
       }
        catch(PDOException $e)
            {
                $this->say("Connection failed: " . $e->getMessage());
            }
        
        // Save result
        

    });
}

    public function askConfirmationForSymptomDescription($sym_des,$sym_id){
        $question = Question::create('voulez-vous une description de votre symptôme ?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Oui')->value('oui'),
            Button::create('Non')->value('non'),
        ]);

    $this->ask($question, function (Answer $answer) use($sym_des,$sym_id) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
             $selectedValue= $answer->getValue(); // will be either 'yes' or 'no'
            if( $selectedValue=='oui'){
                $this->say($sym_des);
                $this->getRemede($sym_id);
            }else{
                $this->getRemede($sym_id);
              
            }
            $selectedText = $answer->getText(); 
            // will be either 'Of course' or 'Hell no!'
        }
    });
    }
   
   
    public function askConfirmationForRemedeDetails($remede_des){
        $question = Question::create('vous voulez une description plus détaillée de votre remède')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Oui')->value('oui'),
            Button::create('Non')->value('non'),
        ]);

    $this->ask($question, function (Answer $answer) use($remede_des) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
             $selectedValue= $answer->getValue(); // will be either 'yes' or 'no'
            if( $selectedValue=='oui'){
                $this->say($remede_des);
                $this->say('diagnostic terminé, au revoir');
            }else{
                $this->say('diagnostic terminé, au revoir');
              
            }
            $selectedText = $answer->getText(); 
            // will be either 'Of course' or 'Hell no!'
        }
    });


    }
    public function getRemede($sym_id){
        try {
            $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', 'root', '');
           
           // $stm = $pdo->query("SELECT DATABASE()") ;
           foreach($pdo->query("SELECT a.nom_remede, a.description_remede, b.posologie FROM REMEDES a JOIN SOIGNE b ON a.id_remede = b.id_remede JOIN SYMPTOMES c ON c.id_symptome = b.id_symptome WHERE b.id_symptome  =\"$sym_id\"") as $row2)
          {
             $nom_remede =utf8_encode($row2['nom_remede']);
             $description_remede=utf8_encode($row2['description_remede']);
             $posologie=utf8_encode($row2['posologie']);
             $this->say("votre remède devrait être : " );
             $this->say($nom_remede );
             $this->say("apport quotidien recommandé : " );
             $this->say($posologie );
             $this->askConfirmationForRemedeDetails($description_remede);
            
          }
               
               
            }
         
            
         catch(PDOException $e)
            {
                $this->say("Connection failed: " . $e->getMessage());
            }
        
    }
        
      

    

    public function run()
    {
        // This will be called immediately
        $this->askConfirmationToStartConversation();
    }
}
$doctrineCacheDriver = new FilesystemCache("C:/Users/HAITAM/Desktop/cache");
//$botman = BotManFactory::create($config,new DoctrineCache($doctrineCacheDriver));
DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

   //$botman = BotManFactory::create($config);
   $botman = BotManFactory::create($config,new DoctrineCache($doctrineCacheDriver));
  // Give the bot something to listen for.
 $botman->hears('bonjour|Bonjour|hey|Coucou|cc|Cc|hello|Hello|bonsoir', function (BotMan $bot) {
    //$bot->getMessage();
    
    $bot->startConversation(new MedicalConversation);
    
});


/*
$botman->hears('Non|non|nn|Nn|pas encors', function (BotMan $bot) {
    $bot->reply('Au revoir');
});
*/
/*
$botman->fallback(function($bot) {
    $bot->reply('désolé je n\'ai pas compris votre commande, j\'apprends encore, réessayez avec une commande de confirmation');
});*/

// Start listening
$botman->listen();