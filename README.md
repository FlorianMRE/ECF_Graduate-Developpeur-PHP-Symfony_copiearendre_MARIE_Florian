# ECF_Graduate-Developpeur-PHP-Symfony_copiearendre_MARIE_Florian

### 🔎 Éléments requits 

php version > 8
composer 2
Logiciel de serveur local commme wamp, mamp, xamp, ou alors utiliser docker si vous le souhaitez

## 🧰 Installation du projet en local

1. Créer un env.local avec les variables pour votre environnemment (MAILER_DSN + DATABASE_URL)
2. Installer les dépendances (composer install)
3. Créer la base de données ((symfony ou php/bin) console doctrine:database:create )
4. Créer les données pour nourrir la base de donnée ((symfony ou php/bin) console doctrine:fixture:load)
5. Démarré le serveur local (symfony serve)

Création du .htaccess si besoin.

![](https://media.giphy.com/media/8xgqLTTgWqHWU/giphy.gif)