<?php
    session_start(); 

    if(!isset($_SESSION['auth'])){ 
        header("location: /");
    }   

    require_once(dirname(__DIR__) . '/models/db.php');
    require_once(dirname(__DIR__) . '/models/user.php');
    require_once(dirname(__DIR__) . '/models/conversation.php');
    require_once(dirname(__DIR__) . '/models/message.php');
    require_once(dirname(__DIR__) . '/models/reaction.php');

    $db = new DB();

    $user_email = $_SESSION['user_email'];
    $user = User::getUserByEmail($db->conn, $user_email);
    
    if(isset($_POST['add-convers'])){
        $subject = $_POST["subject"];
        $conversation = new Conversation($user->id, $subject);

        $conversation->insert($db->conn);
        header("location: /chat.php");

        exit();
    }

    if(isset($_POST["add-message"])){
        $conv_id = $_POST['conversation_id'];

        $message = $_POST['message'];
        $message = new Message($user->id, $conv_id, $message);

        $message->insert($db->conn);
        header("location: /chat.php?conv_id=" . $conv_id);

        exit();
    }

    if(isset($_GET['add-reaction'])){
        $message_id = $_GET["message_id"];
        $message = Message::getMessageById($db->conn, $message_id);

        $emoji = "&#" . $_GET["emoji"] . ";";

        $reaction = new Reaction($user->id, $message->id, $emoji);
        $reaction->insert($db->conn);
        header("location: /chat.php?conv_id=" . $message->conversation_id);

        exit();
    }

    if(isset($_GET['delete-message'])){
        $message_id = $_GET["delete-message"];
        Message::delete($db->conn, $message_id);

        header("location: /chat.php?conv_id=" . $_GET["conv_id"]);
    }

?>