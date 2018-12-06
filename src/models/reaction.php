<?php
    class Reaction {
        public $id;
        public $emoji;
        public $message;
        public $user;

        public function __construct($user, $message, $emoji,  $id = null){
            $this->id = $id;
            $this->emoji = $emoji;
            $this->message = $message;
            $this->user = $user;
        }
    }

?>