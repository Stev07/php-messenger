<?php 
    session_start(); 
    if(!isset($_SESSION['user_email'])){
        header("location: /");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css" />

    <title>PH-Essenger</title>
</head>
<body class="container-fluid">
    <?php 
        require('models/db.php');
        $db=new DB();

        $conversations = $db->getConversations();
        
        if(isset($_GET['conv_id'])){
            $messages = $db->getMessagesByConversationID($_GET['conv_id']);
        }
    ?>
    <main class="row">
        <!-- Section with all the topics created -->
        <section id="topics" class="d-none d-md-block col-md-3">
            <div id="menu" class="row">
                <?php include('views/menu.php'); ?>
            </div>
            <form method="post" action="./traitements/adder.php" class="row">
                <input type="text" class="col-10" name="subject" placeholder="Entrez votre sujet">
                <input type="submit" name="add-convers" value=">" class="adder col-1">
            </form>
            <div id="convers" class="row">
                <?php 
                    if(!is_null($conversations) && sizeof($conversations)>0){
                        foreach($conversations as $convers){
                                echo '<a href="message.php?conv_id=' . $convers->id . '" class="col-12 topics">';
                                    echo '<p class="subjects float-left">' . $convers->subject . '</p> <br>';
                                    echo '<p class="subjects float-right"><i>' . $convers->user->firstname . '</i></p>';
                                echo '</a>';
                        }
                    } else {
                        echo '<h3>Aucun sujet trouvé!</h3>';
                    }
                ?>
            </div>
        </section>

        <!-- Section which display all the messages from a topic -->
        <section id="messages" class="col-12 col-md-6">
            <?php if(isset($_GET["conv_id"])){ ?>
                <form method="post" action="./traitements/adder.php" class="row">
                    <input type="text" class="col-11" name="message" placeholder="Entrez votre message">
                    <input type="submit" name="add-message" value=">" class="adder col-1">
                    <input type="hidden" name="conversation_id" value="<?php echo $_GET['conv_id']; ?>">
                </form>
           
                <div class="row messages-div">
                    <?php        
                    if(!is_null($messages) && sizeof($messages)>0){
                        foreach($messages as $message) {
                            $reactions = $db->getReactionsForDisplay($message->id);

                            echo '<div class="col-12">';
                                echo '<div class="row message">';
                                    echo "<p class=\"col-12\">$message->content</p>";
                                    echo "<p class=\"reaction\">";
                                        foreach($reactions as $reaction){
                                            echo $reaction[0] . $reaction[1];
                                        }
                                    echo "</p>";
                                    echo "<p class=\"add-reaction\">";
                                        echo '+';
                                        echo '<span class="emoji-list-hidden">';
                                            echo '<a href="/traitements/adder.php?add-reaction=true&emoji=128077&message_id=' . $message->id . '">&#128077;</a> ';
                                            echo '<a href="/traitements/adder.php?add-reaction=true&emoji=128513&message_id=' . $message->id . '">&#128513;</a> ';
                                            echo '<a href="/traitements/adder.php?add-reaction=true&emoji=128514&message_id=' . $message->id . '">&#128514</a> ';
                                            echo '<a href="/traitements/adder.php?add-reaction=true&emoji=128544&message_id=' . $message->id . '">&#128544;</a> ';
                                        echo '</span></p></div></div>';
                        }
                    } else {
                        echo "<h3>No messages found, add one</h3>";
                    }
                }else {
                    echo "<h3>Veuillez sélectionner une conversation ou en créer une nouvelle!</h3>";
                } ?>
            </div>
        </section>

        <!-- Section which display all the subscribers -->
        <section id="subs" class="d-none d-md-block col-3">
            <?php
                if(!is_null($users)){
                    echo "<h3>Participant</h3><hr>";
                    echo '<div class="row">';
                    foreach($users as $user){
                        echo '<div class="col-12">';
                            echo '<div class="user row">';
                                echo "<h5 class='col'> $user->firstname $user->lastname</h5>";
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo "<h3>Aucun participant!</h3>";
                }
            ?>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
            Array.from(document.querySelectorAll('.add-reaction')).forEach((element) => {
                element.addEventListener('mouseenter', (e) => {
                    e.currentTarget.children[0].classList.remove('emoji-list-hidden');
                    e.currentTarget.children[0].classList.add('emoji-list-show');
                });

                element.addEventListener('mouseleave', (e) => {
                    e.currentTarget.children[0].classList.remove('emoji-list-show');
                    e.currentTarget.children[0].classList.add('emoji-list-hidden');
                });
            });
    </script>
</body>
</html>