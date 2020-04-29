<?php
    require("php/db_connexion.php");
?>
<html>

<head>
<script>

function backToHome(){ document.location.href="../index.php";
        }
</script>
<style>

body {
  background-color:white;
}
input[type=text] {
  width: 175%;
  
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 4px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
  border-radius:8px;
}

input[type=text]:focus {
  border: 4px solid #555;
}
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
.container{
    text-align: center;
    padding:10px;
    margin-left:500px ;
    margin-top:60px;
     width: 200px; 
}
button{
position: absolute;
top: 770px;
right: 1270px;
height:50px;
 font-size:17px;
  background-color:#00001a; 
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 8px;
}
button:hover{
  border-radius: 8px;
  background-color: white; 
  color: #00001a; 
  border: 3px solid #00001a;
  font-size:17px;

}
#submit {
 height:90px;
 font-size:30px;
  background-color:#00001a; 
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 8px;
}

#submit:hover {
  border-radius: 8px;
  background-color: white; 
  color: #00001a; 
  border: 2px solid #00001a;
}

</style>

    <meta charset="UTF-8">
    
</head>

<body>
     
    <div class="container">
        <form action="/YAKHAR/main_search.php" method="post">

            <div class="form-group" id="symptomeDiv">
                <label for="Symptome"></label>
                </br>
                <input id="symptome" type="text" name="symptome" placeholder="Entrez votre symptôme..." required>
                </select>
            </div>

           
            </br>
            <input  class="buttony"type="submit" id="submit" name="submit"   value="Trouver des remedes" />
        </form>
		
    </div>
    <div class="toctoc_logo">
        <img src="./chat_bot/medic_robot.jpg" alt="Medic Bot At Your Service" width="600" height="600">
    </div>
    <script>
        var botmanWidget = {
            frameEndpoint: '/chat_bot/chat.html',
            introMessage: 'Bonjour !, vous m\'avez réveillé ! ',
            chatServer : '/chat_bot/chat.php', 
            title: 'TocTocMedoc ChatBot', 
            mainColor: '#00001a',
            bubbleBackground: '#00001a',
            aboutText: 'Powered by team YAKHAR',
            bubbleAvatarUrl: '',
        }; 
    </script>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
        <button class="btn_back" onclick="backToHome()">Retourner</button>

<!--  
    <script>
	$(document).ready(function(){
		var data = [];
		<?php
$dbuser='root';
$dbpassword='';
$dbconnection ='mysql:host=localhost;dbname=test';
try{
	$dbh = new PDO($dbconnection, $dbuser, $dbpassword);
    $result =  $dbh->query("SELECT nom_commun FROM SYMPTOMES");
while ($row = $result->fetch())
{
     echo 'data.push("'.utf8_encode($row[0]).'");';
}
}catch(PDOException $e){
	echo "Erreur :".$e->getMessage();
}
$dbh=null;
?>

 (function() {
            $('form > input').keyup(function() {

                var empty = false;
                $('form > input').each(function() {
                    if ($(this).val() == '') {
                        empty = true;
                    }
                });

                if (empty) {
                    $('#submit').attr('disabled', 'disabled');
                } else {
                    $('#submit').removeAttr('disabled');
                }
            });
        })()

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });

        }
        autocomplete(document.getElementById("symptome"), data);
	});
    </script>
    -->
</body>

</html>

