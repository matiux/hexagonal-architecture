Hexagonal Architecture refactoring
=====

# Slide
https://matiux.github.io/slides/hexagonal-architecture

# Codice di esempio
Basandomi sul libro *Domain-Driven Design in PHP*, mostro un processo di refactoring da spaghetti code a organizzazione del codice 
tramite architettura esagonale

L'architettura esagonale consente a un'applicazione di essere ugualmente guidata da utenti, programmi, test automatizzati o 
script batch e di essere sviluppata e testata separatamente dai suoi eventuali dispositivi e database.

### Preparare il progetto

```shell
git clone https://github.com/matiux/hexagonal-architecture.git && cd hexagonal-architecture.git
rm -rf .git/hooks && ln -s ../scripts/git-hooks .git/hooks
./dc up -d
./dc enter
composer install
php src/build.php
```

### Docker
`dc` è una scorciatoia per `docker-compose`
```
./dc up -d (docker-compose up -d)
./dc enter (docker-compose exec -u utente php /bin/zsh)
./dc down -v --rmi=all (docker-compose down -v --rmi=all)
```

#### Database MySql
```
Adminer: localhost:8081
Host dentro al container: servicedb:3306
Host fuori dal container: 127.0.0.1:3307
Utente: user
Password: password
```

#### Da eseguire all'interno del container

I primi 3 step di refactoring
```
./dc enter
php src/Step01/client.php
php src/Step02/client.php
php src/Step03/client.php
```
Step finale con implementazione con vari delivery e test
```
php src/Step04/client.php
php src/Step04/console app:create-idea 'Flying pig' Matiux
vendor/bin/phpunit
```
