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
            <div class="row">
                <nav class="col navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="row">
                        <ul class="col navbar-nav">
                            <a href="">
                                <li class="nav-item col-4">Home</li>
                            </a>
                            <a href="">
                                <li class="nav-item col-4">Pref</li>
                            </a>
                            <a href="">
                                <li class="nav-item col-4">Logout</li>
                            </a>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="row">
                <?php 
                    $conversations = array();
                    $conversations[] = 'Subject1';
                    $conversations[] = 'Subject2';
                    $conversations[] = 'Subject3';
                    $conversations[] = 'Subject4';
                    $conversations[] = 'Subject5';
                    $conversations[] = 'Subject6';
                    $conversations[] = 'Subject7';

                    foreach($conversations as $convers){
                        ?>
                        <div class="col-12 topics">
                            <p><?php echo $convers ?></p>
                        </div>
                        <?php
                    }
                ?>
                
            </div>
        </section>

        <!-- Section which display all the messages from a topic -->
        <section id="messages" class="col-12 col-md-6">
            <?php
                $messages = array();
                $messages[] = "The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men.";
                $messages[] = 'Blessed is he who, ';
                $messages[] = 'in the name of charity and good will, ';
                $messages[] = 'shepherds the weak through the valley of darkness, ';
                $messages[] = 'for he is truly his brother\'s keeper and the finder of lost children.';
                $messages[] = 'And I will strike down upon thee with great vengeance and ';
                $messages[] = 'furious anger those who would attempt to poison and destroy My brothers. ';
            ?>
            <div class="row messages-div">
                <?php
                foreach($messages as $message) {
                ?>
                    <div class="col-12">
                        <div class="row message">
                            <p class="col"><?php echo $message?></p>
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