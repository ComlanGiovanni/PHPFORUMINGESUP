PHP INGESUP FORUM

Pour faire fonctionner le site il faudras installer:
	-apache
	-mysql
	-Phpmyadmin (pour avoir un interface de gestion des base des donnée)


Sous linux

	-sudo apt-get update
	-sudo apt-get upgrade

	-sudo apt-get install apache2 libapache2-mod-php5 mysql-server mysql-client php5 php5-cli php5-curl php5-dev php5-intl php5-mcrypt php5-mysql php5-sqlite
	
	mysql_secure_installation

***Faire un chmod 777 var/html/lerepertoireenquestion -R

Sous Windows

Sous Mac OS

--------Mettre le dossier du forum dans le répertoire var/www/html/--------

--------Le site seras disponible sur 127.0.0.1/lerépertoireenquestion--------

Pour la gestion de votre base de donnée allé a 127.0.0.1/phpmyadmin
Entre le nom d'utilisateur et le mot de passe que vous avez au prélable conifgurer.


BASE DE DONNÉE espace_membre
	TABLE  membre
				
-------------------------------------------
id - int - index primaire - autoincrement
pseudo - varchar 225
mail - varchar 255
motdepasse-text	
-------------------------------------------

Voir -------------> images/tutophpmyadmin/-------------

1.

2.

3.

4.

5.

6.

7.

-------------------------------------------------------
