<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="public/css/styles.css" />
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>PH-Essenger</title>
</head>
<body class="container-fluid">
    <main class="row">
        <!-- Section with all the topics created -->
        <section id="topics" class="d-none d-md-block col-md-3">
            <div id="menu" class="row">
                <?php include('includes/menu.php'); /* Inclusion du menu  */ ?> 
            </div>
            <div id="convers" class="row">
                <?php 
                    if(!is_null($conversations)){
                        foreach($conversations as $convers){
                            ?>
                                <button name="topic-<?php echo $convers->id?>" type="submit" class="col-12 topics" >
                                    <p class="subjects float-left"><?php echo $convers ?></p> <br>
                                    <p class="subjects float-right"><i>Author</i></p>
                                </button>
                            <?php
                        }
                    } else {
                        echo "<p>No conversations found</p>";
                    }
                ?>
            </div>
            <div class="row stuck-bottom">
                <div class="col-12">
                    <a href="/views/create_topic.php" class="adder float-right">+</a>
                </div>
            </div>
        </section>

        <!-- Section which display all the messages from a topic -->
        <section id="messages" class="col-12 col-md-6">
            <div class="row messages-div">
                <?php
                if(!is_null($messages)){
                    foreach($messages as $message) {
                    ?>
                        <div class="col-12">
                            <div class="row message">
                                <p class="col"><?php echo $message?></p>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo "<p>No messages found, add one</p>";
                }
                ?>
            </div>
   
            <div class="row">
                <div id="send" class="col-11">
                    <input type="email" class="form-control" placeholder="Input field" data-emojiable="true">
                </div>
                <div class="col-1">
                    <button name="send"><img id="send-image" src="public/images/arrow.svg" alt="send"/></button>
                </div>
            </div>
        </section>

        <!-- Section which display all the subscribers -->
        <section id="subs" class="d-none d-md-block col-3">
            <?php
                $users = array();

                if(!is_null($users)){ ?>
                    <div class='row'>
                <?php
                    foreach($users as $user){
                        ?>
                        <div class="col-12">
                            <div class="user row">
                                <p class="col"><?php echo $user->firstname . ' ' . $user->lastname?></p>
                            </div>
                        </div>

                        <?php
                    } ?>
                    </div>
                    <?php
                }
            ?>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>