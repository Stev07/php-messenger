<?php
    class Conversation {
        public $id;
        public $subject;
        public $user_id;

        public function __construct($user_id, $subject, $id = null){
            $this->id = $id;
            $this->subject = $subject;
            $this->user_id = $user_id;
        }

        public function insert($conn){
            $sql = "INSERT INTO Conversations VALUES(:id, :user_id, :subject);";
            $options = array(
                "id" => $this->id,
                "subject" => $this->subject,
                "user_id" => $this->user->id
            );
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            
            return $success;
        }

        /** 
         * GET ALL THE CONVERSATIONS IN THE DB
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: Conversation::getConversations($connexion);
         */
        public static function getConversations($conn){
            $sql = 'SELECT * FROM Conversations;';

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute();
            $result = $stmt->fetchAll();

            if(!$result || !$success){
                return false;
            }

            $conversations = array();
            foreach($result as $conversation) {
                $conversations[] = new Conversation($conversation["user_id"], $conversation["subject"], $conversation['conversation_id']);
            }

            return $conversations;
        }

        /**
         * GET ONE CONVERSATION BY ID
         * Cette méthode est nécessaire pour la récupération d'une conversation pour les messages.
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: Conversation::getConversationById($connexion, 1);
         */
        public static function getConversationById($conn, $id){
            $sql = "SELECT * FROM Conversations WHERE conversation_id=:id LIMIT 1;";
            $options = array(
                "id" => $id
            );
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetch();

            if(!$result || !$success){
                return false;
            }

            return new Conversation($result["user_id"], $result['subject'], $result['conversation_id']);
        }
    }
?>