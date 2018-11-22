<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/styles.css" />

    <title>PH-Essenger</title>
</head>
<body class="container-fluid">
    <main class="row">
        <!-- Section with all the topics created -->
        <section id="topics" class="d-none d-md-block col-md-3">

        </section>

        <!-- Section which display all the messages from a topic -->
        <section id="messages" class="col-12 col-md-6">
            <?php
                require('../models/message.php');
                $messages = array();
                $messages[] = new Message("The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men.");
                $messages[] = new Message('Blessed is he who, ');
                $messages[] = new Message('in the name of charity and good will, ');
                $messages[] = new Message('shepherds the weak through the valley of darkness, ');
                $messages[] = new Message('for he is truly his brother\'s keeper and the finder of lost children.');
                $messages[] = new Message('And I will strike down upon thee with great vengeance and ');
                $messages[] = new Message('furious anger those who would attempt to poison and destroy My brothers. ');
            ?>
            <div class="row messages-div">
                <?php
                foreach($messages as $message) {
                ?>
                    <div class="col-12">
                        <div class="row message">
                            <p class="col"><?php echo $message->message;?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
   
            <div id="send-div" class="col-6 offset-3 fixed-bottom">
                <form id="message" action="" method="" class="row">
                    <input type="text" name="message" placeholder="Your message here" class="form-control col-11"/>
                    <button id="send" type="submit" name="send" class="img-fluid col-1"><img id="send-image" src="../public/images/arrow.svg" class="img-fluid send-image"></button>
                </form>
            </div>
        </section>

        <!-- Section which display all the subscribers -->
        <section id="subs" class="d-none d-md-block col-3">

        </section>
    </main>
</body>
</html>