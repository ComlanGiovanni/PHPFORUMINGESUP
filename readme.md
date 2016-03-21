Readme.md de PHP INGESUP FORUM

Pour faire fonctionner le site il faudras installer au préalable quelque.

apache
mysql
Phpmyadmin pour avoir un interface de gestion des base des donnée


linux

Un petit coup de sudo apt-get update  et sudo apt-get upgrade 

aptitude install apache2 libapache2-mod-php5 mysql-server mysql-client php5 php5-cli php5-curl php5-dev php5-intl php5-mcrypt php5-mysql php5-sqlite
mysql_secure_installation


mettre le dossier du forum dans le répertoire var/www/html/
le site seras disponible sur 127.0.0.1/lerépertoire

pour la gestion de votre base de donnée allé a 127.0.0.1/phpmyadmin
-entre le nom d'utilisateur et le mot de passe que vous avez au prélable conifgurer.


crée votre  sur phpmyadmim

espace_membre
	membre
		id - int - index primaire - autoincrement
		pseudo - varchar 225
		mail - varchar 255
		motdepasse-text

Cf. images/tutophpmyadmin/




