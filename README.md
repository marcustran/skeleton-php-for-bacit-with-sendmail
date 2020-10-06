# skeleton-php-for-bacit-with-sendmail

Bruker "$" for å illustrere at det er et kommando i terminalvinduet. 

(1) Bygge bildet (på engelsk: "build image") TAR NOE TID (2-3 minutter)
$ docker-compose build

(2) Utføre bildet (på engelsk: "run image")
$ docker-compose up

Hvordan "se inn i" i en kontainer (husk at en kontainer utfører eget operativsystem)?
(1) Først kan man se hvilke kontainere som utføres på enhetene
$ docker container ls

(2) Så kan man "gå inn i" kontainer vha. av programmet "bash"
<cid> ser man under kolonnenavn "CONTAINER ID"
<kontainernavn> man kan også bruke navn under kolonnen "NAMES"
"|" betyr "eller" (på engelsk "or")
$ docker exec -it <kontainernavn | cid> bash 

Den siste kommandoen gir følgende resultat (også kalles prompt):
root@foobar:/var/www# _

Prompt er den teksten, som står foran plassen (også kalt for kursøren, som er betegnet her med "_"), hvor man kan skrive inn kommandoer i programmet "bash". Alle kommandoer vil bli utført "inn i" kontaineren <kontainernavn | cid>
