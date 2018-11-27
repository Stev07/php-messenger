<?php
    /*
        Ici vous pouvez faire vos test d'affichage.
        Dans l'idéal, ne jouez pas avec les classes que les autres construisent.

        Steve:
            Tu vas concevoir la plus grosse classe. Dans l'idée, pour le moment quand tu 
            as réussi un insert, n'hésite pas à me le dire, on verra la suite ensemble.

        Bénédicte: 
            Pour les conversations, tu as besoin d'un User, mais tu n'as pas le travail de 
            Steve, c'est normal. Pour le moment, utilise juste un INTEGER (nombre entier).
            Dans l'idéal, tu n'as besoin que d'un User et il doit être valide dans la
            base de données. Donc tu vas utiliser le nombre 1 pour le User dans ton 
            constructeur. Ce sera sufisant pour les tests. Quand la classe User sera terminée,
            je te montrerai comment gérer ça avec un objet de type User.

        Marie: 
            Pareil que pour Bénédicte, tu n'as pas encore les classes Conversation et User finie.
            Tu vas donc utiliser 1 pour chacun des deux.


        J'ai mit en base de données 1 utilisateur, 1 conversation, 1 message, et 1 réaction de 
        manière à ce que aucune erreur ne soit donnée.

        Voici les étapes que j'aimerai vous voir parcourir:
        Créer votre classe (j'ai mit des minis instructions pour vous aiguiller). Ici, vous
        instancierez la classe et la mettrez dans une variable. Sur cette variable, vous appelerez
        la méthode insert que vous aurez créée dans votre classe.

        Pour la méthode insert, renseignez vous sur PDO sur php.net (PDO est un objet aussi donc vous devez
        l'instancier). Pour la création du PDO, n'hésitez pas à me demander, cela peut être très abstrait.
        Ensuite, vous devez écrire votre requête SQL, et pour cela, je vais vraiment vous laissez chercher MAIS
        je reste à disposition pour vous aider et vous expliquer.
        Dernière étape, vous devez demander à votre objet PDO de préparer la requête et après de l'exécuter.
        J'ai choisis de parler de préparer (prepare) et d'éxécuter (execute) pour aiguiller votre recherche sur php.net.

        Pour accèder à cette page, lancer votre docker-compose up et taper localhost:8000/test.php 
        N'oubliez pas de var_dump() vos variables pour vois les résultats. 

        Good luck all :)
    */
?>