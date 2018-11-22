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
        <section id="topics" class="col-3">

        </section>

        <!-- Section which display all the messages from a topic -->
        <section id="messages" class="col-6">
            

            <div id="send-div" class="col-6 offset-3 fixed-bottom">
                <form id="message" action="" method="post" class="row">
                    <input type="text" name="message" placeholder="Your message here" class="form-control col-11"/>
                    <button id="send" type="submit" name="send" class="img-fluid col-1"><img id="send-image" src="../public/images/arrow.svg" class="img-fluid send-image"></button>
                </form>
            </div>
        </section>

        <!-- Section which display all the subscribers -->
        <section id="subs" class="col-3">

        </section>
    </main>
</body>
</html>