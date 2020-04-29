<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TicTocMedoc</title>
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
        <style>
           
.toctoc_logo {
display: block;
margin-left: 380px;
margin-right: auto;

}
.toctoc_logo {
        width: 520px;
        height: 520px;
        overflow: hidden;
    }

    .toctoclogo img {
        width: 400px;
        height: 300px;
        
    }
</style>
    </head>
    <body>
    <div class="toctoc_logo">
        <img src="medic_robot.jpg" alt="Medic Bot At Your Service" width="600" height="600">
    </div>
    <script>
        var botmanWidget = {
            frameEndpoint: '/chat.html',
            introMessage: 'Bonjour !, vous m\'avez réveillé ! ',
            chatServer : 'C:/wamp64/www/MedicBot/chat.php', 
            title: 'TocTocMedoc ChatBot', 
            mainColor: '#00001a',
            bubbleBackground: '#00001a',
            aboutText: 'Powered by team YAKHAR',
            bubbleAvatarUrl: '',
        }; 
    </script>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>


       
    </body>
</html>