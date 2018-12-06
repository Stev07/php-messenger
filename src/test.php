<?php 
    require_once("models/db.php");
    require_once('models/user.php');
    require_once('models/conversation.php');
    require_once('models/message.php');
    require_once('models/reaction.php');


    $db = new DB();

    $users = User::getUsers($db->conn);
    print_r($users);
    echo "<br><br>";

    $conversations = Conversation::getConversations($db->conn);
    print_r($conversations);
    echo "<br><br>";

    $conversation1 = Conversation::getConversationById($db->conn, 2);
    print_r($conversation1);
    echo "<br><br>";

    $messages = Message::getMessagesByConversationId($db->conn, $conversations[1]->id);
    print_r($messages);
    echo "<br><br>";

    $message1 = Message::getMessageById($db->conn, 20);
    print_r($message1);
    echo "<br><br>";

    $reactions = Reaction::getReactionsByMessageId($db->conn, 27);
    print_r($reactions);

    
    /*$val = new User('Valentin', 'Grégoire', 'valentin@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $steve = new User('Steve', 'Dossin', 'steve@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $marie = new User('Marie', 'Grosjean', 'marie@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $benedicte = new User('Bénédicte', 'Struvay', 'benedicte@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));

    $val->insert($db->conn);
    $steve->insert($db->conn);
    $marie->insert($db->conn);
    $benedicte->insert($db->conn);*/

    /*$conversation1 = new Conversation(1, 'La vie');
    $conversation2 = new Conversation(2, 'Le php');
    $conversation3 = new Conversation(3, 'Le SQL');
    $conversation4 = new Conversation(4, 'Les objets');

    if($conversation1->insert($db->conn)) echo 'succes';
    else echo 'ou pas';
    
    if($conversation2->insert($db->conn)) echo 'succes';
    else echo 'ou pas';

    if($conversation3->insert($db->conn)) echo 'succes';
    else echo 'ou pas';
    
    if($conversation4->insert($db->conn)) echo 'succes';
    else echo 'ou pas';*/

    /*$messages[] = new Message(1, 1, 'contenu sur la vie de val');
    $messages[] = new Message(2, 1, 'contenu sur la vie de Marie');
    $messages[] = new Message(3, 1, 'contenu sur la vie de Steve');
    $messages[] = new Message(4, 1, 'contenu sur la vie de Béné');

    $messages[] = new Message(1, 2, 'contenu sur le PHP de val');
    $messages[] = new Message(2, 2, 'contenu sur le PHP de Marie');
    $messages[] = new Message(3, 2, 'contenu sur le PHP de Steve');
    $messages[] = new Message(4, 2, 'contenu sur le PHP de Béné');

    $messages[] = new Message(1, 3, 'contenu sur le SQL de val');
    $messages[] = new Message(2, 3, 'contenu sur le SQL de Marie');
    $messages[] = new Message(3, 3, 'contenu sur le SQL de Steve');
    $messages[] = new Message(4, 3, 'contenu sur le SQL de Béné');
    
    $messages[] = new Message(1, 4, 'contenu sur les objets de val');
    $messages[] = new Message(2, 4, 'contenu sur les objets de Marie');
    $messages[] = new Message(3, 4, 'contenu sur les objets de Steve');
    $messages[] = new Message(4, 4, 'contenu sur les objets de Béné');
    
    foreach($messages as $message){
        if($message->insert($db->conn)) echo 'success';
        else echo 'ou pas';

        echo '<br>';
    }*/

    /*$reactions = array();
    $reactions[] = new Reaction(2, 19, '&#128077;');
    $reactions[] = new Reaction(1, 18, '&#128077;');
    $reactions[] = new Reaction(3, 27, '&#128513;');
    $reactions[] = new Reaction(4, 21, '&#128544;');

    foreach($reactions as $reaction){
        if($reaction->insert($db->conn)) echo 'success';
        else echo 'ou pas';

        echo '<br>';
    }*/
?>