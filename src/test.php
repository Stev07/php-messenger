<?php 
    require('models/db.php');

    $db = new DB();

    /*$val = new User('Valentin', 'Grégoire', 'valentin@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $steve = new User('Steve', 'Dossin', 'steve@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $marie = new User('Marie', 'Grosjean', 'marie@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));
    $benedicte = new User('Bénédicte', 'Struvay', 'benedicte@gmail.com', password_hash('password', PASSWORD_BCRYPT, array('cost' => 12)));

    $db->insertUser($val);
    $db->insertUser($steve);
    $db->insertUser($marie);
    $db->insertUser($benedicte);*/

    $users = $db->getUsers();

    /*$conversation1 = new Conversation($users[0], 'La vie');
    $conversation2 = new Conversation($users[1], 'Le php');
    $conversation3 = new Conversation($users[2], 'Le SQL');
    $conversation4 = new Conversation($users[3], 'Les objets');

    $db->insertConversation($conversation1);
    $db->insertConversation($conversation2);
    $db->insertConversation($conversation3);
    $db->insertConversation($conversation4);*/

    $conversations = $db->getConversations();

    /*$messages[] = new Message($users[0], $conversations[0], 'contenu sur la vie de val');
    $messages[] = new Message($users[1], $conversations[0], 'contenu sur la vie de Marie');
    $messages[] = new Message($users[2], $conversations[0], 'contenu sur la vie de Steve');
    $messages[] = new Message($users[3], $conversations[0], 'contenu sur la vie de Béné');

    $messages[] = new Message($users[0], $conversations[1], 'contenu sur le PHP de val');
    $messages[] = new Message($users[1], $conversations[1], 'contenu sur le PHP de Marie');
    $messages[] = new Message($users[2], $conversations[1], 'contenu sur le PHP de Steve');
    $messages[] = new Message($users[3], $conversations[1], 'contenu sur le PHP de Béné');

    $messages[] = new Message($users[0], $conversations[2], 'contenu sur le SQL de val');
    $messages[] = new Message($users[1], $conversations[2], 'contenu sur le SQL de Marie');
    $messages[] = new Message($users[2], $conversations[2], 'contenu sur le SQL de Steve');
    $messages[] = new Message($users[3], $conversations[2], 'contenu sur le SQL de Béné');
    
    $messages[] = new Message($users[0], $conversations[3], 'contenu sur les objets de val');
    $messages[] = new Message($users[1], $conversations[3], 'contenu sur les objets de Marie');
    $messages[] = new Message($users[2], $conversations[3], 'contenu sur les objets de Steve');
    $messages[] = new Message($users[3], $conversations[3], 'contenu sur les objets de Béné');
    
    foreach($messages as $message){
        $db->insertMessage($message);
    }*/

    $messages1 = $db->getMessagesByConversationID(1);
    $messages2 = $db->getMessagesByConversationID(2);
    $messages3 = $db->getMessagesByConversationID(3);
    $messages4 = $db->getMessagesByConversationID(4);

    /*$reactions = array();
    $reactions[] = new Reaction($users[1], $messages1[2], '&#128077;');
    $reactions[] = new Reaction($users[2], $messages1[1], '&#128077;');
    $reactions[] = new Reaction($users[3], $messages2[0], '&#128513;');
    $reactions[] = new Reaction($users[0], $messages3[2], '&#128544;');
    $reactions[] = new Reaction($users[3], $messages1[1], '&#128513;');
    $reactions[] = new Reaction($users[1], $messages1[3], '&#128077;');
    $reactions[] = new Reaction($users[2], $messages3[0], '&#128513;');
    $reactions[] = new Reaction($users[0], $messages4[1], '&#128077;');
    $reactions[] = new Reaction($users[1], $messages3[2], '&#128513;');
    $reactions[] = new Reaction($users[3], $messages4[0], '&#128077;');
    $reactions[] = new Reaction($users[0], $messages2[1], '&#128544;');
    $reactions[] = new Reaction($users[2], $messages1[0], '&#128077;');
    $reactions[] = new Reaction($users[1], $messages2[1], '&#128077;');
    $reactions[] = new Reaction($users[0], $messages2[0], '&#128077;');
    $reactions[] = new Reaction($users[1], $messages4[2], '&#128544;');
    $reactions[] = new Reaction($users[2], $messages3[3], '&#128077;');

    foreach($reactions as $reaction){
        $db->insertReaction($reaction);
    }*/
?>