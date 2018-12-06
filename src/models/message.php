<?php
    class Message{
        public $id;
        public $date;
        public $content;
        public $conversation_id;
        public $user_id;

        public function __construct($user_id, $conversation_id, $content, $date = null, $id = null){
            $this->id = $id;
            $this->date = ($date == null) ? date('Y-m-d H:i:s'): $date;
            $this->content = $content;
            $this->conversation_id = $conversation_id;
            $this->user_id = $user_id;
        }

        public function insert($conn){
            $sql = "INSERT INTO Messages VALUES(:id, :date, :user_id, :conversation_id, :content);";
            $options = array(
                "id" => $this->id,
                "date" => $this->date,
                "content" => $this->content,
                "conversation_id" => $this->conversation_id,
                "user_id" => $this->user_id
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);

            return $success;
        }

        /** 
         * GET ALL THE MESSAGES IN THE DB FOR A CONVERSATION
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: Message::getMessagesByConversationId($connexion, 1);
         */
        public static function getMessagesByConversationId($conn, $conversation_id){
            $sql = 'SELECT * FROM Messages WHERE conversation_id=:id;';
            $options = array(
                "id" => $conversation_id    
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetchAll();

            if(!$result || !$success){
                return false;
            }

            $messages = array();
            foreach($result as $message) {
                $messages[] = new Message($message['user_id'], $message['conversation_id'], $message['content'], $message['date'], $message['message_id']);
            }

            return $messages;
        }

        /**
         * GET ONE CONVERSATION BY ID
         * Cette méthode est nécessaire pour la récupération d'une conversation pour les messages
         */
        public function getMessageByID($conn, $id){
            $sql = "SELECT * FROM Messages WHERE message_id=:id LIMIT 1;";
            $options = array(
                "id" => $id
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetch();  

            if(!$result || !$success){
                return false;
            }

            return new Message($result["user_id"], $result['conversation_id'], $result['content'], $result['date'], $result['message_id']);
        }
    }
?>