<?php
    class Reaction {
        public $id;
        public $emoji;
        public $message_id;
        public $user_id;

        public function __construct($user_id, $message_id, $emoji,  $id = null){
            $this->id = $id;
            $this->emoji = $emoji;
            $this->message_id = $message_id;
            $this->user_id = $user_id;
        }

        public function insert($conn){
            $sql = "INSERT INTO Reactions VALUES(:id, :user_id, :message_id, :emoji);";
            $options = array(
                "id" => $this->id,
                "user_id" => $this->user_id,
                "message_id" => $this->message_id,
                "emoji" => $this->emoji
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);

            return $success;
        }


        /** 
         * GET ALL THE REACTIONS IN THE DB FOR A MESSAGE
         */
        public static function getReactionsByMessageId($conn, $message_id){
            $sql = 'SELECT * FROM Reactions WHERE message_id=:id;';
            $options = array(
                "id" => $message_id    
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetchAll();

            if(!$result || !$success){
                return false;
            }

            $reactions = array();
            foreach($result as $reaction) {
                $reactions[] = new Reaction($reaction["author_id"], $reaction["message_id"], $reaction['emoji'], $reaction['id']);;
            }

            return $reactions;
        }

        public function getReactionsForDisplay($conn, $message_id){
            $sql = "SELECT COUNT(Reactions.emoji), Reactions.emoji FROM Reactions WHERE Reactions.message_id=:message_id GROUP BY Reactions.emoji";
            $options = array(
                "message_id" => $message_id    
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetchAll();
            
            if(!$result || !$success){
                return false;
            }

            $reactions = array();

            foreach($result as $reaction) {
                $reactions[] =  new Reaction($reaction["user_id"], $reaction["message_id"], $reaction['emoji'], $reaction['reaction_id']);;
            }

            return $result;
        }
    }

?>